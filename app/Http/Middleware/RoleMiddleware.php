<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Cek apakah user sudah login, jika belum suruh login dulu
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Cek apakah role user sesuai dengan yang diminta rute (admin / customer)
        if (Auth::user()->role !== $role) {
            // Jika customer nekat masuk ke rute admin, kita tendang balik ke halaman utama
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman tersebut!');
        }

        return $next($request);
    }
}