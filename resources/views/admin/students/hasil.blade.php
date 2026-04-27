@extends(auth()->user()->role === 'Panitia' ? 'layouts.panitia' : (auth()->user()->role === 'Kepala Sekolah' ? 'layouts.kepsek' : 'layouts.admin'))

@section('title', 'Hasil Pendaftaran & Seleksi')

@section('content')
<div class="card">
    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
        <h3>Daftar Hasil Seleksi Calon Siswa</h3>
        <form action="{{ route('students.hasil') }}" method="GET" style="display: flex; gap: 10px; max-width: 300px;">
            <input type="text" name="search" class="form-control" placeholder="Cari..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No. Daftar</th>
                        <th>Nama Lengkap</th>
                        <th>Jalur</th>
                        <th>Nilai Akhir</th>
                        <th>Status Akhir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $index => $student)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $student->nomor_pendaftaran }}</td>
                            <td><strong>{{ $student->nama_lengkap }}</strong></td>
                            <td>{{ $student->jalur_pendaftaran }}</td>
                            <td><span class="badge badge-info" style="font-size: 14px; background: #3b5998; color: white; padding: 4px 10px; border-radius: 5px;">{{ $student->nilai_akhir_seleksi ?? '0' }}</span></td>
                            <td>
                                @if($student->status == 'Diterima')
                                    <span class="badge" style="background-color: #28a745; color: white; padding: 5px 10px; border-radius: 5px;">Diterima</span>
                                @elseif($student->status == 'Ditolak')
                                    <span class="badge" style="background-color: #dc3545; color: white; padding: 5px 10px; border-radius: 5px;">Ditolak</span>
                                @else
                                    <span class="badge" style="background-color: #6c757d; color: white; padding: 5px 10px; border-radius: 5px;">{{ $student->status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('students.show', $student->id) }}" class="btn btn-sm btn-info" style="color:white;"><i class="fas fa-eye"></i> Detail</a>
                                <a href="{{ route('students.cetak', $student->id) }}" target="_blank" class="btn btn-sm btn-secondary"><i class="fas fa-print"></i> Cetak Bukti</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Data hasil seleksi belum tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


