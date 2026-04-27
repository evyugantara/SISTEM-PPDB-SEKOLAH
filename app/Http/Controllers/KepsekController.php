<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Setting;
use App\Models\ActivityLog;

class KepsekController extends Controller
{
    public function dashboard()
    {
        $totalStudents   = Student::count();
        $totalLaki       = Student::where('jenis_kelamin', 'Laki-laki')->count();
        $totalPerempuan  = Student::where('jenis_kelamin', 'Perempuan')->count();
        $totalDiterima   = Student::where('status', 'Diterima')->count();
        $totalDitolak    = Student::where('status', 'Ditolak')->count();
        $totalMenunggu   = Student::where('status', 'Menunggu Verifikasi')->count();

        $totalZonasi      = Student::where('jalur_pendaftaran', 'Zonasi')->count();
        $totalPrestasi    = Student::where('jalur_pendaftaran', 'Prestasi')->count();
        $totalAfirmasi    = Student::where('jalur_pendaftaran', 'Afirmasi')->count();
        $totalPerpindahan = Student::where('jalur_pendaftaran', 'Perpindahan')->count();

        $kuotaZonasi      = (int) Setting::get('kuota_zonasi', 120);
        $kuotaPrestasi    = (int) Setting::get('kuota_prestasi', 40);
        $kuotaAfirmasi    = (int) Setting::get('kuota_afirmasi', 20);
        $kuotaPerpindahan = (int) Setting::get('kuota_perpindahan', 10);
        $kuotaTotal       = $kuotaZonasi + $kuotaPrestasi + $kuotaAfirmasi + $kuotaPerpindahan;
        $pctTotal         = $kuotaTotal > 0 ? min(100, round(($totalStudents / $kuotaTotal) * 100)) : 0;

        $recentLogs = ActivityLog::with('user')->latest()->take(10)->get();

        return view('kepsek.dashboard', compact(
            'totalStudents', 'totalLaki', 'totalPerempuan',
            'totalDiterima', 'totalDitolak', 'totalMenunggu',
            'totalZonasi', 'totalPrestasi', 'totalAfirmasi', 'totalPerpindahan',
            'kuotaZonasi', 'kuotaPrestasi', 'kuotaAfirmasi', 'kuotaPerpindahan',
            'kuotaTotal', 'pctTotal', 'recentLogs'
        ));
    }
}


