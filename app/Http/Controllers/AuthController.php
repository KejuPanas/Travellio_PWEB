<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ... (Fungsi showLogin dan showRegister Anda) ...

    public function register(Request $request)
    {
        // 1. Validasi data yang masuk
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed', 
            // Catatan: Hapus atau abaikan input 'phone' dari validasi jika tabel users Anda belum memiliki kolom phone.
        ]);

        // 2. Simpan user baru ke database
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password), // Password harus di-hash (enkripsi)
        ]);

        // 3. Otomatiskan login setelah register berhasil
        Auth::login($user);

        // 4. Arahkan ke halaman utama dengan pesan sukses
        return redirect('/')->with('success', 'Akun berhasil dibuat! Selamat datang di VoyageEase.');
    }

    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // 2. Coba cocokkan email dan password dengan database
        $remember = $request->has('remember'); // Untuk fitur "Remember me"
        
        if (Auth::attempt($credentials, $remember)) {
            // 3. Jika cocok, buat sesi login baru untuk keamanan
            $request->session()->regenerate();

            // Arahkan ke halaman yang sebelumnya ingin diakses, atau ke beranda
            return redirect()->intended('/')->with('success', 'Login berhasil!');
        }

        // 4. Jika gagal, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }
    public function showRegister()
    {
        // 'auth.register' artinya memanggil file register.blade.php 
        // yang ada di dalam folder resources/views/auth/
        return view('auth.register');
    }

    public function showLogin()
    {
        // 'auth.login' artinya memanggil file login.blade.php 
        // yang ada di dalam folder resources/views/auth/
        return view('auth.login');
    }
    // ... (Fungsi showLogin dan showRegister kamu yang sebelumnya) ...

    /**
     * PROSES REGISTRASI
     */
    public function registerProses(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed',
            'terms' => 'accepted'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer', // Otomatis mendaftar sebagai customer
        ]);

        Auth::login($user);

        // Langsung lempar ke dashboard customer setelah daftar
        return redirect()->route('customer.dashboard')->with('success', 'Akun berhasil dibuat!');
    }

    /**
     * PROSES LOGIN
     */
    public function loginProses(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $intended = session()->get('url.intended');

            // 🔥 LOGIKA PENENTU ARAH YANG AMAN UNTUK MULTI-ROLE 🔥
            if ($user->role === 'admin') {
                // Admin tidak boleh dialihkan ke halaman customer-only
                if ($intended && str_contains($intended, '/customer')) {
                    session()->forget('url.intended');
                }
                return redirect()->intended(route('admin.dashboard'))->with('success', 'Selamat datang Admin!');
            }

            // Customer tidak boleh dialihkan ke halaman admin-only
            if ($intended && str_contains($intended, '/admin')) {
                session()->forget('url.intended');
            }
            return redirect()->intended(route('customer.dashboard'))->with('success', 'Login Berhasil!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }
    
    /**
     * PROSES LOGOUT
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Berhasil keluar.');
    }
}
