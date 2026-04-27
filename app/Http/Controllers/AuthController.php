<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($credentials)) {

            if (!auth()->user()->is_active) {
                auth()->logout();
                return back()->withErrors([
                    'email' => 'Akun Anda sedang nonaktif. Hubungi Administrator.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();
            \App\Models\ActivityLog::log('Login ke sistem PPDB');

            $role = auth()->user()->role;
            if ($role === 'Panitia') {
                return redirect()->route('panitia.dashboard');
            } elseif ($role === 'Kepala Sekolah') {
                return redirect()->route('kepsek.dashboard');
            }

            return redirect()->intended('admin');
        }

        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan data kami.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}


