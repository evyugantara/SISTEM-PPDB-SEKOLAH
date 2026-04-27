<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran PPDB - {{ \App\Models\Setting::get('school_name', 'Nama Sekolah') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <style>
        :root {
            --primary-color: #3b5998;
            --secondary-color: #2a4374;
            --bg-color: #f4f6f9;
            --text-color: #333333;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: white;
            padding: 15px 50px;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 15px;
            text-decoration: none;
            color: var(--primary-color);
            font-weight: 700;
            font-size: 20px;
        }

        .navbar-brand img {
            height: 45px;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            color: var(--primary-color);
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 10px;
            margin-top: 30px;
            margin-bottom: 20px;
        }
        
        h2:first-child {
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }

        input[type="text"], input[type="date"], input[type="number"], input[type="email"], select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 15px;
            font-family: 'Inter', sans-serif;
        }

        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px dashed #ccc;
            border-radius: 4px;
            background: #fafafa;
        }
        
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .btn-submit {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            margin-top: 30px;
            transition: background 0.3s;
        }

        .btn-submit:hover {
            background-color: var(--secondary-color);
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }

        #map {
            height: 300px;
            width: 100%;
            border-radius: 4px;
            border: 1px solid #ccc;
            margin-top: 10px;
        }
        
        .help-text {
            font-size: 12px;
            color: #888;
            margin-top: 5px;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="/" class="navbar-brand">
            <img src="{{ asset('images/tut.png') }}" alt="Logo">
            <span>{{ \App\Models\Setting::get('school_name', 'Nama Sekolah') }}</span>
        </a>
    </nav>

    <div class="container">
        <div style="text-align: center; margin-bottom: 40px;">
            <h1 style="color: var(--primary-color); margin-bottom: 10px;">Formulir Pendaftaran Online PPDB</h1>
            <p style="color: #666;">Isilah data di bawah ini dengan lengkap dan benar sesuai dengan dokumen asli.</p>
        </div>

        @if ($errors->any())
            <div class="alert-error">
                <strong>Mohon perbaiki kesalahan berikut:</strong>
                <ul style="margin-top: 10px; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('public.storePendaftaran') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <h2>1. Data Pribadi Calon Siswa</h2>
            <div class="form-group">
                <label>Nama Lengkap *</label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
            </div>
            <div class="grid-2">
                <div class="form-group">
                    <label>NIK (16 Digit) *</label>
                    <input type="text" name="nik" value="{{ old('nik') }}" minlength="16" maxlength="16" required>
                </div>
                <div class="form-group">
                    <label>NISN *</label>
                    <input type="text" name="nisn" value="{{ old('nisn') }}" required>
                </div>
            </div>
            <div class="grid-2">
                <div class="form-group">
                    <label>Tempat Lahir *</label>
                    <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                </div>
                <div class="form-group">
                    <label>Tanggal Lahir *</label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                    <div class="help-text">Siswa harus berusia antara 6 hingga 12 tahun.</div>
                </div>
            </div>
            <div class="grid-2">
                <div class="form-group">
                    <label>Jenis Kelamin *</label>
                    <select name="jenis_kelamin" required>
                        <option value="">-- Pilih --</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Agama *</label>
                    <input type="text" name="agama" value="{{ old('agama') }}" required>
                </div>
            </div>
            <div class="form-group">
                <label>Alamat Lengkap *</label>
                <textarea name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
            </div>
            <div class="grid-2">
                <div class="form-group">
                    <label>Nomor HP (WhatsApp) *</label>
                    <input type="text" name="nomor_hp" value="{{ old('nomor_hp') }}" minlength="10" required placeholder="08xxx">
                    <div class="help-text">Nomor aktif untuk menerima pesan notifikasi otomatis.</div>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}">
                </div>
            </div>
            <div class="grid-2">
                <div class="form-group">
                    <label>Anak Ke- *</label>
                    <input type="number" name="anak_ke" value="{{ old('anak_ke') }}" required>
                </div>
                <div class="form-group">
                    <label>Jumlah Saudara *</label>
                    <input type="number" name="jumlah_saudara" value="{{ old('jumlah_saudara') }}" required>
                </div>
            </div>

            <h2>2. Data Sekolah Asal</h2>
            <div class="grid-2">
                <div class="form-group">
                    <label>Nama Sekolah Asal *</label>
                    <input type="text" name="nama_sekolah_asal" value="{{ old('nama_sekolah_asal') }}" required>
                </div>
                <div class="form-group">
                    <label>NPSN Sekolah *</label>
                    <input type="text" name="npsn_sekolah" value="{{ old('npsn_sekolah') }}" required>
                </div>
            </div>
            <div class="form-group">
                <label>Alamat Sekolah *</label>
                <textarea name="alamat_sekolah" rows="2" required>{{ old('alamat_sekolah') }}</textarea>
            </div>
            <div class="grid-2">
                <div class="form-group">
                    <label>Tahun Lulus *</label>
                    <input type="text" name="tahun_lulus" value="{{ old('tahun_lulus') }}" required>
                </div>
                <div class="form-group">
                    <label>Rata-rata Nilai Rapor *</label>
                    <input type="number" step="0.01" name="nilai_rapor" value="{{ old('nilai_rapor') }}" required>
                </div>
            </div>

            <h2>3. Data Orang Tua</h2>
            <div class="grid-2">
                <div class="form-group">
                    <label>Nama Ayah *</label>
                    <input type="text" name="nama_ayah" value="{{ old('nama_ayah') }}" required>
                </div>
                <div class="form-group">
                    <label>Nama Ibu *</label>
                    <input type="text" name="nama_ibu" value="{{ old('nama_ibu') }}" required>
                </div>
                <div class="form-group">
                    <label>NIK Ayah *</label>
                    <input type="text" name="nik_ayah" value="{{ old('nik_ayah') }}" required>
                </div>
                <div class="form-group">
                    <label>NIK Ibu *</label>
                    <input type="text" name="nik_ibu" value="{{ old('nik_ibu') }}" required>
                </div>
                <div class="form-group">
                    <label>Tempat, Tgl Lahir Ayah *</label>
                    <input type="text" name="tempat_tanggal_lahir_ayah" value="{{ old('tempat_tanggal_lahir_ayah') }}" required placeholder="Contoh: Bandung, 17 Agustus 1980">
                </div>
                <div class="form-group">
                    <label>Tempat, Tgl Lahir Ibu *</label>
                    <input type="text" name="tempat_tanggal_lahir_ibu" value="{{ old('tempat_tanggal_lahir_ibu') }}" required>
                </div>
                <div class="form-group">
                    <label>Pendidikan Ayah *</label>
                    <input type="text" name="pendidikan_ayah" value="{{ old('pendidikan_ayah') }}" required>
                </div>
                <div class="form-group">
                    <label>Pendidikan Ibu *</label>
                    <input type="text" name="pendidikan_ibu" value="{{ old('pendidikan_ibu') }}" required>
                </div>
                <div class="form-group">
                    <label>Pekerjaan Ayah *</label>
                    <input type="text" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}" required>
                </div>
                <div class="form-group">
                    <label>Pekerjaan Ibu *</label>
                    <input type="text" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}" required>
                </div>
                <div class="form-group" style="grid-column: span 2;">
                    <label>Penghasilan Rata-rata per Bulan *</label>
                    <select name="penghasilan_orang_tua" required>
                        <option value="">-- Pilih --</option>
                        <option value="< Rp 1.000.000" {{ old('penghasilan_orang_tua') == '< Rp 1.000.000' ? 'selected' : '' }}>< Rp 1.000.000</option>
                        <option value="Rp 1.000.000 - Rp 3.000.000" {{ old('penghasilan_orang_tua') == 'Rp 1.000.000 - Rp 3.000.000' ? 'selected' : '' }}>Rp 1.000.000 - Rp 3.000.000</option>
                        <option value="Rp 3.000.000 - Rp 5.000.000" {{ old('penghasilan_orang_tua') == 'Rp 3.000.000 - Rp 5.000.000' ? 'selected' : '' }}>Rp 3.000.000 - Rp 5.000.000</option>
                        <option value="> Rp 5.000.000" {{ old('penghasilan_orang_tua') == '> Rp 5.000.000' ? 'selected' : '' }}>> Rp 5.000.000</option>
                    </select>
                </div>
            </div>
            
            <div style="background: #f8f9fa; padding: 15px; margin-top: 20px; border-radius: 4px; border: 1px solid #eee;">
                <h3 style="margin-top: 0; font-size: 16px; margin-bottom: 15px;">Data Wali (Isi jika ikut wali)</h3>
                <div class="grid-2">
                    <div class="form-group">
                        <label>Nama Wali</label>
                        <input type="text" name="nama_wali" value="{{ old('nama_wali') }}">
                    </div>
                    <div class="form-group">
                        <label>Hubungan Wali</label>
                        <input type="text" name="hubungan_wali" value="{{ old('hubungan_wali') }}">
                    </div>
                    <div class="form-group">
                        <label>Pekerjaan Wali</label>
                        <input type="text" name="pekerjaan_wali" value="{{ old('pekerjaan_wali') }}">
                    </div>
                    <div class="form-group">
                        <label>Alamat Wali</label>
                        <input type="text" name="alamat_wali" value="{{ old('alamat_wali') }}">
                    </div>
                </div>
            </div>

            <h2>4. Jalur & Data Pendukung</h2>
            <div class="form-group">
                <label>Jalur Pendaftaran *</label>
                <select name="jalur_pendaftaran" required>
                    <option value="">-- Pilih --</option>
                    <option value="Zonasi" {{ old('jalur_pendaftaran') == 'Zonasi' ? 'selected' : '' }}>Zonasi</option>
                    <option value="Prestasi" {{ old('jalur_pendaftaran') == 'Prestasi' ? 'selected' : '' }}>Prestasi</option>
                    <option value="Afirmasi" {{ old('jalur_pendaftaran') == 'Afirmasi' ? 'selected' : '' }}>Afirmasi</option>
                    <option value="Perpindahan" {{ old('jalur_pendaftaran') == 'Perpindahan' ? 'selected' : '' }}>Perpindahan Tugas Orang Tua/Wali</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Titik Koordinat Rumah (Latitude, Longitude)</label>
                <input type="text" name="titik_koordinat" id="titik_koordinat" value="{{ old('titik_koordinat') }}" placeholder="-6.12345, 106.12345" readonly>
                <div class="help-text">Geser pin merah pada peta di bawah ini untuk menentukan lokasi rumah Anda.</div>
                <div id="map"></div>
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label>Data Prestasi (Opsional)</label>
                    <textarea name="data_prestasi" rows="2" placeholder="Sebutkan tingkat prestasi...">{{ old('data_prestasi') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Data Bantuan/KIP (Opsional)</label>
                    <textarea name="data_bantuan" rows="2" placeholder="Nomor KIP/PKH...">{{ old('data_bantuan') }}</textarea>
                </div>
            </div>

            <h2>5. Upload Berkas (Max 2MB per file)</h2>
            <div class="grid-2">
                <div class="form-group">
                    <label>Pas Foto Calon Siswa (JPG/PNG) *</label>
                    <input type="file" name="file_foto" accept=".jpg,.jpeg,.png" required>
                </div>
                <div class="form-group">
                    <label>Kartu Keluarga (PDF/JPG) *</label>
                    <input type="file" name="file_kk" accept=".pdf,.jpg,.jpeg,.png" required>
                </div>
                <div class="form-group">
                    <label>Akta Kelahiran (PDF/JPG) *</label>
                    <input type="file" name="file_akta" accept=".pdf,.jpg,.jpeg,.png" required>
                </div>
                <div class="form-group">
                    <label>KTP Orang Tua/Wali (PDF/JPG) *</label>
                    <input type="file" name="file_ktp_ortu" accept=".pdf,.jpg,.jpeg,.png" required>
                </div>
                <div class="form-group">
                    <label>Rapor (PDF/JPG)</label>
                    <input type="file" name="file_rapor" accept=".pdf,.jpg,.jpeg,.png">
                </div>
                <div class="form-group">
                    <label>Ijazah TK/PAUD (Jika ada, PDF/JPG)</label>
                    <input type="file" name="file_ijazah" accept=".pdf,.jpg,.jpeg,.png">
                </div>
                <div class="form-group" style="grid-column: span 2;">
                    <label>Sertifikat Prestasi (Jika jalur prestasi, PDF/JPG)</label>
                    <input type="file" name="file_prestasi" accept=".pdf,.jpg,.jpeg,.png">
                </div>
            </div>

            <div style="margin-top: 30px; border-top: 1px solid #eee; padding-top: 20px;">
                <label style="display: flex; gap: 10px; font-weight: normal; cursor: pointer;">
                    <input type="checkbox" required>
                    <span>Saya menyatakan bahwa seluruh data yang diisikan adalah benar dan dapat dipertanggungjawabkan. Jika terbukti ada pemalsuan data, saya bersedia menerima sanksi pembatalan kelulusan.</span>
                </label>
            </div>

            <button type="submit" class="btn-submit"><i class="fas fa-paper-plane"></i> Kirim Pendaftaran</button>
        </form>
    </div>

    
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var map = L.map('map').setView([-6.200000, 106.816666], 13);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);

            var marker = L.marker([-6.200000, 106.816666], {draggable: true}).addTo(map);

            function updateCoordinates(latlng) {
                document.getElementById('titik_koordinat').value = latlng.lat.toFixed(6) + ', ' + latlng.lng.toFixed(6);
            }
            updateCoordinates(marker.getLatLng());
            marker.on('dragend', function(e) {
                updateCoordinates(marker.getLatLng());
            });
            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                updateCoordinates(e.latlng);
            });
            map.locate({setView: true, maxZoom: 15});
            map.on('locationfound', function(e) {
                marker.setLatLng(e.latlng);
                updateCoordinates(e.latlng);
            });
        });
    </script>
</body>
</html>


