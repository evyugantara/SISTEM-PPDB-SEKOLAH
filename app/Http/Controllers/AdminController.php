<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Setting;
use App\Models\ActivityLog;

class AdminController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count();
        $totalLaki = Student::where('jenis_kelamin', 'Laki-laki')->count();
        $totalPerempuan = Student::where('jenis_kelamin', 'Perempuan')->count();

        $totalZonasi     = Student::where('jalur_pendaftaran', 'Zonasi')->count();
        $totalPrestasi   = Student::where('jalur_pendaftaran', 'Prestasi')->count();
        $totalAfirmasi   = Student::where('jalur_pendaftaran', 'Afirmasi')->count();
        $totalPerpindahan = Student::where('jalur_pendaftaran', 'Perpindahan')->count();

        $kuotaZonasi      = (int) Setting::get('kuota_zonasi', 120);
        $kuotaPrestasi    = (int) Setting::get('kuota_prestasi', 40);
        $kuotaAfirmasi    = (int) Setting::get('kuota_afirmasi', 20);
        $kuotaPerpindahan = (int) Setting::get('kuota_perpindahan', 10);

        $pctZonasi      = $kuotaZonasi > 0      ? min(100, round(($totalZonasi / $kuotaZonasi) * 100)) : 0;
        $pctPrestasi    = $kuotaPrestasi > 0    ? min(100, round(($totalPrestasi / $kuotaPrestasi) * 100)) : 0;
        $pctAfirmasi    = $kuotaAfirmasi > 0    ? min(100, round(($totalAfirmasi / $kuotaAfirmasi) * 100)) : 0;
        $pctPerpindahan = $kuotaPerpindahan > 0 ? min(100, round(($totalPerpindahan / $kuotaPerpindahan) * 100)) : 0;

        $totalDiterima          = Student::where('status', 'Diterima')->count();
        $totalDitolak           = Student::where('status', 'Ditolak')->count();
        $totalMenunggu          = Student::where('status', 'Menunggu Verifikasi')->count();
        $totalBerkasTidakSesuai = Student::where('status', 'Berkas Tidak Sesuai')->count();

        $recentLogs = ActivityLog::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalStudents', 'totalLaki', 'totalPerempuan',
            'totalZonasi', 'totalPrestasi', 'totalAfirmasi', 'totalPerpindahan',
            'kuotaZonasi', 'kuotaPrestasi', 'kuotaAfirmasi', 'kuotaPerpindahan',
            'pctZonasi', 'pctPrestasi', 'pctAfirmasi', 'pctPerpindahan',
            'totalDiterima', 'totalDitolak', 'totalMenunggu', 'totalBerkasTidakSesuai',
            'recentLogs'
        ));
    }
}


