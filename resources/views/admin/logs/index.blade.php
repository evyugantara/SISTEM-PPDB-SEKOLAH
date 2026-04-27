@extends('layouts.admin')

@section('title', 'Log Aktivitas Sistem')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Riwayat Aktivitas Pengguna</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>No</th>
                        <th>Waktu</th>
                        <th>User</th>
                        <th>Role</th>
                        <th>Aktivitas</th>
                        <th>IP Address</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $index => $log)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                            <td>{{ $log->user ? $log->user->name : 'Sistem' }}</td>
                            <td>
                                <span class="badge badge-info">{{ $log->role ?? 'Sistem' }}</span>
                            </td>
                            <td>{{ $log->activity }}</td>
                            <td>{{ $log->ip_address }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada log aktivitas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


