<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // Cek apakah role user sesuai
        if (Auth::user()->role !== $role) {
            // Redirect ke dashboard sesuai role mereka
            $userRole = Auth::user()->role;
            
            if ($userRole === 'admin') {
                return redirect()->route('admin.dashboard')
                    ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
            }
            
            if ($userRole === 'penyewa') {
                return redirect()->route('penyewa.dashboard')
                    ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
            }

            // Jika role tidak dikenali, logout
            Auth::logout();
            return redirect()->route('login')
                ->with('error', 'Role user tidak valid.');
        }

        return $next($request);
    }
}