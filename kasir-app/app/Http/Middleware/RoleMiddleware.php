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
        // Jika belum login
        if (!Auth::check()) {
            return redirect('/login');
        }

        $userRole = strtolower(Auth::user()->role); // dari tabel users

        // Cek role
        if ($userRole !== strtolower($role)) {
            // Kalau admin coba akses route user
            if ($userRole === 'admin') {
                return redirect('/dashboard')->with('error', 'Anda tidak diizinkan mengakses halaman user.');
            }

            // Kalau user coba akses route admin
            if ($userRole === 'user') {
                return redirect('/user/dashboard')->with('error', 'Anda tidak diizinkan mengakses halaman admin.');
            }

            // Kalau role tidak dikenali
            return redirect('/login')->with('error', 'Role tidak diizinkan.');
        }

        return $next($request);
    }
}
