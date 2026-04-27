<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            
            // 1. Data Pribadi Siswa
            $table->string('nama_lengkap');
            $table->string('nisn')->unique();
            $table->string('nik')->unique();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('agama');
            $table->text('alamat');
            $table->string('nomor_hp');
            $table->string('email')->nullable();
            $table->integer('anak_ke');
            $table->integer('jumlah_saudara');

            // 2. Data Sekolah Asal
            $table->string('nama_sekolah_asal');
            $table->string('npsn_sekolah');
            $table->text('alamat_sekolah');
            $table->string('tahun_lulus');
            $table->string('nilai_rapor');

            // 3. Data Orang Tua
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('nik_ayah');
            $table->string('nik_ibu');
            $table->string('tempat_tanggal_lahir_ayah');
            $table->string('tempat_tanggal_lahir_ibu');
            $table->string('pendidikan_ayah');
            $table->string('pendidikan_ibu');
            $table->string('pekerjaan_ayah');
            $table->string('pekerjaan_ibu');
            $table->string('penghasilan_orang_tua');

            // 4. Data Wali (jika ada)
            $table->string('nama_wali')->nullable();
            $table->string('hubungan_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->text('alamat_wali')->nullable();

            // 5. Data Pendukung / Lainnya
            $table->string('jalur_pendaftaran'); // zonasi, prestasi, afirmasi, perpindahan
            $table->string('titik_koordinat')->nullable();
            $table->text('data_prestasi')->nullable();
            $table->string('data_bantuan')->nullable();

            // 6. Dokumen yang diunggah (File Paths)
            $table->string('file_kk')->nullable();
            $table->string('file_akta')->nullable();
            $table->string('file_ktp_ortu')->nullable();
            $table->string('file_foto')->nullable();
            $table->string('file_ijazah')->nullable();
            $table->string('file_rapor')->nullable();
            $table->string('file_prestasi')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
