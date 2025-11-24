<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Usage in routes: ->middleware('role:admin') or ->middleware('role:penyewa')
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Jika belum login, arahkan ke login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Jika role sesuai, lanjut
        if (Auth::user()->role === $role) {
            return $next($request);
        }

        // Jika role tidak sesuai, arahkan ke dashboard sesuai role yang dimiliki
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if (Auth::user()->role === 'penyewa') {
            return redirect()->route('penyewa.dashboard');
        }

        // Jika role lain atau tidak ada, tampilkan 403
        abort(403, 'Unauthorized');
    }
}
