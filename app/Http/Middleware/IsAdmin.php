<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Jika sudah login dan is_admin bernilai 1
        if (Auth::check() && Auth::user()->is_admin == 1) {
            return $next($request);
        }

        // Jika bukan admin, balikkan ke home
        return redirect('/')->with('error', 'Anda tidak memiliki akses admin.');
    }
}