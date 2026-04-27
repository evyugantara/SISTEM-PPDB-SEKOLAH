@extends('layouts.panitia')

@section('title', 'Dashboard Panitia')

@section('content')

<div class="alert-banner">
    Selamat Datang, {{ auth()->user()->name }} - Panel Operasional Panitia PPDB
</div>

<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 20px;">
    
    <div class="small-box bg-warning">
        <div class="inner">
            <h3>{{ $stats['Menunggu Verifikasi'] ?? 0 }}</h3>
            <p>Menunggu Verifikasi</p>
        </div>
        <div class="icon">
            <i class="fas fa-clock"></i>
        </div>
    </div>

    <div class="small-box bg-info">
        <div class="inner">
            <h3>{{ $stats['Lolos Verifikasi'] ?? 0 }}</h3>
            <p>Lolos Verifikasi</p>
        </div>
        <div class="icon">
            <i class="fas fa-check-circle"></i>
        </div>
    </div>

    <div class="small-box bg-danger">
        <div class="inner">
            <h3>{{ $stats['Berkas Tidak Sesuai'] ?? 0 }}</h3>
            <p>Berkas Bermasalah</p>
        </div>
        <div class="icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
    </div>

    <div class="small-box bg-success">
        <div class="inner">
            <h3>{{ $totalStudents ?? 0 }}</h3>
            <p>Total Pendaftar</p>
        </div>
        <div class="icon">
            <i class="fas fa-users"></i>
        </div>
    </div>

</div>

<div class="card">
    <div class="card-header">
        <h3><i class="fas fa-tasks"></i> Antrean Verifikasi Terbaru</h3>
        <a href="{{ route('students.index', ['status' => 'Menunggu Verifikasi']) }}" class="btn btn-primary btn-sm">Lihat Semua</a>
    </div>
    <div class="card-body">
        <table>
            <thead>
                <tr>
                    <th>No. Daftar</th>
                    <th>Nama Siswa</th>
                    <th>Jalur</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentStudents as $student)
                <tr>
                    <td>{{ $student->nomor_pendaftaran }}</td>
                    <td>{{ $student->nama_lengkap }}</td>
                    <td>{{ $student->jalur_pendaftaran }}</td>
                    <td><span class="badge bg-warning" style="padding: 3px 8px; border-radius: 3px; color: #000; font-size: 12px;">{{ $student->status }}</span></td>
                    <td>
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary btn-sm">Proses Berkas</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Tidak ada antrean saat ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection


