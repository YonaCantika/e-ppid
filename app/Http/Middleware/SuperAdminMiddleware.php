<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     * Hanya izinkan user dengan role 'super_admin' mengakses route ini.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('web')->check()) {
            return redirect()->route('login');
        }

        if (Auth::guard('web')->user()->role !== 'super_admin') {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk Super Admin.');
        }

        return $next($request);
    }
}
