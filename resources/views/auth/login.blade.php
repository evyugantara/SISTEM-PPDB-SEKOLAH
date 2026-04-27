<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - PPDB {{ \App\Models\Setting::get('school_name', 'Nama Sekolah') }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark-mode');
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background: linear-gradient(-45deg, #3b5998, #2a4374, #1a2a4c, #4b6aab);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
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
            background: rgba(255, 255, 255, 0.2);
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

        .login-box {
            position: relative;
            z-index: 10;
            background: rgba(255, 255, 255, 0.95);
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 380px;
            text-align: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.5);
            animation: fadeInBox 1s ease-out;
        }

        @keyframes fadeInBox {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-logo img {
            max-width: 90px;
            transition: transform 0.3s;
        }

        .login-logo img:hover {
            transform: scale(1.1) rotate(5deg);
        }

        .login-box h4 {
            color: var(--primary-color);
            margin: 15px 0 5px 0;
            font-weight: 700;
            font-size: 24px;
        }

        .login-box p {
            color: #6c757d;
            margin-bottom: 30px;
            font-size: 14px;
            font-weight: 500;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            transition: all 0.3s;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(59, 89, 152, 0.15);
        }

        .btn-primary {
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            font-size: 16px;
            background: linear-gradient(135deg, var(--primary-color), #2a4374);
            border: none;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(59, 89, 152, 0.4);
            background: linear-gradient(135deg, #2a4374, var(--primary-color));
        }

    </style>
</head>
<body>

    <ul class="circles">
        <li></li><li></li><li></li><li></li><li></li>
        <li></li><li></li><li></li><li></li><li></li>
    </ul>

    <div class="login-box">
        <div class="login-logo">
            <img src="{{ asset('images/tut.png') }}" alt="Logo Tut Wuri Handayani">
        </div>
        <h4>Admin PPDB</h4>
        <p>{{ \App\Models\Setting::get('school_name', 'Nama Sekolah') }}</p>

        @if ($errors->any())
            <div class="alert alert-danger" style="font-size: 13px; padding: 10px; border-radius: 8px; background: #fee2e2; color: #991b1b; border: 1px solid #fecaca;">
                <ul style="list-style: none; padding: 0; margin: 0;">
                    @foreach ($errors->all() as $error)
                        <li><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('login') }}" method="POST">
            @csrf
            <div class="form-group" style="text-align: left;">
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="Masukkan Email">
            </div>
            <div class="form-group" style="text-align: left; margin-top: 15px;">
                <input type="password" name="password" class="form-control" required placeholder="Masukkan Password">
            </div>
            <div class="form-group" style="margin-top: 25px;">
                <button type="submit" class="btn btn-primary" style="width: 100%;">Masuk ke Sistem</button>
            </div>
        </form>
    </div>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script src="{{ asset('js/dark-mode.js') }}"></script>
</body>
</html>


