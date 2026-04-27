@extends(auth()->user()->role === 'Panitia' ? 'layouts.panitia' : (auth()->user()->role === 'Kepala Sekolah' ? 'layouts.kepsek' : 'layouts.admin'))

@section('title', 'Tambah Data Siswa')

@section('content')
<div class="card" style="max-width: 1000px; margin: 0 auto;">
    <div class="card-header">
        <h3>Formulir Pendaftaran Siswa Baru Lengkap</h3>
        <a href="{{ route('students.index') }}" class="btn btn-sm btn-danger">Kembali</a>
    </div>
    
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            
            <h4 style="border-bottom: 2px solid var(--primary-color); padding-bottom: 5px; margin-top: 20px; color: var(--primary-color);">1. Data Pribadi Siswa</h4>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label>Nama Lengkap *</label>
                    <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap') }}" required>
                </div>
                <div class="form-group">
                    <label>NISN *</label>
                    <input type="text" name="nisn" class="form-control" value="{{ old('nisn') }}" required>
                </div>
                <div class="form-group">
                    <label>NIK *</label>
                    <input type="text" name="nik" class="form-control" value="{{ old('nik') }}" required>
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin *</label>
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tempat Lahir *</label>
                    <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir') }}" required>
                </div>
                <div class="form-group">
                    <label>Tanggal Lahir *</label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}" required>
                </div>
                <div class="form-group">
                    <label>Agama *</label>
                    <input type="text" name="agama" class="form-control" value="{{ old('agama') }}" required>
                </div>
                <div class="form-group">
                    <label>Nomor HP *</label>
                    <input type="text" name="nomor_hp" class="form-control" value="{{ old('nomor_hp') }}" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                    <div class="form-group">
                        <label>Anak Ke- *</label>
                        <input type="number" name="anak_ke" class="form-control" value="{{ old('anak_ke') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Jml Saudara *</label>
                        <input type="number" name="jumlah_saudara" class="form-control" value="{{ old('jumlah_saudara') }}" required>
                    </div>
                </div>
                <div class="form-group" style="grid-column: 1 / -1;">
                    <label>Alamat Lengkap *</label>
                    <textarea name="alamat" rows="2" class="form-control" required>{{ old('alamat') }}</textarea>
                </div>
            </div>

            
            <h4 style="border-bottom: 2px solid var(--primary-color); padding-bottom: 5px; margin-top: 30px; color: var(--primary-color);">2. Data Sekolah Asal</h4>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label>Nama Sekolah Asal *</label>
                    <input type="text" name="nama_sekolah_asal" class="form-control" value="{{ old('nama_sekolah_asal') }}" required>
                </div>
                <div class="form-group">
                    <label>NPSN Sekolah *</label>
                    <input type="text" name="npsn_sekolah" class="form-control" value="{{ old('npsn_sekolah') }}" required>
                </div>
                <div class="form-group" style="grid-column: 1 / -1;">
                    <label>Alamat Sekolah *</label>
                    <textarea name="alamat_sekolah" rows="2" class="form-control" required>{{ old('alamat_sekolah') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Tahun Lulus *</label>
                    <input type="text" name="tahun_lulus" class="form-control" value="{{ old('tahun_lulus') }}" required>
                </div>
                <div class="form-group">
                    <label>Nilai Rapor / Ujian *</label>
                    <input type="text" name="nilai_rapor" class="form-control" value="{{ old('nilai_rapor') }}" required>
                </div>
            </div>

            
            <h4 style="border-bottom: 2px solid var(--primary-color); padding-bottom: 5px; margin-top: 30px; color: var(--primary-color);">3. Data Orang Tua</h4>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label>Nama Ayah *</label>
                    <input type="text" name="nama_ayah" class="form-control" value="{{ old('nama_ayah') }}" required>
                </div>
                <div class="form-group">
                    <label>Nama Ibu *</label>
                    <input type="text" name="nama_ibu" class="form-control" value="{{ old('nama_ibu') }}" required>
                </div>
                <div class="form-group">
                    <label>NIK Ayah *</label>
                    <input type="text" name="nik_ayah" class="form-control" value="{{ old('nik_ayah') }}" required>
                </div>
                <div class="form-group">
                    <label>NIK Ibu *</label>
                    <input type="text" name="nik_ibu" class="form-control" value="{{ old('nik_ibu') }}" required>
                </div>
                <div class="form-group">
                    <label>Tempat, Tgl Lahir Ayah *</label>
                    <input type="text" name="tempat_tanggal_lahir_ayah" class="form-control" value="{{ old('tempat_tanggal_lahir_ayah') }}" required>
                </div>
                <div class="form-group">
                    <label>Tempat, Tgl Lahir Ibu *</label>
                    <input type="text" name="tempat_tanggal_lahir_ibu" class="form-control" value="{{ old('tempat_tanggal_lahir_ibu') }}" required>
                </div>
                <div class="form-group">
                    <label>Pendidikan Terakhir Ayah *</label>
                    <input type="text" name="pendidikan_ayah" class="form-control" value="{{ old('pendidikan_ayah') }}" required>
                </div>
                <div class="form-group">
                    <label>Pendidikan Terakhir Ibu *</label>
                    <input type="text" name="pendidikan_ibu" class="form-control" value="{{ old('pendidikan_ibu') }}" required>
                </div>
                <div class="form-group">
                    <label>Pekerjaan Ayah *</label>
                    <input type="text" name="pekerjaan_ayah" class="form-control" value="{{ old('pekerjaan_ayah') }}" required>
                </div>
                <div class="form-group">
                    <label>Pekerjaan Ibu *</label>
                    <input type="text" name="pekerjaan_ibu" class="form-control" value="{{ old('pekerjaan_ibu') }}" required>
                </div>
                <div class="form-group" style="grid-column: 1 / -1;">
                    <label>Penghasilan Orang Tua (Per Bulan) *</label>
                    <input type="text" name="penghasilan_orang_tua" class="form-control" value="{{ old('penghasilan_orang_tua') }}" required>
                </div>
            </div>

            
            <h4 style="border-bottom: 2px solid var(--primary-color); padding-bottom: 5px; margin-top: 30px; color: var(--primary-color);">4. Data Wali (Jika Ada)</h4>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label>Nama Wali</label>
                    <input type="text" name="nama_wali" class="form-control" value="{{ old('nama_wali') }}">
                </div>
                <div class="form-group">
                    <label>Hubungan dengan Siswa</label>
                    <input type="text" name="hubungan_wali" class="form-control" value="{{ old('hubungan_wali') }}">
                </div>
                <div class="form-group">
                    <label>Pekerjaan Wali</label>
                    <input type="text" name="pekerjaan_wali" class="form-control" value="{{ old('pekerjaan_wali') }}">
                </div>
                <div class="form-group">
                    <label>Alamat Wali</label>
                    <textarea name="alamat_wali" rows="1" class="form-control">{{ old('alamat_wali') }}</textarea>
                </div>
            </div>

            
            <h4 style="border-bottom: 2px solid var(--primary-color); padding-bottom: 5px; margin-top: 30px; color: var(--primary-color);">5. Data Pendukung / Lainnya</h4>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label>Jalur Pendaftaran *</label>
                    <select name="jalur_pendaftaran" class="form-control" required>
                        <option value="Zonasi" {{ old('jalur_pendaftaran') == 'Zonasi' ? 'selected' : '' }}>Zonasi</option>
                        <option value="Prestasi" {{ old('jalur_pendaftaran') == 'Prestasi' ? 'selected' : '' }}>Prestasi</option>
                        <option value="Afirmasi" {{ old('jalur_pendaftaran') == 'Afirmasi' ? 'selected' : '' }}>Afirmasi</option>
                        <option value="Perpindahan" {{ old('jalur_pendaftaran') == 'Perpindahan' ? 'selected' : '' }}>Perpindahan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Titik Koordinat Rumah (Untuk Zonasi)</label>
                    <input type="text" name="titik_koordinat" class="form-control" value="{{ old('titik_koordinat') }}">
                </div>
                <div class="form-group">
                    <label>Data Prestasi (Jika Ada)</label>
                    <input type="text" name="data_prestasi" class="form-control" value="{{ old('data_prestasi') }}">
                </div>
                <div class="form-group">
                    <label>Data Bantuan (KIP/KKS, Jika Ada)</label>
                    <input type="text" name="data_bantuan" class="form-control" value="{{ old('data_bantuan') }}">
                </div>
            </div>

            
            <h4 style="border-bottom: 2px solid var(--primary-color); padding-bottom: 5px; margin-top: 30px; color: var(--primary-color);">6. Dokumen Pendukung (Unggah File)</h4>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label>Kartu Keluarga (KK)</label>
                    <input type="file" name="file_kk" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                </div>
                <div class="form-group">
                    <label>Akta Kelahiran</label>
                    <input type="file" name="file_akta" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                </div>
                <div class="form-group">
                    <label>KTP Orang Tua</label>
                    <input type="file" name="file_ktp_ortu" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                </div>
                <div class="form-group">
                    <label>Pas Foto</label>
                    <input type="file" name="file_foto" class="form-control" accept=".jpg,.jpeg,.png">
                </div>
                <div class="form-group">
                    <label>Ijazah / SKL</label>
                    <input type="file" name="file_ijazah" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                </div>
                <div class="form-group">
                    <label>Rapor</label>
                    <input type="file" name="file_rapor" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                </div>
                <div class="form-group">
                    <label>Sertifikat Prestasi (Jika Ada)</label>
                    <input type="file" name="file_prestasi" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                </div>
            </div>

            <hr style="margin: 30px 0; border: 0; border-top: 1px solid #eee;">

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg" style="width: 100%; font-size: 18px; padding: 12px;"><i class="fas fa-save"></i> Simpan Semua Data</button>
            </div>
        </form>
    </div>
</div>
@endsection


