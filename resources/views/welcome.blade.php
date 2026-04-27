<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal PPDB - {{ \App\Models\Setting::get('school_name', 'Nama Sekolah') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark-mode');
        }
    </script>
    <style>
        :root {
            --primary-color: #3b5998; 
            --secondary-color: #2a4374;
            --accent-color: #ffc107; 
            --bg-color: #f4f6f9; 
            --text-color: #333333;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        
        .navbar {
            background-color: white;
            padding: 15px 50px;
            display: flex;
            justify-content: space-between;
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

        .login-btn {
            background-color: var(--primary-color);
            color: white;
            padding: 8px 16px;
            border-radius: 4px; 
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.2s ease-in-out;
            border: 1px solid var(--primary-color);
        }

        .login-btn:hover {
            background-color: #2a4374;
            border-color: #2a4374;
            transform: none;
            box-shadow: none;
        }

        
        .hero {
            background: linear-gradient(-45deg, #3b5998, #2a4374, #1a2a4c, #4b6aab);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            color: white;
            padding: 80px 20px;
            text-align: center;
            position: relative;
            overflow: hidden; 
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        
        .circles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
            margin: 0;
            padding: 0;
        }

        .circles li {
            position: absolute;
            display: block;
            list-style: none;
            width: 20px;
            height: 20px;
            background: rgba(255, 255, 255, 0.15);
            animation: animate 25s linear infinite;
            bottom: -150px;
            border-radius: 50%;
        }

        .circles li:nth-child(1) { left: 25%; width: 80px; height: 80px; animation-delay: 0s; }
        .circles li:nth-child(2) { left: 10%; width: 20px; height: 20px; animation-delay: 2s; animation-duration: 12s; }
        .circles li:nth-child(3) { left: 70%; width: 20px; height: 20px; animation-delay: 4s; }
        .circles li:nth-child(4) { left: 40%; width: 60px; height: 60px; animation-delay: 0s; animation-duration: 18s; }
        .circles li:nth-child(5) { left: 65%; width: 20px; height: 20px; animation-delay: 0s; }
        .circles li:nth-child(6) { left: 75%; width: 110px; height: 110px; animation-delay: 3s; }
        .circles li:nth-child(7) { left: 35%; width: 150px; height: 150px; animation-delay: 7s; }
        .circles li:nth-child(8) { left: 50%; width: 25px; height: 25px; animation-delay: 15s; animation-duration: 45s; }
        .circles li:nth-child(9) { left: 20%; width: 15px; height: 15px; animation-delay: 2s; animation-duration: 35s; }
        .circles li:nth-child(10) { left: 85%; width: 150px; height: 150px; animation-delay: 0s; animation-duration: 11s; }

        @keyframes animate {
            0% { transform: translateY(0) rotate(0deg); opacity: 1; border-radius: 0; }
            100% { transform: translateY(-1000px) rotate(720deg); opacity: 0; border-radius: 50%; }
        }

        .hero h1 {
            font-size: 42px;
            margin-bottom: 20px;
            font-weight: 800;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
            position: relative;
            z-index: 10;
        }

        .hero p {
            font-size: 18px;
            max-width: 600px;
            margin: 0 auto 40px auto;
            line-height: 1.6;
            opacity: 0.9;
            position: relative;
            z-index: 10;
        }

        
        .search-container {
            background: white;
            max-width: 650px;
            margin: -40px auto 40px auto;
            padding: 20px;
            border-radius: 4px;
            box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
            position: relative;
            z-index: 10;
        }

        .search-container h3 {
            color: var(--primary-color);
            margin-bottom: 20px;
            font-size: 22px;
            text-align: center;
        }

        .search-form {
            display: flex;
            gap: 15px;
        }

        .search-input {
            flex-grow: 1;
            padding: 10px 15px;
            font-size: 16px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            outline: none;
            transition: border-color 0.15s ease-in-out;
        }

        .search-input:focus {
            border-color: var(--secondary-color);
        }

        .search-btn {
            background-color: var(--primary-color); 
            color: white;
            border: 1px solid var(--primary-color);
            padding: 0 30px;
            font-size: 14px;
            font-weight: 500;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .search-btn:hover {
            background-color: #2a4374;
            border-color: #2a4374;
            transform: none;
            box-shadow: none;
        }

        
        .result-card {
            max-width: 650px;
            margin: 0 auto 60px auto;
            background: white;
            border-radius: 4px;
            overflow: hidden;
            box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .result-header {
            background-color: var(--primary-color);
            color: white;
            padding: 15px 20px;
            font-weight: bold;
            font-size: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .result-body {
            padding: 30px;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .status-diterima { background-color: #28a745; color: white; }
        .status-ditolak { background-color: #dc3545; color: white; }
        .status-menunggu { background-color: #6c757d; color: white; }
        .status-berkas { background-color: #ffc107; color: #1f2d3d; }

        .student-info {
            display: grid;
            grid-template-columns: 120px 1fr;
            gap: 10px 15px;
            font-size: 16px;
        }

        .student-info strong {
            color: #64748b;
            font-weight: 600;
        }

        .error-msg {
            max-width: 650px;
            margin: 0 auto 60px auto;
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 4px;
            text-align: center;
            border: 1px solid #f5c6cb;
        }

        
        .footer {
            margin-top: auto;
            background-color: #343a40; 
            color: #c2c7d0;
            text-align: center;
            padding: 20px;
            font-size: 14px;
            border-top: 1px solid #dee2e6;
        }

        @media (max-width: 768px) {
            .navbar { padding: 15px 20px; }
            .hero h1 { font-size: 32px; }
            .search-form { flex-direction: column; }
            .search-btn { padding: 15px; justify-content: center; }
            .search-container { margin: -20px 15px 40px 15px; padding: 20px; }
        }

        
        .section-title {
            text-align: center;
            margin-bottom: 40px;
            color: var(--primary-color);
            position: relative;
        }

        .section-title::after {
            content: '';
            width: 60px;
            height: 4px;
            background: var(--accent-color);
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 60px 20px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .info-card {
            background: var(--white);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            text-align: center;
            transition: transform 0.3s ease;
            border: 1px solid var(--border-color);
        }

        .info-card:hover {
            transform: translateY(-10px);
        }

        .info-card i {
            font-size: 40px;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-item {
            background: var(--white);
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .stat-item h4 {
            font-size: 24px;
            color: var(--primary-color);
        }

        .stat-item p {
            font-size: 14px;
            color: #64748b;
        }

        .timeline {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
        }

        .timeline-item {
            padding: 20px 30px;
            position: relative;
            background: var(--white);
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            border-left: 5px solid var(--primary-color);
        }

        .timeline-item .date {
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 5px;
            display: block;
        }

        .whatsapp-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #25d366;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.2);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s;
        }

        .whatsapp-float:hover {
            transform: scale(1.1);
            color: white;
        }

        .dark-mode .info-card, .dark-mode .stat-item, .dark-mode .timeline-item {
            background: var(--white);
            color: var(--text-main);
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="/" class="navbar-brand">
            <img src="{{ asset('images/tut.png') }}" alt="Logo">
            <span>{{ \App\Models\Setting::get('school_name', 'Nama Sekolah') }}</span>
        </a>
        <div style="display: flex; gap: 10px; align-items: center;">
            <button id="theme-toggle" class="theme-toggle" style="background-color: var(--primary-color);">
                <i class="fas fa-moon"></i>
                <span>Dark Mode</span>
            </button>
            <a href="{{ url('/login') }}" class="login-btn"><i class="fas fa-lock"></i> Admin Panel</a>
        </div>
    </nav>

    <div class="hero">
        <ul class="circles">
            <li></li><li></li><li></li><li></li><li></li>
            <li></li><li></li><li></li><li></li><li></li>
        </ul>
        <h1>Penerimaan Peserta Didik Baru</h1>
        <p>Selamat datang di Portal Resmi PPDB {{ \App\Models\Setting::get('school_name', 'Nama Sekolah') }}. Silakan daftar secara online atau gunakan portal ini untuk mengecek status seleksi pendaftaran putra/putri Anda secara langsung.</p>
        <a href="{{ route('public.daftar') }}" style="position: relative; z-index: 10; display: inline-block; padding: 15px 30px; font-size: 18px; border-radius: 8px; text-decoration: none; margin-top: 10px; background-color: var(--accent-color); color: #1a2a4c; font-weight: bold; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: transform 0.2s;"><i class="fas fa-edit"></i> Daftar Sekarang</a>
    </div>

    @if(session('success'))
        <div style="max-width: 650px; margin: -20px auto 40px auto; background-color: #d4edda; color: #155724; padding: 15px; border-radius: 4px; text-align: center; border: 1px solid #c3e6cb; position: relative; z-index: 10;">
            <i class="fas fa-check-circle fa-2x" style="margin-bottom: 10px;"></i>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="search-container">
        <h3><i class="fas fa-search"></i> Cek Status Pendaftaran</h3>
        <form action="{{ route('cek-status') }}" method="POST" class="search-form">
            @csrf
            <input type="text" name="nisn" class="search-input" placeholder="Masukkan NISN Siswa..." value="{{ old('nisn') }}" required>
            <button type="submit" class="search-btn">Cari Data</button>
        </form>
    </div>

    @if(session('error'))
        <div class="error-msg">
            <i class="fas fa-exclamation-circle fa-2x" style="margin-bottom: 10px;"></i>
            <p>{{ session('error') }}</p>
        </div>
    @endif

    @if(session('result'))
        @php $student = session('result'); @endphp
        
        <div style="max-width: 900px; margin: 0 auto 60px auto; animation: fadeIn 0.5s ease;">
            
            @if($student->status == 'Diterima')
            
                <div style="background-color: var(--primary-color); color: white; padding: 40px; border-radius: 8px 8px 0 0; position: relative; overflow: hidden;">
                    <h2 style="font-size: 36px; font-weight: bold; margin-bottom: 10px;">Selamat !</h2>
                    <p style="font-size: 18px; margin: 0; opacity: 0.9;">Anda dinyatakan <strong>diterima</strong> pada seleksi PPDB {{ \App\Models\Setting::get('school_name', 'Nama Sekolah') }}.</p>
                    <i class="fas fa-user-check" style="position: absolute; right: 50px; bottom: -30px; font-size: 180px; opacity: 0.15;"></i>
                </div>
            @elseif($student->status == 'Ditolak')
           
                <div style="background-color: #dc3545; color: white; padding: 40px; border-radius: 8px 8px 0 0; position: relative; overflow: hidden;">
                    <h2 style="font-size: 36px; font-weight: bold; margin-bottom: 10px;">Mohon Maaf</h2>
                    <p style="font-size: 18px; margin: 0; opacity: 0.9;">Anda dinyatakan <strong>tidak diterima</strong> pada seleksi PPDB kali ini.</p>
                    <i class="fas fa-user-times" style="position: absolute; right: 50px; bottom: -30px; font-size: 180px; opacity: 0.15;"></i>
                </div>
            @elseif($student->status == 'Berkas Tidak Sesuai')
               
                <div style="background-color: #ffc107; color: #333; padding: 40px; border-radius: 8px 8px 0 0; position: relative; overflow: hidden;">
                    <h2 style="font-size: 36px; font-weight: bold; margin-bottom: 10px;">Perhatian !</h2>
                    <p style="font-size: 18px; margin: 0; opacity: 0.9;">Berkas Anda <strong>kurang/tidak sesuai</strong>. Harap hubungi panitia PPDB segera.</p>
                    <i class="fas fa-exclamation-triangle" style="position: absolute; right: 50px; bottom: -30px; font-size: 180px; opacity: 0.15;"></i>
                </div>
            @else
                
                <div style="background-color: #6c757d; color: white; padding: 40px; border-radius: 8px 8px 0 0; position: relative; overflow: hidden;">
                    <h2 style="font-size: 36px; font-weight: bold; margin-bottom: 10px;">Data Diterima</h2>
                    <p style="font-size: 18px; margin: 0; opacity: 0.9;">Data Anda sedang <strong>menunggu verifikasi</strong> oleh panitia PPDB.</p>
                    <i class="fas fa-clock" style="position: absolute; right: 50px; bottom: -30px; font-size: 180px; opacity: 0.15;"></i>
                </div>
            @endif

            <div style="background-color: white; padding: 30px; border-radius: 0 0 8px 8px; box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2); display: flex; justify-content: space-between; align-items: center; border: 1px solid #ced4da; border-top: none; flex-wrap: wrap; gap: 20px;">
                
                <div style="display: flex; gap: 40px; flex-wrap: wrap;">
                  
                    <div style="display: flex; gap: 15px; align-items: flex-start;">
                        <i class="fas fa-user-graduate" style="font-size: 24px; color: var(--text-color); margin-top: 5px; opacity: 0.7;"></i>
                        <div>
                            <div style="font-size: 12px; color: #6c757d; margin-bottom: 3px;">Nama Lengkap</div>
                            <div style="font-weight: 600; font-size: 16px; color: var(--primary-color);">{{ $student->nama_lengkap }}</div>
                            <div style="font-size: 13px; color: #6c757d; margin-top: 2px;">NISN: {{ $student->nisn }}</div>
                        </div>
                    </div>

                  
                    <div style="display: flex; gap: 15px; align-items: flex-start;">
                        <i class="fas fa-school" style="font-size: 24px; color: var(--text-color); margin-top: 5px; opacity: 0.7;"></i>
                        <div>
                            <div style="font-size: 12px; color: #6c757d; margin-bottom: 3px;">Asal Sekolah</div>
                            <div style="font-weight: 500; font-size: 15px;">{{ $student->nama_sekolah_asal }}</div>
                        </div>
                    </div>

                  
                    <div style="display: flex; gap: 15px; align-items: flex-start;">
                        <i class="fas fa-map-signs" style="font-size: 24px; color: var(--text-color); margin-top: 5px; opacity: 0.7;"></i>
                        <div>
                            <div style="font-size: 12px; color: #6c757d; margin-bottom: 3px;">Jalur Pendaftaran</div>
                            <div style="font-weight: 500; font-size: 15px;">Jalur {{ $student->jalur_pendaftaran }}</div>
                        </div>
                    </div>
                </div>

               
                @if($student->status == 'Diterima' || $student->status == 'Menunggu Verifikasi')
                <div>
                    <a href="{{ route('public.cetak', $student->nisn) }}" target="_blank" class="search-btn" style="text-decoration: none; padding: 12px 25px; white-space: nowrap; font-size: 15px;">
                        Cetak Bukti Penerimaan
                    </a>
                </div>
                @endif

            </div>
        </div>
    @endif

    <div class="container" style="padding-top: 0;">
        <div class="stats-grid">
            <div class="stat-item">
                <p>Kuota Tersedia</p>
                <h4>{{ $stats['kuota_total'] ?? 0 }}</h4>
            </div>
            <div class="stat-item">
                <p>Total Pendaftar</p>
                <h4>{{ $stats['total_pendaftar'] ?? 0 }}</h4>
            </div>
            <div class="stat-item">
                <p>Sisa Kuota</p>
                <h4>{{ ($stats['kuota_total'] ?? 0) - ($stats['total_pendaftar'] ?? 0) }}</h4>
            </div>
        </div>
    </div>

  
    <div class="container" id="alur">
        <h2 class="section-title">Alur Pendaftaran</h2>
        <div class="grid">
            <div class="info-card">
                <i class="fas fa-file-signature"></i>
                <h3>1. Registrasi</h3>
                <p>Mengisi formulir pendaftaran melalui tombol "Daftar Sekarang" dengan data yang benar.</p>
            </div>
            <div class="info-card">
                <i class="fas fa-cloud-upload-alt"></i>
                <h3>2. Unggah Berkas</h3>
                <p>Mengunggah scan dokumen asli (KK, Akta, Rapor) sesuai persyaratan yang ditentukan.</p>
            </div>
            <div class="info-card">
                <i class="fas fa-user-check"></i>
                <h3>3. Verifikasi</h3>
                <p>Panitia akan melakukan validasi dokumen. Anda bisa cek status secara berkala.</p>
            </div>
            <div class="info-card">
                <i class="fas fa-bullhorn"></i>
                <h3>4. Pengumuman</h3>
                <p>Hasil seleksi akhir dapat dilihat melalui portal ini pada tanggal yang ditentukan.</p>
            </div>
        </div>
    </div>

   
    <div style="background-color: var(--white); padding: 80px 0;">
        <div class="container">
            <h2 class="section-title">Persyaratan Dokumen</h2>
            <div class="grid">
                <div style="background: var(--bg-color); padding: 25px; border-radius: 8px;">
                    <ul style="list-style: none; line-height: 2.5;">
                        <li><i class="fas fa-check-circle" style="color: #28a745; margin-right: 10px;"></i> Fotokopi Kartu Keluarga</li>
                        <li><i class="fas fa-check-circle" style="color: #28a745; margin-right: 10px;"></i> Akta Kelahiran Asli / Fotokopi</li>
                        <li><i class="fas fa-check-circle" style="color: #28a745; margin-right: 10px;"></i> Ijazah TK / Surat Keterangan Lulus</li>
                        <li><i class="fas fa-check-circle" style="color: #28a745; margin-right: 10px;"></i> Pas Foto 3x4 (Background Merah)</li>
                        <li><i class="fas fa-check-circle" style="color: #28a745; margin-right: 10px;"></i> KTP Orang Tua (Ayah & Ibu)</li>
                    </ul>
                </div>
                <div>
                    <img src="{{ asset('images/requirements.png') }}" style="width: 100%; border-radius: 12px; box-shadow: 0 10px 20px rgba(0,0,0,0.1);" alt="Requirements">
                </div>
            </div>
        </div>
    </div>

  
    <div class="container">
        <h2 class="section-title">Jadwal Penting</h2>
        <div class="timeline">
            <div class="timeline-item">
                <span class="date">{{ \Carbon\Carbon::parse($stats['tgl_buka'])->format('d F Y') }} - {{ \Carbon\Carbon::parse($stats['tgl_tutup'])->format('d F Y') }}</span>
                <h3>Pendaftaran Online</h3>
                <p>Pengisian formulir dan unggah berkas melalui portal website.</p>
            </div>
            <div class="timeline-item">
                <span class="date">Awal Juli 2026</span>
                <h3>Verifikasi & Validasi Lapangan</h3>
                <p>Pemeriksaan keaslian berkas dan verifikasi alamat (Zonasi) jika diperlukan.</p>
            </div>
            <div class="timeline-item">
                <span class="date">10 Juli 2026</span>
                <h3>Pengumuman Hasil Seleksi</h3>
                <p>Dapat dilihat langsung melalui menu "Cek Status" di website ini.</p>
            </div>
        </div>
    </div>

    <div style="background-color: var(--primary-color); color: white; padding: 80px 0; text-align: center;">
        <div class="container">
            <h2 style="margin-bottom: 20px; font-size: 32px;">Mengapa {{ \App\Models\Setting::get('school_name', 'Nama Sekolah') }}?</h2>
            <p style="max-width: 800px; margin: 0 auto 40px auto; opacity: 0.9;">Kami berkomitmen memberikan pendidikan dasar yang berkualitas dengan fasilitas modern dan tenaga pengajar profesional untuk mencetak generasi yang cerdas, berkarakter, dan religius.</p>
            <div class="grid">
                <div>
                    <i class="fas fa-medal" style="font-size: 40px; margin-bottom: 15px;"></i>
                    <h4>Akreditasi A</h4>
                </div>
                <div>
                    <i class="fas fa-laptop-code" style="font-size: 40px; margin-bottom: 15px;"></i>
                    <h4>Fasilitas Lab IT</h4>
                </div>
                <div>
                    <i class="fas fa-heart" style="font-size: 40px; margin-bottom: 15px;"></i>
                    <h4>Ekstrakurikuler Lengkap</h4>
                </div>
            </div>
        </div>
    </div>

    <a href="https://wa.me/085" class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <footer class="footer">
        <p>&copy; 2026 {{ \App\Models\Setting::get('school_name', 'Nama Sekolah') }}. All Rights Reserved.</p>
        <p style="font-size: 12px; margin-top: 5px; opacity: 0.7;">{{ \App\Models\Setting::get('school_address', 'Jl. Alamat Sekolah No. 123') }}</p>
    </footer>

    <script src="{{ asset('js/dark-mode.js') }}"></script>
</body>
</html>


