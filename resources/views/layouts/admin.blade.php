<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - PPDB [NAMA SEKOLAH]</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark-mode');
        }
    </script>
</head>
<body class="sidebar-mini layout-fixed">
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-mode');
        }
    </script>
    <div class="wrapper">
        
        <header class="main-header">
            <div class="logo">
                <i class="fas fa-bars"></i>
                PPDB ADMIN
            </div>
            <div class="user-menu" style="display: flex; align-items: center; gap: 15px;">
                <button id="theme-toggle" class="theme-toggle">
                    <i class="fas fa-moon"></i>
                    <span>Dark Mode</span>
                </button>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <img src="{{ asset('images/tut.png') }}" alt="User" style="width: 40px; height: 40px; border-radius: 50%;">
                    <span style="font-weight: 600; font-size: 14px;">{{ auth()->user()->name }}</span>
                </div>
            </div>
        </header>

        
        <aside class="sidebar">
            <ul class="sidebar-menu">
                <li style="padding: 15px 20px; font-size: 18px; color: white; background-color: rgba(0,0,0,0.1); border-bottom: 1px solid rgba(255,255,255,0.1);">
                    <img src="{{ asset('images/tut.png') }}" style="width: 30px; margin-right: 10px;">
                    Dashboard
                </li>
                <li style="padding: 10px 20px; font-size: 12px; text-transform: uppercase; color: #8a909d; margin-top: 10px;">Menu Utama</li>
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin') ? 'active' : '' }}">
                        <i class="fas fa-home"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('students.index') }}" class="{{ request()->is('manage/students') || request()->is('manage/students/create') ? 'active' : '' }}">
                        <i class="fas fa-users"></i> <span>Data Pendaftar</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('students.hasil') }}" class="{{ request()->is('manage/hasil') ? 'active' : '' }}">
                        <i class="fas fa-list-alt"></i> <span>Hasil Pendaftaran</span>
                    </a>
                </li>

                <li style="padding: 10px 20px; font-size: 12px; text-transform: uppercase; color: #8a909d; margin-top: 10px;">Manajemen Sistem</li>
                <li>
                    <a href="{{ route('users.index') }}" class="{{ request()->is('admin/users*') ? 'active' : '' }}">
                        <i class="fas fa-user-cog"></i> <span>Manajemen User</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('settings.index') }}" class="{{ request()->is('admin/settings*') ? 'active' : '' }}">
                        <i class="fas fa-cogs"></i> <span>Pengaturan PPDB</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logs.index') }}" class="{{ request()->is('manage/logs*') ? 'active' : '' }}">
                        <i class="fas fa-history"></i> <span>Log Aktivitas</span>
                    </a>
                </li>

                <li style="padding: 10px 20px; font-size: 12px; text-transform: uppercase; color: #8a909d; margin-top: 10px;">Akun</li>
                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </aside>

        
        <div class="content-wrapper">
            <div class="content-header">
                <h1>@yield('title')</h1>
            </div>
            <section class="content">
                @yield('content')
            </section>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}", confirmButtonColor: '#3085d6' });
        @endif
        @if (session('error'))
            Swal.fire({ icon: 'error', title: 'Gagal!', text: "{{ session('error') }}", confirmButtonColor: '#d33' });
        @endif
    </script>
    <script src="{{ asset('js/dark-mode.js') }}"></script>
    @stack('scripts')
</body>
</html>


