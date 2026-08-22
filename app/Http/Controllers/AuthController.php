<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    // Tampilkan halaman login[cite: 9]
    public function showLogin() {
        return view('auth.login');
    }

    // Tampilkan halaman register[cite: 9]
    public function showRegister() {
        return view('auth.register');
    }

    // Proses Simpan Akun Otomatis dari Register[cite: 9]
    public function register(Request $request) {
        // Validasi input termasuk konfirmasi password[cite: 9]
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // 'confirmed' mencari input name="password_confirmation"[cite: 9]
        ]);

        // Simpan akun otomatis ke database[cite: 9]
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan masuk.');
    }

    // Proses Login Pengguna (Menangani aksi masuk ke sistem)
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Mencocokkan kredensial dengan data di database
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Jika berhasil, arahkan ke dashboard user
            return redirect()->route('user.dashboard');
        }

        // Jika gagal, kembalikan ke halaman login dengan pesan kesalahan
        return back()->withErrors([
            'email' => 'Email atau kata sandi yang Anda masukkan salah.',
        ])->onlyInput('email');
    }
}
