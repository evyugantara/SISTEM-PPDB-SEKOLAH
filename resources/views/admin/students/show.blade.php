@extends(auth()->user()->role === 'Panitia' ? 'layouts.panitia' : (auth()->user()->role === 'Kepala Sekolah' ? 'layouts.kepsek' : 'layouts.admin'))

@section('title', 'Detail Siswa')

@section('content')
<div class="card" style="max-width: 1000px; margin: 0 auto;">
    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
        <h3>Detail Data Siswa: {{ $student->nama_lengkap }}</h3>
        <div>
            <a href="{{ route('students.cetak', $student->id) }}" target="_blank" class="btn btn-sm btn-success" style="margin-right: 5px;"><i class="fas fa-print"></i> Cetak Bukti</a>
            
            @if(auth()->user()->role !== 'Kepala Sekolah')
            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-primary" style="background-color: #f39c12; border-color: #f39c12; margin-right: 5px; color: white;"><i class="fas fa-edit"></i> Edit Data</a>
            @endif
            
            <a href="{{ route('students.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
        </div>
    </div>
    
    <div class="card-body" style="padding: 30px;">
        
        <h4 style="border-bottom: 2px solid #3b5998; padding-bottom: 5px; color: #3b5998;"><i class="fas fa-user"></i> 1. Data Pribadi Siswa</h4>
        <table style="width: 100%; margin-bottom: 30px; font-size: 14px;">
            <tr><td style="width: 30%; padding: 8px 0; font-weight: bold;">Nama Lengkap</td><td style="padding: 8px 0;">: {{ $student->nama_lengkap }}</td></tr>
            <tr><td style="padding: 8px 0; font-weight: bold;">NISN</td><td style="padding: 8px 0;">: {{ $student->nisn }}</td></tr>
            <tr><td style="padding: 8px 0; font-weight: bold;">NIK</td><td style="padding: 8px 0;">: {{ $student->nik }}</td></tr>
            <tr><td style="padding: 8px 0; font-weight: bold;">Jenis Kelamin</td><td style="padding: 8px 0;">: {{ $student->jenis_kelamin }}</td></tr>
            <tr><td style="padding: 8px 0; font-weight: bold;">Tempat, Tanggal Lahir</td><td style="padding: 8px 0;">: {{ $student->tempat_lahir }}, {{ \Carbon\Carbon::parse($student->tanggal_lahir)->format('d M Y') }}</td></tr>
            <tr><td style="padding: 8px 0; font-weight: bold;">Agama</td><td style="padding: 8px 0;">: {{ $student->agama }}</td></tr>
            <tr><td style="padding: 8px 0; font-weight: bold;">Alamat Lengkap</td><td style="padding: 8px 0;">: {{ $student->alamat }}</td></tr>
            <tr><td style="padding: 8px 0; font-weight: bold;">Nomor HP</td><td style="padding: 8px 0;">: {{ $student->nomor_hp }}</td></tr>
            <tr><td style="padding: 8px 0; font-weight: bold;">Email</td><td style="padding: 8px 0;">: {{ $student->email ?? '-' }}</td></tr>
            <tr><td style="padding: 8px 0; font-weight: bold;">Anak Ke-</td><td style="padding: 8px 0;">: {{ $student->anak_ke }} dari {{ $student->jumlah_saudara }} bersaudara</td></tr>
        </table>

        
        <h4 style="border-bottom: 2px solid #3b5998; padding-bottom: 5px; color: #3b5998;"><i class="fas fa-school"></i> 2. Data Sekolah Asal</h4>
        <table style="width: 100%; margin-bottom: 30px; font-size: 14px;">
            <tr><td style="width: 30%; padding: 8px 0; font-weight: bold;">Nama Sekolah Asal</td><td style="padding: 8px 0;">: {{ $student->nama_sekolah_asal }}</td></tr>
            <tr><td style="padding: 8px 0; font-weight: bold;">NPSN Sekolah</td><td style="padding: 8px 0;">: {{ $student->npsn_sekolah }}</td></tr>
            <tr><td style="padding: 8px 0; font-weight: bold;">Alamat Sekolah</td><td style="padding: 8px 0;">: {{ $student->alamat_sekolah }}</td></tr>
            <tr><td style="padding: 8px 0; font-weight: bold;">Tahun Lulus</td><td style="padding: 8px 0;">: {{ $student->tahun_lulus }}</td></tr>
            <tr><td style="padding: 8px 0; font-weight: bold;">Nilai Rapor / Ujian</td><td style="padding: 8px 0;">: {{ $student->nilai_rapor }}</td></tr>
        </table>

        
        <h4 style="border-bottom: 2px solid #3b5998; padding-bottom: 5px; color: #3b5998;"><i class="fas fa-users"></i> 3. Data Orang Tua</h4>
        <table style="width: 100%; margin-bottom: 30px; font-size: 14px;">
            <tr><td style="width: 30%; padding: 8px 0; font-weight: bold;">Nama Ayah</td><td style="padding: 8px 0;">: {{ $student->nama_ayah }}</td></tr>
            <tr><td style="padding: 8px 0; font-weight: bold;">NIK Ayah</td><td style="padding: 8px 0;">: {{ $student->nik_ayah }}</td></tr>
            <tr><td style="padding: 8px 0; font-weight: bold;">Tempat, Tgl Lahir Ayah</td><td style="padding: 8px 0;">: {{ $student->tempat_tanggal_lahir_ayah }}</td></tr>
            <tr><td style="padding: 8px 0; font-weight: bold;">Pendidikan Ayah</td><td style="padding: 8px 0;">: {{ $student->pendidikan_ayah }}</td></tr>
            <tr><td style="padding: 8px 0; font-weight: bold;">Pekerjaan Ayah</td><td style="padding: 8px 0;">: {{ $student->pekerjaan_ayah }}</td></tr>
            <tr><td colspan="2"><hr style="margin: 10px 0; border: 0; border-top: 1px dashed #ccc;"></td></tr>
            <tr><td style="padding: 8px 0; font-weight: bold;">Nama Ibu</td><td style="padding: 8px 0;">: {{ $student->nama_ibu }}</td></tr>
            <tr><td style="padding: 8px 0; font-weight: bold;">NIK Ibu</td><td style="padding: 8px 0;">: {{ $student->nik_ibu }}</td></tr>
            <tr><td style="padding: 8px 0; font-weight: bold;">Tempat, Tgl Lahir Ibu</td><td style="padding: 8px 0;">: {{ $student->tempat_tanggal_lahir_ibu }}</td></tr>
            <tr><td style="padding: 8px 0; font-weight: bold;">Pendidikan Ibu</td><td style="padding: 8px 0;">: {{ $student->pendidikan_ibu }}</td></tr>
            <tr><td style="padding: 8px 0; font-weight: bold;">Pekerjaan Ibu</td><td style="padding: 8px 0;">: {{ $student->pekerjaan_ibu }}</td></tr>
            <tr><td colspan="2"><hr style="margin: 10px 0; border: 0; border-top: 1px dashed #ccc;"></td></tr>
            <tr><td style="padding: 8px 0; font-weight: bold;">Penghasilan Orang Tua</td><td style="padding: 8px 0;">: {{ $student->penghasilan_orang_tua }}</td></tr>
        </table>

        
        <h4 style="border-bottom: 2px solid #3b5998; padding-bottom: 5px; color: #3b5998;"><i class="fas fa-user-shield"></i> 4. Data Wali</h4>
        <table style="width: 100%; margin-bottom: 30px; font-size: 14px;">
            <tr><td style="width: 30%; padding: 8px 0; font-weight: bold;">Nama Wali</td><td style="padding: 8px 0;">: {{ $student->nama_wali ?? '-' }}</td></tr>
            <tr><td style="padding: 8px 0; font-weight: bold;">Hubungan dengan Siswa</td><td style="padding: 8px 0;">: {{ $student->hubungan_wali ?? '-' }}</td></tr>
            <tr><td style="padding: 8px 0; font-weight: bold;">Pekerjaan Wali</td><td style="padding: 8px 0;">: {{ $student->pekerjaan_wali ?? '-' }}</td></tr>
            <tr><td style="padding: 8px 0; font-weight: bold;">Alamat Wali</td><td style="padding: 8px 0;">: {{ $student->alamat_wali ?? '-' }}</td></tr>
        </table>

        
        <h4 style="border-bottom: 2px solid #3b5998; padding-bottom: 5px; color: #3b5998;"><i class="fas fa-info-circle"></i> 5. Data Pendukung & Status</h4>
        <table style="width: 100%; margin-bottom: 30px; font-size: 14px;">
            <tr>
                <td style="width: 30%; padding: 8px 0; font-weight: bold;">Status Seleksi / Kelulusan</td>
                <td style="padding: 8px 0;">: 
                    @if($student->status == 'Diterima')
                        <strong style="color: #28a745; font-size: 16px;">{{ $student->status }}</strong>
                    @elseif($student->status == 'Ditolak')
                        <strong style="color: #dc3545; font-size: 16px;">{{ $student->status }}</strong>
                    @elseif($student->status == 'Berkas Tidak Sesuai')
                        <strong style="color: #fd7e14; font-size: 16px;">{{ $student->status }}</strong>
                    @else
                        <strong style="color: #6c757d; font-size: 16px;">{{ $student->status }}</strong>
                    @endif
                </td>
            </tr>
            <tr><td style="padding: 8px 0; font-weight: bold;">Jalur Pendaftaran</td><td style="padding: 8px 0;">: <strong>{{ $student->jalur_pendaftaran }}</strong></td></tr>
            <tr><td style="padding: 8px 0; font-weight: bold;">Titik Koordinat Rumah</td><td style="padding: 8px 0;">: {{ $student->titik_koordinat ?? '-' }}</td></tr>
            <tr><td style="padding: 8px 0; font-weight: bold;">Data Prestasi</td><td style="padding: 8px 0;">: {{ $student->data_prestasi ?? '-' }}</td></tr>
            <tr><td style="padding: 8px 0; font-weight: bold;">Data Bantuan</td><td style="padding: 8px 0;">: {{ $student->data_bantuan ?? '-' }}</td></tr>
        </table>

        
        <h4 style="border-bottom: 2px solid #3b5998; padding-bottom: 5px; color: #3b5998;"><i class="fas fa-file-alt"></i> 6. Dokumen Pendukung</h4>
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin-bottom: 20px;">
            @php
                $docs = [
                    'Kartu Keluarga' => $student->file_kk,
                    'Akta Kelahiran' => $student->file_akta,
                    'KTP Orang Tua' => $student->file_ktp_ortu,
                    'Pas Foto' => $student->file_foto,
                    'Ijazah/SKL' => $student->file_ijazah,
                    'Rapor' => $student->file_rapor,
                    'Sertifikat Prestasi' => $student->file_prestasi,
                ];
            @endphp
            @foreach($docs as $label => $file)
                <div style="border: 1px solid #ddd; padding: 10px; border-radius: 5px; text-align: center;">
                    <strong style="display: block; margin-bottom: 10px; font-size: 14px;">{{ $label }}</strong>
                    @if($file)
                        <a href="{{ asset('storage/'.$file) }}" target="_blank" class="btn btn-sm btn-info" style="color: white; font-size: 12px;"><i class="fas fa-download"></i> Lihat Dokumen</a>
                    @else
                        <span style="color: #999; font-size: 12px; font-style: italic;">Tidak Ada File</span>
                    @endif
                </div>
            @endforeach
        </div>

    </div>
</div>
@endsection


