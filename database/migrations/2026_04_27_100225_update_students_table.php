<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('nomor_pendaftaran')->unique()->nullable()->after('id');
            $table->text('catatan_admin')->nullable()->after('status');
            $table->boolean('is_kk_valid')->default(false)->after('catatan_admin');
            $table->boolean('is_akta_valid')->default(false)->after('is_kk_valid');
            $table->boolean('is_rapor_valid')->default(false)->after('is_akta_valid');
            $table->boolean('is_foto_valid')->default(false)->after('is_rapor_valid');
            $table->float('nilai_akhir_seleksi')->nullable()->after('is_foto_valid'); // for auto selection
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn([
                'nomor_pendaftaran', 'catatan_admin', 'is_kk_valid', 'is_akta_valid', 
                'is_rapor_valid', 'is_foto_valid', 'nilai_akhir_seleksi'
            ]);
        });
    }
};
