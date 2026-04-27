@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')

<div class="alert-banner">
    Selamat Datang di PPDB - {{ \App\Models\Setting::get('school_name', 'Nama Sekolah') }}
</div>

<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 20px;">
    
    <div class="small-box bg-info">
        <div class="inner">
            <h3 style="font-size: 24px;">ZONASI</h3>
            <p>{{ $totalZonasi ?? 0 }} / {{ $kuotaZonasi ?? 120 }} Kuota</p>
            <div style="background-color: rgba(0,0,0,0.2); height: 8px; border-radius: 4px; margin-top: 10px;">
                <div style="background-color: white; width: {{ $pctZonasi ?? 0 }}%; height: 100%; border-radius: 4px;"></div>
            </div>
        </div>
        <div class="icon"><i class="fas fa-map-marked-alt"></i></div>
    </div>
    
    <div class="small-box bg-warning">
        <div class="inner">
            <h3 style="font-size: 24px;">PRESTASI</h3>
            <p>{{ $totalPrestasi ?? 0 }} / {{ $kuotaPrestasi ?? 40 }} Kuota</p>
            <div style="background-color: rgba(0,0,0,0.2); height: 8px; border-radius: 4px; margin-top: 10px;">
                <div style="background-color: white; width: {{ $pctPrestasi ?? 0 }}%; height: 100%; border-radius: 4px;"></div>
            </div>
        </div>
        <div class="icon"><i class="fas fa-graduation-cap"></i></div>
    </div>
    
    <div class="small-box bg-success">
        <div class="inner">
            <h3 style="font-size: 24px;">AFIRMASI</h3>
            <p>{{ $totalAfirmasi ?? 0 }} / {{ $kuotaAfirmasi ?? 20 }} Kuota</p>
            <div style="background-color: rgba(0,0,0,0.2); height: 8px; border-radius: 4px; margin-top: 10px;">
                <div style="background-color: white; width: {{ $pctAfirmasi ?? 0 }}%; height: 100%; border-radius: 4px;"></div>
            </div>
        </div>
        <div class="icon"><i class="fas fa-id-card"></i></div>
    </div>

    <div class="small-box bg-danger">
        <div class="inner">
            <h3 style="font-size: 24px;">PERPINDAHAN</h3>
            <p>{{ $totalPerpindahan ?? 0 }} / {{ $kuotaPerpindahan ?? 10 }} Kuota</p>
            <div style="background-color: rgba(0,0,0,0.2); height: 8px; border-radius: 4px; margin-top: 10px;">
                <div style="background-color: white; width: {{ $pctPerpindahan ?? 0 }}%; height: 100%; border-radius: 4px;"></div>
            </div>
        </div>
        <div class="icon"><i class="fas fa-exchange-alt"></i></div>
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 20px;">
    <div class="small-box bg-teal">
        <div class="inner">
            <h3>{{ $totalStudents ?? 0 }}</h3>
            <p>Total Pendaftar</p>
        </div>
        <div class="icon"><i class="fas fa-users"></i></div>
        <a href="{{ route('students.index') }}" style="color: rgba(255,255,255,0.8); font-size: 13px;">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
    </div>

    <div class="small-box bg-purple">
        <div class="inner">
            <h3>{{ $totalLaki ?? 0 }}</h3>
            <p>Laki-laki</p>
        </div>
        <div class="icon"><i class="fas fa-user"></i></div>
        <a href="{{ route('students.index', ['gender' => 'Laki-laki']) }}" style="color: rgba(255,255,255,0.8); font-size: 13px;">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
    </div>

    <div class="small-box bg-primary">
        <div class="inner">
            <h3>{{ $totalPerempuan ?? 0 }}</h3>
            <p>Perempuan</p>
        </div>
        <div class="icon"><i class="fas fa-user"></i></div>
        <a href="{{ route('students.index', ['gender' => 'Perempuan']) }}" style="color: rgba(255,255,255,0.8); font-size: 13px;">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
    </div>

    <div class="small-box bg-warning">
        <div class="inner">
            <h3>{{ $totalBerkasTidakSesuai ?? 0 }}</h3>
            <p>Perlu Verifikasi</p>
        </div>
        <div class="icon"><i class="fas fa-file-invoice"></i></div>
        <a href="{{ route('students.index', ['status' => 'Berkas Tidak Sesuai']) }}" style="color: rgba(0,0,0,0.5); font-size: 13px;">Lihat detail <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

@endsection


