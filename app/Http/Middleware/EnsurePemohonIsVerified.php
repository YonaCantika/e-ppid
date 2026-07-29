<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsurePemohonIsVerified
{
    /**
     * Handle an incoming request.
     * Middleware bergaya Laravel Breeze 'verified' khusus untuk guard 'pemohon'.
     * Jika pemohon belum verifikasi email/akun (status == 0), maka akan diteruskan ke halaman verifikasi.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah ada pemohon yang login
        if (!Auth::guard('pemohon')->check()) {
            return $request->expectsJson()
                ? abort(401, 'Unauthenticated.')
                : redirect()->route('login');
        }

        $pemohon = Auth::guard('pemohon')->user();

        // Periksa apakah status pemohon masih 0 (Belum Terverifikasi)
        if ($pemohon->status == 0 || $pemohon->status == '0') {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'status' => false,
                    'msg' => 'Akun dan email Anda belum terverifikasi! Silakan lakukan verifikasi terlebih dahulu.'
                ], 403);
            }

            // Alihkan otomatis ke halaman verifikasi dengan ID pemohon (seperti fitur MustVerifyEmail di Breeze)
            return redirect()->route('validasi', ['id' => $pemohon->id_pemohon])
                ->with('warning', 'Silakan masukkan kode verifikasi yang telah dikirim ke email Anda untuk melanjutkan akses ke halaman ini.');
        }

        return $next($request);
    }
}
