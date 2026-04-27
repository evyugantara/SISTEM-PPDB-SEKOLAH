@extends('layouts.admin')

@section('title', 'Manajemen User & Hak Akses')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title"><i class="fas fa-user-plus"></i> Tambah User Baru</h3>
            </div>
            <div class="card-body">

                
                @if ($errors->any())
                <div style="background: #f8d7da; color: #721c24; padding: 12px 15px; border-radius: 6px; margin-bottom: 15px; border: 1px solid #f5c6cb; font-size: 13px;">
                    <strong><i class="fas fa-exclamation-triangle"></i> Mohon perbaiki kesalahan berikut:</strong>
                    <ul style="margin: 8px 0 0 0; padding-left: 18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('users.store') }}" method="POST" id="form-tambah-user">
                    @csrf
                    <div class="form-group">
                        <label>Nama Lengkap <span style="color:red;">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Username <span style="color:red;">*</span></label>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Email <span style="color:red;">*</span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Role <span style="color:red;">*</span></label>
                        <select name="role" class="form-control" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="Panitia" {{ old('role') == 'Panitia' ? 'selected' : '' }}>Panitia</option>
                            <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="Kepala Sekolah" {{ old('role') == 'Kepala Sekolah' ? 'selected' : '' }}>Kepala Sekolah</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Password <span style="color:red;">*</span></label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        <small style="color:#888;">Minimal 8 karakter</small>
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password <span style="color:red;">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" checked>
                            <label class="custom-control-label" for="is_active">Akun Aktif</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-save"></i> Simpan User
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header" style="display:flex; justify-content:space-between; align-items:center;">
                <h3 class="card-title">Daftar Pengguna Sistem ({{ $users->count() }} akun)</h3>
            </div>
            <div class="card-body" style="padding:0;">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" style="margin:0;">
                        <thead style="background-color: #3b5998; color: white;">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $user->name }}</strong></td>
                                <td>{{ $user->username }}</td>
                                <td style="font-size:12px;">{{ $user->email }}</td>
                                <td>
                                    <span style="padding: 3px 10px; border-radius: 10px; font-size: 12px; color: white; background-color:
                                        {{ $user->role === 'Admin' ? '#dc3545' : ($user->role === 'Kepala Sekolah' ? '#6f42c1' : '#17a2b8') }};">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td>
                                    @if($user->is_active)
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-danger">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    @if($user->id !== auth()->id())
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" id="del-user-{{ $user->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger" onclick="konfirmasiHapusUser({{ $user->id }}, '{{ $user->name }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @else
                                    <span style="font-size:11px; color:#aaa;">(Akun Anda)</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada pengguna.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        
        <div class="card" style="margin-top:15px; background:#f8f9fa; border-left: 5px solid #3b5998;">
            <div class="card-body" style="padding: 15px;">
                <h5 style="margin:0 0 10px 0; color:#3b5998;"><i class="fas fa-info-circle"></i> Info Login per Role</h5>
                <table style="font-size: 13px; width:100%;">
                    <tr><td style="padding:3px 8px;"><span style="background:#dc3545;color:white;padding:2px 8px;border-radius:8px;font-size:11px;">Admin</span></td><td>Login → diarahkan ke <code>/admin</code></td></tr>
                    <tr><td style="padding:3px 8px;"><span style="background:#17a2b8;color:white;padding:2px 8px;border-radius:8px;font-size:11px;">Panitia</span></td><td>Login → diarahkan ke <code>/panitia</code></td></tr>
                    <tr><td style="padding:3px 8px;"><span style="background:#6f42c1;color:white;padding:2px 8px;border-radius:8px;font-size:11px;">Kepala Sekolah</span></td><td>Login → diarahkan ke <code>/kepsek</code></td></tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
@if ($errors->any())
    Swal.fire({
        icon: 'error',
        title: 'Gagal Menyimpan!',
        html: `<div style="text-align:left; font-size:14px;"><ul style="padding-left:20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul></div>`,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Perbaiki'
    });
@endif

function konfirmasiHapusUser(id, nama) {
    Swal.fire({
        title: 'Hapus User?',
        html: `Akun <strong>${nama}</strong> akan dihapus permanen dari sistem.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('del-user-' + id).submit();
        }
    });
}
</script>
@endpush


