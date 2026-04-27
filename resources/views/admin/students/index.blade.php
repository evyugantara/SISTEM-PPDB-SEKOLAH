@extends(auth()->user()->role === 'Panitia' ? 'layouts.panitia' : (auth()->user()->role === 'Kepala Sekolah' ? 'layouts.kepsek' : 'layouts.admin'))

@section('title', 'Data Calon Siswa')

@section('content')
<div class="card">
    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
        <h3>Daftar Siswa Pendaftar</h3>
        
        <form action="{{ route('students.index') }}" method="GET" style="display: flex; gap: 10px; flex-grow: 1; max-width: 400px; margin: 0 20px;">
            <input type="text" name="search" class="form-control" placeholder="Cari Nama atau NISN..." value="{{ request('search') }}" style="margin-bottom: 0;">
            <button type="submit" class="btn btn-primary" style="padding: 8px 15px;"><i class="fas fa-search"></i></button>
        </form>

        @if(auth()->user()->role !== 'Kepala Sekolah')
        <a href="{{ route('students.create') }}" class="btn btn-primary" style="white-space: nowrap;">+ Tambah Siswa Baru</a>
        @endif
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No. Daftar</th>
                        <th>NISN</th>
                        <th>Nama Lengkap</th>
                        <th>Status</th>
                        <th>L/P</th>
                        <th>Tempat, Tgl Lahir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $index => $student)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $student->nomor_pendaftaran ?? '-' }}</strong></td>
                            <td><strong>{{ $student->nisn }}</strong></td>
                            <td>{{ $student->nama_lengkap }}</td>
                            <td>
                                @if($student->status == 'Diterima')
                                    <span class="badge" style="background-color: #28a745; color: white; padding: 4px 8px; border-radius: 4px;">{{ $student->status }}</span>
                                @elseif($student->status == 'Ditolak')
                                    <span class="badge" style="background-color: #dc3545; color: white; padding: 4px 8px; border-radius: 4px;">{{ $student->status }}</span>
                                @elseif($student->status == 'Berkas Tidak Sesuai')
                                    <span class="badge" style="background-color: #fd7e14; color: white; padding: 4px 8px; border-radius: 4px;">{{ $student->status }}</span>
                                @else
                                    <span class="badge" style="background-color: #6c757d; color: white; padding: 4px 8px; border-radius: 4px;">{{ $student->status }}</span>
                                @endif
                            </td>
                            <td>{{ $student->jenis_kelamin == 'Laki-laki' ? 'L' : 'P' }}</td>
                            <td>{{ $student->tempat_lahir }}, {{ \Carbon\Carbon::parse($student->tanggal_lahir)->format('d M Y') }}</td>
                            <td>
                                <div class="action-btns" style="display: flex; gap: 5px;">
                                    <a href="{{ route('students.show', $student->id) }}" class="btn btn-sm btn-info" style="color:white;"><i class="fas fa-eye"></i> Detail</a>
                                    
                                    @if(auth()->user()->role !== 'Kepala Sekolah')
                                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-primary" style="background-color: #f39c12; border-color: #f39c12;"><i class="fas fa-edit"></i> Edit</a>
                                    @endif
                                    
                                    @if(auth()->user()->role === 'Admin')
                                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" id="delete-form-{{ $student->id }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $student->id }})"><i class="fas fa-trash"></i></button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Belum ada data siswa yang mendaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Data siswa beserta file dokumen yang diunggah akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    })
}
</script>
@endpush
@endsection


