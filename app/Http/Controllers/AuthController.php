<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan Form Register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses Register
    public function register(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:30|unique:users,username',
            'dob' => 'required|date|before_or_equal:' . now()->subYears(15)->format('Y-m-d'), 
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
            ],
        ], [
            'dob.before_or_equal' => 'Anda harus berusia minimal 15 tahun untuk mendaftar.',
            'password.regex' => 'Password harus mengandung kombinasi huruf besar, kecil, dan angka.',
            'username.unique' => 'Username sudah digunakan, silakan pilih yang lain.'
        ]);

        // 2. Simpan ke Database
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'dob' => $request->dob, // Pastikan menggunakan kolom 'dob' sesuai migrasi terakhir
            'password' => Hash::make($request->password),
            'role' => 'customer', // Default saat daftar adalah customer
        ]);

        // 3. Login & Redirect
        Auth::login($user);

        return redirect('/')->with('success', 'Akun berhasil dibuat!');
    }

    // Tampilkan Form Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses Login (MODIFIKASI REDIRECT ROLE)
    public function login(Request $request)
    {
        // 1. Validasi
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Coba Login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            /** * LOGIKA PENGALIHAN BERDASARKAN ROLE
             * Jika role adalah admin, arahkan ke dashboard Filament.
             * Jika customer, arahkan ke halaman home bioskop.
             */
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin');
            }

            return redirect()->intended('/');
        }

        // 3. Jika Gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}