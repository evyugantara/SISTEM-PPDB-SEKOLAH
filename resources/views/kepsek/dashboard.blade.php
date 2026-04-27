@extends('layouts.kepsek')

@section('title', 'Dashboard Monitoring')

@section('content')

<div class="alert-banner" style="background-color: #3b5998;">
    Panel Monitoring Kepala Sekolah - PPDB SDN Mekarlaksana
</div>

<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 20px;">
    
    @foreach($quotaStats as $stat)
    <div class="small-box bg-primary">
        <div class="inner">
            <h3 style="font-size: 24px;">{{ $stat['terisi'] }} / {{ $stat['kuota'] }}</h3>
            <p>{{ $stat['jalur'] }}</p>
            <div style="background: rgba(0,0,0,0.2); height: 8px; border-radius: 4px; margin-top: 10px;">
                <div style="background: white; width: {{ $stat['persen'] }}%; height: 100%; border-radius: 4px;"></div>
            </div>
        </div>
        <div class="icon">
            <i class="fas fa-chart-bar"></i>
        </div>
    </div>
    @endforeach

</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
    <div class="card">
        <div class="card-header">
            <h3><i class="fas fa-chart-line"></i> Grafik Pendaftaran</h3>
        </div>
        <div class="card-body">
            <canvas id="trendChart" style="height: 300px; width: 100%;"></canvas>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3><i class="fas fa-print"></i> Laporan</h3>
        </div>
        <div class="card-body">
            <div style="display: grid; gap: 10px;">
                <a href="{{ route('students.exportExcel') }}" class="btn btn-primary" style="text-align: center; background-color: #28a745;"><i class="fas fa-file-excel"></i> Export ke Excel</a>
                <a href="{{ route('students.hasil') }}" class="btn btn-primary" style="text-align: center;"><i class="fas fa-list-alt"></i> Lihat Hasil Seleksi</a>
                <a href="{{ route('logs.index') }}" class="btn btn-primary" style="text-align: center; background-color: #343a40;"><i class="fas fa-history"></i> Cek Log Aktivitas</a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('trendChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($dailyStats->pluck('date')) !!},
            datasets: [{
                label: 'Pendaftar',
                data: {!! json_encode($dailyStats->pluck('count')) !!},
                borderColor: '#3b5998',
                backgroundColor: 'rgba(59, 89, 152, 0.1)',
                fill: true,
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
@endpush


