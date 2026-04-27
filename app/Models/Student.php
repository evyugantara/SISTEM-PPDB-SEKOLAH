<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Student extends Model
{
    use HasFactory;

    protected $fillable = [

        'nama_lengkap', 'nisn', 'nik', 'tempat_lahir', 'tanggal_lahir',
        'jenis_kelamin', 'agama', 'alamat', 'nomor_hp', 'email', 'anak_ke', 'jumlah_saudara',

        'nama_sekolah_asal', 'npsn_sekolah', 'alamat_sekolah', 'tahun_lulus', 'nilai_rapor',

        'nama_ayah', 'nama_ibu', 'nik_ayah', 'nik_ibu', 
        'tempat_tanggal_lahir_ayah', 'tempat_tanggal_lahir_ibu',
        'pendidikan_ayah', 'pendidikan_ibu', 'pekerjaan_ayah', 'pekerjaan_ibu', 'penghasilan_orang_tua',

        'nama_wali', 'hubungan_wali', 'pekerjaan_wali', 'alamat_wali',

        'jalur_pendaftaran', 'titik_koordinat', 'data_prestasi', 'data_bantuan', 'status',

        'file_kk', 'file_akta', 'file_ktp_ortu', 'file_foto', 'file_ijazah', 'file_rapor', 'file_prestasi',

        'nomor_pendaftaran', 'catatan_admin', 'is_kk_valid', 'is_akta_valid', 'is_rapor_valid', 'is_foto_valid', 'nilai_akhir_seleksi'
    ];
    
    protected $casts = [
        'is_kk_valid' => 'boolean',
        'is_akta_valid' => 'boolean',
        'is_rapor_valid' => 'boolean',
        'is_foto_valid' => 'boolean',
    ];
}


