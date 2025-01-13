<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function login()
    {
        return view('auth.login'); // Pastikan view 'auth/login.blade.php' ada
    }

    // Proses otentikasi
    public function authenticate(Request $request)
    {
        // Validasi input dengan password minimal 9 karakter
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:9',
        ]);

        // Cek kredensial untuk login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Ambil data admin
            $admin = Auth::user();

            // Menampilkan Toast setelah login sukses
            toast('Selamat datang ' . $admin->nama, 'success');

            // Redirect berdasarkan peran
            if ($admin->peran->nama_peran === 'Owner') {
                return redirect()->route('owner.dashboard');
            } elseif ($admin->peran->nama_peran === 'Admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->intended('/');
        }

        // Validasi jika username atau password salah
        toast('Username atau password salah!', 'error');
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Menampilkan toast setelah logout berhasil
        toast('Berhasil logout!', 'info');
        return redirect('/login');
    }
}
