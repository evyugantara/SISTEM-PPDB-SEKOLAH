<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ActivityLog;

class PanitiaController extends Controller
{
    public function dashboard()
    {
        $totalStudents = Student::count();
        
        $stats = [
            'Menunggu Verifikasi' => Student::where('status', 'Menunggu Verifikasi')->count(),
            'Lolos Verifikasi' => Student::where('status', 'Lolos Verifikasi')->count(),
            'Berkas Tidak Sesuai' => Student::where('status', 'Berkas Tidak Sesuai')->count(),
            'Diterima' => Student::where('status', 'Diterima')->count(),
            'Ditolak' => Student::where('status', 'Ditolak')->count(),
        ];

        $recentStudents = Student::where('status', 'Menunggu Verifikasi')
                                   ->latest()
                                   ->take(5)
                                   ->get();

        $recentLogs = ActivityLog::with('user')
                                 ->where('user_id', auth()->id())
                                 ->latest()
                                 ->take(5)
                                 ->get();

        return view('panitia.dashboard', compact('totalStudents', 'stats', 'recentStudents', 'recentLogs'));
    }
}


