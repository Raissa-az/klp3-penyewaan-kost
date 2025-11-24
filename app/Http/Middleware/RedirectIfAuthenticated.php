<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                // Redirect berdasarkan role
                if (auth()->user()->role === 'admin') {
                    return redirect('/admin/dashboard');
                }

                return redirect('/penyewa/dashboard');
            }
        }

        return $next($request);
    }
}
