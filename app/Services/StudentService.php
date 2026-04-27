<?php

namespace App\Services;

use App\Models\Student;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class StudentService
{
    public function getValidationRules($id = null)
    {
        return [

            'nama_lengkap' => 'required|string|max:255',
            'nisn' => 'required|string|unique:students,nisn' . ($id ? ',' . $id : ''),
            'nik' => 'required|digits:16|unique:students,nik' . ($id ? ',' . $id : ''),
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => ['required', 'date', function ($attribute, $value, $fail) {
                $age = Carbon::parse($value)->age;
                if ($age < 6 || $age > 12) {
                    $fail('Usia pendaftar harus antara 6 hingga 12 tahun.');
                }
            }],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string',
            'alamat' => 'required|string',
            'nomor_hp' => 'required|string|min:10',
            'email' => 'nullable|email',
            'anak_ke' => 'required|integer',
            'jumlah_saudara' => 'required|integer',

            'nama_sekolah_asal' => 'required|string',
            'npsn_sekolah' => 'required|string',
            'alamat_sekolah' => 'required|string',
            'tahun_lulus' => 'required|string',
            'nilai_rapor' => 'required|numeric',

            'nama_ayah' => 'required|string',
            'nama_ibu' => 'required|string',
            'nik_ayah' => 'required|string',
            'nik_ibu' => 'required|string',
            'tempat_tanggal_lahir_ayah' => 'required|string',
            'tempat_tanggal_lahir_ibu' => 'required|string',
            'pendidikan_ayah' => 'required|string',
            'pendidikan_ibu' => 'required|string',
            'pekerjaan_ayah' => 'required|string',
            'pekerjaan_ibu' => 'required|string',
            'penghasilan_orang_tua' => 'required|string',

            'nama_wali' => 'nullable|string',
            'hubungan_wali' => 'nullable|string',
            'pekerjaan_wali' => 'nullable|string',
            'alamat_wali' => 'nullable|string',

            'jalur_pendaftaran' => 'required|string',
            'titik_koordinat' => 'nullable|string',
            'data_prestasi' => 'nullable|string',
            'data_bantuan' => 'nullable|string',
            'status' => 'nullable|string',

            'file_kk' => ($id ? 'nullable' : 'required') . '|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_akta' => ($id ? 'nullable' : 'required') . '|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_ktp_ortu' => ($id ? 'nullable' : 'required') . '|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_foto' => ($id ? 'nullable' : 'required') . '|file|mimes:jpg,jpeg,png|max:2048',
            'file_ijazah' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_rapor' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'file_prestasi' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ];
    }

    public function handleFileUploads(Request $request, $student = null)
    {
        $data = $request->except(['_token', '_method']);
        $files = ['file_kk', 'file_akta', 'file_ktp_ortu', 'file_foto', 'file_ijazah', 'file_rapor', 'file_prestasi'];

        foreach ($files as $file) {
            if ($request->hasFile($file)) {
                if ($student && $student->$file) {
                    Storage::disk('public')->delete($student->$file);
                }
                $path = $request->file($file)->store('documents', 'public');
                $data[$file] = $path;
            } else {
                if ($student) {
                    $data[$file] = $student->$file;
                }
            }
        }

        return $data;
    }

    public function generateRegistrationNumber()
    {
        $year = date('Y');
        $lastStudent = Student::whereYear('created_at', $year)
                              ->orderBy('id', 'desc')
                              ->first();
                              
        if (!$lastStudent || !$lastStudent->nomor_pendaftaran) {
            $number = 1;
        } else {

            $parts = explode('-', $lastStudent->nomor_pendaftaran);
            if (count($parts) == 3 && $parts[1] == $year) {
                $number = intval($parts[2]) + 1;
            } else {
                $number = 1;
            }
        }

        return 'PPDB-' . $year . '-' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }
    
    public function calculateSelectionScore($data)
    {
        $bobotRapor = floatval(Setting::get('bobot_rapor', 50));
        $bobotJarak = floatval(Setting::get('bobot_jarak', 30));
        $bobotPrestasi = floatval(Setting::get('bobot_prestasi', 20));
        
        $nilaiRapor = floatval($data['nilai_rapor'] ?? 0);


        $jarakScore = 80; 

        $prestasiScore = !empty($data['data_prestasi']) ? 100 : 0;
        
        $finalScore = ($nilaiRapor * ($bobotRapor / 100)) + 
                      ($jarakScore * ($bobotJarak / 100)) + 
                      ($prestasiScore * ($bobotPrestasi / 100));
                      
        return $finalScore;
    }
}


