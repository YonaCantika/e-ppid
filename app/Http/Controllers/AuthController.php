<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pemohon;
use Illuminate\Support\Facades\Hash;
use App\Models\Background;
use App\Models\Kontak;

class AuthController extends Controller
{
    private function getCommonData()
    {
        $bg = Background::first();
        $kontak = Kontak::first();
        
        return [
            'title' => $bg ? $bg->gambar : '',
            'kontak' => $kontak
        ];
    }

    public function daftar()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('admin.dashboard');
        }
        if (Auth::guard('pemohon')->check()) {
            return redirect()->route('user.dashboard');
        }

        $data = $this->getCommonData();
        $data['content'] = 'web.daftar';
        return view('welcome_message', $data);
    }

    public function submit_login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        // Coba login sebagai Admin (tabel users)
        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::guard('web')->user();
            // Super Admin diarahkan ke panel khusus
            if ($user->role === 'super_admin') {
                return redirect()->route('super_admin.dashboard');
            }
            return redirect()->route('admin.dashboard');
        }

        // Jika gagal, coba login sebagai Pemohon (tabel pemohon)
        if (Auth::guard('pemohon')->attempt($credentials)) {
            $request->session()->regenerate();
            // Catat last login
            $pemohon = Auth::guard('pemohon')->user();
            $pemohon->lastLogin = now();
            $pemohon->save();
            
            return redirect()->route('user.dashboard');
        }

        // Jika keduanya gagal, kembalikan pesan error eksplisit (bukan redirect back) agar terlihat jelas
        return response("Login Gagal! Kombinasi email dan password tidak ditemukan di tabel Admin maupun Pemohon. Email yang dimasukkan: " . $credentials['email'], 401);
    }

    public function submit_daftar(Request $request)
    {
        $request->validate([
            'jenis-permohonan-register' => 'required',
            'jenis-identitas-register'  => 'required',
            'nomor-identitas-register'  => 'required|string',
            'nama-lengkap-register'     => 'required|string',
            'npwp-register'             => 'nullable|string',
            'email-register'            => 'required|email|unique:pemohon,email|unique:users,email',
            'pekerjaan-register'        => 'required|string',
            'alamat-register'           => 'required|string',
            'telp-register'             => 'required|string',
            'fax-register'              => 'nullable|string',
            'password-register'         => 'required|min:4'
        ], [
            'jenis-permohonan-register.required' => 'Jenis permohonan wajib dipilih.',
            'jenis-identitas-register.required'  => 'Jenis identitas wajib dipilih.',
            'nomor-identitas-register.required'  => 'Nomor identitas wajib diisi.',
            'nama-lengkap-register.required'     => 'Nama lengkap wajib diisi.',
            'email-register.required'            => 'Email wajib diisi.',
            'email-register.email'               => 'Format email tidak valid.',
            'email-register.unique'              => 'Email ini sudah terdaftar! Silakan gunakan email lain atau login.',
            'pekerjaan-register.required'        => 'Pekerjaan wajib diisi.',
            'alamat-register.required'           => 'Alamat wajib diisi.',
            'telp-register.required'             => 'No HP/WA wajib diisi.',
            'password-register.required'         => 'Password wajib diisi.',
            'password-register.min'              => 'Password minimal 4 karakter.'
        ]);

        $generate_kode = date('yHdims') . substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 10);

        $pemohon = Pemohon::create([
            'nama' => $request->input('nama-lengkap-register'),
            'email' => $request->input('email-register'),
            'password' => Hash::make($request->input('password-register')),
            'id_jenis' => $request->input('jenis-permohonan-register'),
            'id_identitas' => $request->input('jenis-identitas-register'),
            'nomor_identitas' => $request->input('nomor-identitas-register'),
            'npwp' => $request->input('npwp-register'),
            'pekerjaan' => $request->input('pekerjaan-register'),
            'alamat' => $request->input('alamat-register'),
            'notelp' => $request->input('telp-register'),
            'nofax' => $request->input('fax-register'),
            'kode_unik' => $generate_kode,
            'status' => 0 // Perlu verifikasi
        ]);

        // Logika pengiriman email verifikasi atau WA dihapus sementara agar fokus di inti.

        Auth::guard('pemohon')->login($pemohon);
        return redirect()->route('user.dashboard');
    }

    public function logout(Request $request)
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        } elseif (Auth::guard('pemohon')->check()) {
            Auth::guard('pemohon')->logout();
        }
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    
    public function lupa_password()
    {
        $data = $this->getCommonData();
        $data['content'] = 'web.lupa_password';
        return view('welcome_message', $data);
    }
}
