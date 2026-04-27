<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Setting;
use App\Services\StudentService;
use App\Services\WhatsAppService;

class FrontController extends Controller
{
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function index()
    {
        $stats = [
            'total_pendaftar' => Student::count(),
            'kuota_total' => (int)Setting::get('kuota_zonasi', 0) + (int)Setting::get('kuota_prestasi', 0) + (int)Setting::get('kuota_afirmasi', 0) + (int)Setting::get('kuota_perpindahan', 0),
            'tgl_buka' => Setting::get('tgl_buka'),
            'tgl_tutup' => Setting::get('tgl_tutup'),
        ];
        
        return view('welcome', compact('stats'));
    }

    public function cekStatus(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string'
        ]);

        $student = Student::where('nisn', $request->nisn)->first();

        if ($student) {
            return redirect('/')->with('result', $student)->withInput();
        } else {
            return redirect('/')->with('error', 'Data dengan NISN tersebut tidak ditemukan.')->withInput();
        }
    }

    public function cetakBukti($nisn)
    {
        $student = Student::where('nisn', $nisn)->firstOrFail();
        return view('admin.students.cetak', compact('student'));
    }
    
    public function daftar()
    {
        $isActive = Setting::get('system_active', '1');
        if ($isActive !== '1') {
            return redirect('/')->with('error', 'Maaf, pendaftaran PPDB sedang ditutup.');
        }
        
        return view('public.register');
    }
    
    public function storePendaftaran(Request $request)
    {
        $isActive = Setting::get('system_active', '1');
        if ($isActive !== '1') {
            return redirect('/')->with('error', 'Pendaftaran PPDB sedang ditutup.');
        }

        $request->validate($this->studentService->getValidationRules());
        
        $data = $this->studentService->handleFileUploads($request);
        $data['nomor_pendaftaran'] = $this->studentService->generateRegistrationNumber();
        $data['nilai_akhir_seleksi'] = $this->studentService->calculateSelectionScore($data);
        $data['status'] = 'Menunggu Verifikasi';

        $student = Student::create($data);

        $message = "Halo {$student->nama_lengkap}, pendaftaran Anda berhasil diterima. Nomor Pendaftaran Anda: {$student->nomor_pendaftaran}. Silakan tunggu proses verifikasi dari panitia.";
        WhatsAppService::send($student->nomor_hp, $message);

        return redirect('/')->with('success', 'Pendaftaran berhasil dikirim! Silakan cek status secara berkala dengan NISN Anda.');
    }
}


