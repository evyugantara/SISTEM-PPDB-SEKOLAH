@extends('layouts.admin')

@section('title', 'Master Pengaturan PPDB')

@section('content')
<div class="row">
    <div class="col-md-12">
        <form action="{{ route('settings.store') }}" method="POST">
            @csrf
            
            <div class="card mb-4">
                <div class="card-header bg-dark text-white">
                    <h3 class="card-title m-0"><i class="fas fa-school"></i> Identitas Sekolah (Sistem Universal)</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Sekolah</label>
                                <input type="text" class="form-control" name="school_name" value="{{ $settings['school_name'] ?? 'Nama Sekolah' }}" placeholder="Contoh: SDN Mekarlaksana">
                                <small class="text-muted">Nama ini akan muncul di seluruh header, footer, dan title website.</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Alamat Sekolah</label>
                                <input type="text" class="form-control" name="school_address" value="{{ $settings['school_address'] ?? 'Jl. Alamat Sekolah No. 123' }}" placeholder="Alamat lengkap sekolah">
                                <small class="text-muted">Alamat ini akan muncul di footer halaman depan dan bukti pendaftaran.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title m-0"><i class="fas fa-calendar-alt"></i> Pengaturan Jadwal & Status Sistem</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Status Pendaftaran PPDB</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="system_active" name="system_active" value="1" {{ ($settings['system_active'] ?? '1') == '1' ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="system_active">Buka / Aktif</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tanggal Buka Pendaftaran</label>
                                <input type="date" class="form-control" name="tgl_buka" value="{{ $settings['tgl_buka'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tanggal Tutup Pendaftaran</label>
                                <input type="date" class="form-control" name="tgl_tutup" value="{{ $settings['tgl_tutup'] ?? '' }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h3 class="card-title m-0"><i class="fas fa-chart-pie"></i> Pengaturan Kuota & Seleksi Otomatis</h3>
                </div>
                <div class="card-body">
                    <h5>Bobot Kriteria Seleksi (%)</h5>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>Bobot Nilai Rapor</label>
                            <input type="number" class="form-control" name="bobot_rapor" value="{{ $settings['bobot_rapor'] ?? '50' }}" max="100">
                        </div>
                        <div class="col-md-4">
                            <label>Bobot Jarak Rumah</label>
                            <input type="number" class="form-control" name="bobot_jarak" value="{{ $settings['bobot_jarak'] ?? '30' }}" max="100">
                        </div>
                        <div class="col-md-4">
                            <label>Bobot Prestasi</label>
                            <input type="number" class="form-control" name="bobot_prestasi" value="{{ $settings['bobot_prestasi'] ?? '20' }}" max="100">
                        </div>
                    </div>
                    
                    <h5>Kuota Jalur Pendaftaran (Orang)</h5>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Zonasi</label>
                            <input type="number" class="form-control" name="kuota_zonasi" value="{{ $settings['kuota_zonasi'] ?? '120' }}">
                        </div>
                        <div class="col-md-3">
                            <label>Prestasi</label>
                            <input type="number" class="form-control" name="kuota_prestasi" value="{{ $settings['kuota_prestasi'] ?? '40' }}">
                        </div>
                        <div class="col-md-3">
                            <label>Afirmasi</label>
                            <input type="number" class="form-control" name="kuota_afirmasi" value="{{ $settings['kuota_afirmasi'] ?? '20' }}">
                        </div>
                        <div class="col-md-3">
                            <label>Perpindahan Tugas</label>
                            <input type="number" class="form-control" name="kuota_perpindahan" value="{{ $settings['kuota_perpindahan'] ?? '10' }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title m-0"><i class="fas fa-bell"></i> Pengaturan Notifikasi WhatsApp</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="custom-control custom-switch mb-3">
                            <input type="checkbox" class="custom-control-input" id="wa_notif_aktif" name="wa_notif_aktif" value="1" {{ ($settings['wa_notif_aktif'] ?? '0') == '1' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="wa_notif_aktif">Aktifkan Notifikasi WhatsApp Otomatis</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>WhatsApp API URL (Contoh: Fonnte / Wablas)</label>
                                <input type="text" class="form-control" name="wa_api_url" value="{{ $settings['wa_api_url'] ?? '' }}" placeholder="https://api.fonnte.com/send">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>API Token / Key</label>
                                <input type="text" class="form-control" name="wa_api_token" value="{{ $settings['wa_api_token'] ?? '' }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-right mb-5">
                <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-save"></i> Simpan Pengaturan</button>
            </div>
        </form>
    </div>
</div>
@endsection


