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
        $cek = DB::table('beranda')->where('id_beranda', 2)->first();
        $datacek = $cek ? $cek->gambar : '';
        $data['title'] = $datacek;
        $data['kontak'] = DB::table('beranda')->where('id_beranda', 1)->first();
        $data['content'] = 'web.validasiEmail';
        $data['id'] = $request->input('id');

        return view('welcome_message', $data);
    }

    public function ubah_password(Request $request)
    {
        $cek = DB::table('beranda')->where('id_beranda', 2)->first();
        $datacek = $cek ? $cek->gambar : '';
        $data['title'] = $datacek;
        $data['kontak'] = DB::table('beranda')->where('id_beranda', 1)->first();
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
        // Validasi bisa ditambahkan di sini menggunakan $request->validate()
        $generate_kode = date('yHdims') . strtoupper(substr(md5(uniqid()), 0, 10));

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

        $cek = DB::table('pemohon')->where('id_pemohon', $id)->first();
        if ($cek && $cek->kode_unik == $kode) {
            DB::table('pemohon')->where('id_pemohon', $id)->update(['status' => 1]);
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false, 'msg' => 'Kode unik tidak cocok!']);
        }
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
