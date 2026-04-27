<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\ActivityLog;
use App\Services\StudentService;
use App\Services\WhatsAppService;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function index(Request $request)
    {
        $query = Student::latest();
        
        if ($request->has('gender')) {
            $query->where('jenis_kelamin', $request->gender);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nisn', 'like', "%{$search}%")
                  ->orWhere('nomor_pendaftaran', 'like', "%{$search}%");
            });
        }

        $students = $query->get();
        return view('admin.students.index', compact('students'));
    }

    public function hasil(Request $request)
    {
        $query = Student::latest();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nisn', 'like', "%{$search}%")
                  ->orWhere('nomor_pendaftaran', 'like', "%{$search}%");
            });
        }

        $students = $query->get();
        return view('admin.students.hasil', compact('students'));
    }

    public function show(Student $student)
    {
        return view('admin.students.show', compact('student'));
    }

    public function cetak(Student $student)
    {
        return view('admin.students.cetak', compact('student'));
    }

    public function cetakSemua(Request $request)
    {
        $query = Student::latest();

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nisn', 'like', "%{$search}%");
            });
        }

        $students = $query->get();
        return view('admin.students.cetak_semua', compact('students'));
    }

    public function exportExcel(Request $request)
    {
        $query = Student::latest();

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nisn', 'like', "%{$search}%");
            });
        }

        $students = $query->get();

        $filename = "Data_Pendaftar_PPDB_" . date('Ymd_His') . ".csv";

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['No', 'Nomor Pendaftaran', 'NISN', 'Nama Lengkap', 'Jenis Kelamin', 'Tempat Lahir', 'Tanggal Lahir', 'Asal Sekolah', 'Jalur Pendaftaran', 'Status Seleksi', 'Nilai Akhir'];

        $callback = function() use($students, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($students as $index => $student) {
                $row['No']  = $index + 1;
                $row['Nomor Pendaftaran'] = $student->nomor_pendaftaran;
                $row['NISN']    = $student->nisn;
                $row['Nama Lengkap']    = $student->nama_lengkap;
                $row['Jenis Kelamin']  = $student->jenis_kelamin;
                $row['Tempat Lahir']  = $student->tempat_lahir;
                $row['Tanggal Lahir']  = $student->tanggal_lahir;
                $row['Asal Sekolah']  = $student->nama_sekolah_asal;
                $row['Jalur Pendaftaran']  = $student->jalur_pendaftaran;
                $row['Status Seleksi']  = $student->status;
                $row['Nilai Akhir'] = $student->nilai_akhir_seleksi;

                fputcsv($file, array($row['No'], $row['Nomor Pendaftaran'], $row['NISN'], $row['Nama Lengkap'], $row['Jenis Kelamin'], $row['Tempat Lahir'], $row['Tanggal Lahir'], $row['Asal Sekolah'], $row['Jalur Pendaftaran'], $row['Status Seleksi'], $row['Nilai Akhir']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $request->validate($this->studentService->getValidationRules());
        
        $data = $this->studentService->handleFileUploads($request);
        $data['nomor_pendaftaran'] = $this->studentService->generateRegistrationNumber();
        $data['nilai_akhir_seleksi'] = $this->studentService->calculateSelectionScore($data);
        $data['status'] = 'Menunggu Verifikasi';

        $student = Student::create($data);
        ActivityLog::log("Menambahkan pendaftar baru secara manual: " . $student->nama_lengkap);

        return redirect()->route('students.index')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function edit(Student $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate($this->studentService->getValidationRules($student->id));
        
        $data = $this->studentService->handleFileUploads($request, $student);

        $data['nilai_akhir_seleksi'] = $this->studentService->calculateSelectionScore($data);

        $data['is_kk_valid'] = $request->has('is_kk_valid') ? 1 : 0;
        $data['is_akta_valid'] = $request->has('is_akta_valid') ? 1 : 0;
        $data['is_rapor_valid'] = $request->has('is_rapor_valid') ? 1 : 0;
        $data['is_foto_valid'] = $request->has('is_foto_valid') ? 1 : 0;
        
        if ($request->has('status')) {
            $data['status'] = $request->status;

            if ($student->status != $request->status && $student->nomor_hp) {
                $message = "Halo {$student->nama_lengkap}, status pendaftaran PPDB Anda saat ini: {$request->status}. " . 
                           ($request->catatan_admin ? "Catatan Panitia: {$request->catatan_admin}" : "");
                WhatsAppService::send($student->nomor_hp, $message);
            }
        }
        
        $data['catatan_admin'] = $request->catatan_admin;

        $student->update($data);
        
        ActivityLog::log("Memperbarui data dan status pendaftar: " . $student->nama_lengkap . " menjadi " . $student->status);

        return redirect()->route('students.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroy(Student $student)
    {
        $files = ['file_kk', 'file_akta', 'file_ktp_ortu', 'file_foto', 'file_ijazah', 'file_rapor', 'file_prestasi'];
        foreach ($files as $file) {
            if ($student->$file) {
                Storage::disk('public')->delete($student->$file);
            }
        }
        
        ActivityLog::log("Menghapus data pendaftar: " . $student->nama_lengkap);
        $student->delete();
        
        return redirect()->route('students.index')->with('success', 'Data siswa berhasil dihapus!');
    }
}


