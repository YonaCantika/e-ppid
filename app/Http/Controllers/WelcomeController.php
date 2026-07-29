<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Background;
use App\Models\Kontak;
use App\Models\Regulasi;
use App\Models\Informasi;
use App\Models\InformasiPermohonan;

class WelcomeController extends Controller
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

    /**
     * Menampilkan Halaman Beranda Utama (Landing Page).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = $this->getCommonData();
        $data['content'] = 'web.beranda';
        return view('welcome_message', $data);
    }

    public function profil()
    {
        $data = $this->getCommonData();
        $data['content'] = 'web.profil';
        return view('welcome_message', $data);
    }

    public function kalender()
    {
        $data = $this->getCommonData();
        $data['content'] = 'web.kalender';
        return view('welcome_message', $data);
    }

    public function regulasi()
    {
        $data = $this->getCommonData();
        $data['content'] = 'web.regulasi';
        $data['tableData'] = Regulasi::where('status', '0')->orderBy('regulasi_id', 'desc')->get();
        return view('welcome_message', $data);
    }

    public function maklumat()
    {
        $data = $this->getCommonData();
        $data['content'] = 'web.maklumat';
        return view('welcome_message', $data);
    }

    public function layanan_informasi()
    {
        $data = $this->getCommonData();
        $data['content'] = 'web.layanan';
        return view('welcome_message', $data);
    }

    public function layanan_keberatan()
    {
        $data = $this->getCommonData();
        $data['content'] = 'web.layanan_keberatan';
        return view('welcome_message', $data);
    }

    public function permohonan()
    {
        $data = $this->getCommonData();
        $data['content'] = 'web.permohonan';
        return view('welcome_message', $data);
    }

    public function submit_permohonan(Request $request)
    {
        // Handle permohonan submission
        // Need to translate logic from register_visitor or similar
        return redirect()->back()->with('success', 'Permohonan berhasil dikirim');
    }

    public function informasi_publik(Request $request, $id)
    {
        $date = $request->input('date', date('Y'));

        $data = $this->getCommonData();

        $data['tableData'] = DB::table('informasi as a')
            ->select('b.kategori_id', 'b.nama_kategori', 'a.judul', 'a.link', 'a.tipe')
            ->join('kategori as b', 'a.kategori_id', '=', 'b.kategori_id')
            ->where('a.menu_id', $id)
            ->where('a.status', '0')
            ->where('b.status', '0')
            ->get();

        $data['q_tahun'] = DB::select("SELECT year(created_at) tahun from informasi_permohonan group by year(created_at)");
        $data['tipe'] = DB::select("SELECT tipe_permohonan, COUNT(tipe_permohonan) jumlah FROM informasi_permohonan WHERE YEAR(created_at) = ? GROUP BY tipe_permohonan", [$date]);
        $data['status'] = DB::select("SELECT status, COUNT(status) jumlah FROM informasi_permohonan WHERE YEAR(created_at) = ? GROUP BY status", [$date]);

        if ($id == 7) $data['content'] = 'web.informasi1';
        if ($id == 8) $data['content'] = 'web.informasi2';
        if ($id == 9) $data['content'] = 'web.informasi3';
        if ($id == 10) $data['content'] = 'web.statistik';

        return view('welcome_message', $data);
    }

    public function validasi(Request $request)
    {
        $id = $request->input('id');
        $pemohon = null;
        if ($id) {
            $pemohon = \App\Models\Pemohon::where('id_pemohon', $id)->first();
        }

        // Fallback untuk user yang diarahkan otomatis oleh middleware verified.pemohon
        if (!$pemohon && \Illuminate\Support\Facades\Auth::guard('pemohon')->check()) {
            $pemohon = \Illuminate\Support\Facades\Auth::guard('pemohon')->user();
            $id = $pemohon->id_pemohon;
        }

        $data = $this->getCommonData();
        $data['content'] = 'web.validasiEmail';
        $data['id'] = $id;
        $data['pemohon'] = $pemohon;

        return view('welcome_message', $data);
    }

    public function ubah_password(Request $request)
    {
        $data = $this->getCommonData();
        $data['content'] = 'web.ubah_password';
        $data['email'] = $request->input('email');
        $data['wa'] = $request->input('wa');

        return view('welcome_message', $data);
    }

    // AJAX Methods
    /**
     * Menerima payload dari form registrasi publik via AJAX dan menyimpan ke tabel 'pemohon'.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register_visitor2(Request $request)
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
            'email-register.unique'      => 'Email ini sudah terdaftar! Silakan gunakan email lain atau login.',
            'email-register.required'    => 'Email wajib diisi.',
            'nomor-identitas-register.required' => 'Nomor identitas wajib diisi.',
            'nama-lengkap-register.required'    => 'Nama lengkap wajib diisi.',
            'pekerjaan-register.required'       => 'Pekerjaan wajib diisi.',
            'alamat-register.required'          => 'Alamat wajib diisi.',
            'telp-register.required'            => 'No HP/WA wajib diisi.',
            'password-register.required'        => 'Password wajib diisi.'
        ]);

        $generate_kode = (string) mt_rand(100000, 999999);

        $data = [
            'id_jenis'          => $request->input('jenis-permohonan-register'),
            'id_identitas'      => $request->input('jenis-identitas-register'),
            'nomor_identitas'   => $request->input('nomor-identitas-register'),
            'nama'              => $request->input('nama-lengkap-register'),
            'npwp'              => $request->input('npwp-register'),
            'email'             => $request->input('email-register'),
            'pekerjaan'         => $request->input('pekerjaan-register'),
            'alamat'            => $request->input('alamat-register'),
            'notelp'            => $request->input('telp-register'),
            'nofax'             => $request->input('fax-register'),
            'password'          => md5($request->input('password-register')), // Sesuai CI3
            'kode_unik'         => $generate_kode,
            'status'            => '0'
        ];

        $id_pemohon = DB::table('pemohon')->insertGetId($data);

        // Notifikasi WA / Email dimatikan sesuai request user untuk keperluan testing

        return response()->json([
            'status' => 1,
            'id' => $id_pemohon
        ]);
    }

    /**
     * Memvalidasi inputan kode unik (OTP) pemohon agar akun dapat diaktifkan.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function validasi_kode_unik(Request $request)
    {
        $id = $request->input('id');
        $kode = $request->input('kde');

        $pemohon = \App\Models\Pemohon::where('id_pemohon', $id)->first();
        if ($pemohon && $pemohon->kode_unik == $kode) {
            $pemohon->status = 1;
            $pemohon->save();

            // Otomatis login dan arahkan ke halaman users setelah verifikasi berhasil
            \Illuminate\Support\Facades\Auth::guard('pemohon')->login($pemohon);
            $request->session()->regenerate();

            // Bersihkan session resend OTP
            $request->session()->forget(['otp_resend_count', 'otp_resend_last']);

            return response()->json([
                'status' => true,
                'msg' => 'Verifikasi berhasil! Mengalihkan ke Halaman Pengguna...',
                'redirect_url' => route('user.dashboard')
            ]);
        } else {
            return response()->json(['status' => false, 'msg' => 'Kode verifikasi tidak cocok!']);
        }
    }

    /**
     * Kirim ulang kode OTP verifikasi email.
     * Maksimal 3x pengiriman ulang, cooldown bertambah 30 detik setiap percobaan.
     */
    public function resend_otp(Request $request)
    {
        $id = $request->input('id');
        $pemohon = \App\Models\Pemohon::where('id_pemohon', $id)->first();

        if (!$pemohon) {
            return response()->json(['status' => false, 'msg' => 'Data pemohon tidak ditemukan.']);
        }

        if ($pemohon->status == 1) {
            return response()->json(['status' => false, 'msg' => 'Akun sudah terverifikasi.']);
        }

        // Cek jumlah percobaan resend (max 3)
        $resendCount = $request->session()->get('otp_resend_count', 0);
        $lastResend = $request->session()->get('otp_resend_last', 0);

        if ($resendCount >= 3) {
            return response()->json([
                'status' => false,
                'msg' => 'Batas pengiriman ulang telah tercapai (maksimal 3 kali). Silakan hubungi admin untuk bantuan.'
            ]);
        }

        // Hitung cooldown: 30 detik * (percobaan ke-n)
        // Percobaan 1 = 30s, Percobaan 2 = 60s, Percobaan 3 = 90s
        $cooldown = 30 * ($resendCount + 1);
        $elapsed = time() - $lastResend;

        if ($lastResend > 0 && $elapsed < $cooldown) {
            $sisaWaktu = $cooldown - $elapsed;
            return response()->json([
                'status' => false,
                'msg' => "Harap tunggu {$sisaWaktu} detik lagi sebelum mengirim ulang."
            ]);
        }

        // Generate kode OTP baru
        $kode_baru = (string) mt_rand(100000, 999999);
        $pemohon->kode_unik = $kode_baru;
        $pemohon->save();

        // Kirim email verifikasi
        try {
            \Illuminate\Support\Facades\Mail::to($pemohon->email)->send(new \App\Mail\VerifikasiOtpMail($pemohon));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Gagal mengirim ulang email verifikasi ke {$pemohon->email}: " . $e->getMessage());
            return response()->json([
                'status' => false,
                'msg' => 'Gagal mengirim email. Silakan coba lagi nanti.'
            ]);
        }

        // Update session counter
        $newCount = $resendCount + 1;
        $request->session()->put('otp_resend_count', $newCount);
        $request->session()->put('otp_resend_last', time());

        // Hitung cooldown untuk percobaan berikutnya
        $sisaKesempatan = 3 - $newCount;
        $nextCooldown = $newCount < 3 ? 30 * ($newCount + 1) : 0;

        return response()->json([
            'status' => true,
            'msg' => "Kode OTP baru telah dikirim ke {$pemohon->email}. Sisa kesempatan kirim ulang: {$sisaKesempatan}x.",
            'resend_count' => $newCount,
            'sisa_kesempatan' => $sisaKesempatan,
            'next_cooldown' => $nextCooldown
        ]);
    }

    /**
     * Batalkan pendaftaran pemohon (hapus data dari database).
     * Hanya bisa dilakukan jika status pemohon masih 0 (belum terverifikasi).
     */
    public function cancel_registration(Request $request)
    {
        $id = $request->input('id');
        $pemohon = \App\Models\Pemohon::where('id_pemohon', $id)->first();

        if (!$pemohon) {
            return response()->json(['status' => false, 'msg' => 'Data pemohon tidak ditemukan.']);
        }

        // Hanya boleh dibatalkan jika status masih 0 (belum terverifikasi)
        if ($pemohon->status != 0 && $pemohon->status != '0') {
            return response()->json(['status' => false, 'msg' => 'Akun sudah terverifikasi dan tidak dapat dibatalkan.']);
        }

        // Logout pemohon jika sedang login
        if (\Illuminate\Support\Facades\Auth::guard('pemohon')->check() &&
            \Illuminate\Support\Facades\Auth::guard('pemohon')->id() == $pemohon->id_pemohon) {
            \Illuminate\Support\Facades\Auth::guard('pemohon')->logout();
        }

        // Bersihkan session terkait OTP
        $request->session()->forget(['otp_resend_count', 'otp_resend_last']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Hapus data pemohon dari database
        $pemohon->delete();

        return response()->json([
            'status' => true,
            'msg' => 'Pendaftaran berhasil dibatalkan. Data akun Anda telah dihapus.'
        ]);
    }

    /**
     * Memverifikasi akun pemohon via Tautan Unik (Signed URL) dari email (Konsep Klik Link).
     */
    public function verify_email_link(Request $request, $id, $hash)
    {
        // Periksa validitas signature (token dari tautan unik Laravel)
        if (!$request->hasValidSignature()) {
            return redirect()->route('login')->with('error', 'Tautan verifikasi telah kedaluwarsa atau tidak valid!');
        }

        $pemohon = \App\Models\Pemohon::where('id_pemohon', $id)->first();
        if (!$pemohon || sha1($pemohon->email) !== $hash) {
            return redirect()->route('login')->with('error', 'Data pemohon tidak cocok atau tidak ditemukan!');
        }

        // Ubah status menjadi aktif (1)
        if ($pemohon->status == 0 || $pemohon->status == '0') {
            $pemohon->status = 1;
            $pemohon->save();
        }

        // Otomatis login dan arahkan ke dashboard pengguna
        \Illuminate\Support\Facades\Auth::guard('pemohon')->login($pemohon);
        $request->session()->regenerate();

        return redirect()->route('user.dashboard')->with('success', 'Email berhasil diverifikasi! Akun Anda kini telah aktif.');
    }

    public function cek_email(Request $request)
    {
        $count = DB::table('pemohon')
            ->where('email', $request->input('email'))
            ->where('notelp', $request->input('wa'))
            ->count();
        return response($count);
    }

    public function lupa_password2(Request $request)
    {
        $email = $request->input('email');
        $wa = $request->input('wa');

        $generate_kode = date('yHdims') . strtoupper(substr(md5(uniqid()), 0, 10));

        $affected = DB::table('pemohon')
            ->where('email', $email)
            ->where('notelp', $wa)
            ->update(['kode_unik' => $generate_kode]);

        if ($affected) {
            // Notifikasi WA dimatikan sesuai request user
            return response()->json([
                'status' => 1,
                'email' => $email,
                'wa' => $wa
            ]);
        } else {
            return response()->json(['status' => false, 'msg' => 'GAGAL SIMPAN FILE !']);
        }
    }

    public function change_password(Request $request)
    {
        $email = $request->input('email');
        $wa = $request->input('wa');
        $kode = $request->input('kde');
        $password = md5($request->input('password-baru')); // Sesuai CI3

        $cek = DB::table('pemohon')->where('email', $email)->where('notelp', $wa)->first();
        
        if ($cek && $cek->kode_unik == $kode) {
            DB::table('pemohon')
                ->where('email', $email)
                ->where('notelp', $wa)
                ->update(['status' => 1, 'password' => $password]);
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false, 'msg' => 'Kode unik tidak cocok!']);
        }
    }
}
