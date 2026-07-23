<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Pemohon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Background
        DB::table('background')->insert([
            ['id' => 1, 'gambar' => 'IMG_20181006_110525.jpg', 'created_at' => now(), 'updated_at' => now()]
        ]);

        // 2. Kategori
        $kategori = [
            [1, 'Informasi tentang Profile PT Garam (Persero)', 1, '0', '2019-09-17 09:31:43'],
            [2, 'Ringkasan Capaian Kinerja', 2, '0', '2019-09-17 09:32:28'],
            [3, 'Laporan', 3, '0', '2019-09-17 09:34:33'],
            [4, 'Penetapan Dewan Komisaris dan Direksi', 4, '0', '2019-09-17 09:35:08'],
            [5, 'Good Corporate Governance', 5, '0', '2019-09-17 09:35:14'],
            [6, 'Pengumuman', 6, '0', '2019-09-17 09:35:29'],
            [7, 'Informasi Tentang Profil KIP', 7, '0', '2019-09-17 09:35:39'],
            [8, 'Daftar Informasi Publik', 8, '0', '2019-09-17 09:36:03']
        ];
        foreach ($kategori as $k) {
            DB::table('kategori')->insert(['kategori_id' => $k[0], 'nama_kategori' => $k[1], 'urutan' => $k[2], 'status' => $k[3], 'created_at' => $k[4], 'updated_at' => $k[4]]);
        }

        // 3. Informasi
        $informasi = [
            [1, 1, 7, 'Alamat Lengkap Perusahaan', 1, 'https://ptgaram.com/Contact', '0', '2019-09-17 09:39:43'],
            [2, 1, 7, 'Profil Pejabat PT Garam', 1, 'https://ptgaram.com/Staff', '0', '2019-09-17 09:42:23'],
            [3, 1, 7, 'Struktur Organisasi', 1, 'https://ptgaram.com/Beranda/detaildata/struktur-organisasi', '0', '2019-09-17 09:42:32'],
            [4, 1, 7, 'Visi dan Misi PT Garam', 1, 'https://ptgaram.com/visiMisi', '0', '2019-09-17 09:42:40'],
            [5, 1, 7, 'Kantor Wilayah Pemasaran', 0, 'Informasi/profile-pt_garam/Kantor_Wilayah_Pemasaran.pdf', '0', '2019-09-17 09:42:45'],
            [6, 1, 7, 'Tugas dan Fungsi PT Garam', 0, 'Informasi/profile-pt_garam/Tugas_dan_Fungsi_PT_Garam_(Persero).pdf', '0', '2019-09-17 09:42:50'],
            [7, 3, 7, 'Laporan Keuangan', 1, 'https://ptgaram.com/datafinansial', '0', '2019-09-17 09:43:11'],
            [8, 3, 7, 'Laporan Tahunan', 0, 'Informasi/Laporan/AR_Garam.pdf', '0', '2019-09-17 09:43:17'],
            [9, 2, 7, 'Capaian Kinerja Perusahaan', 0, 'Informasi/Ringkasan/Capaian_Kinerja_Perusahaan.pdf', '0', '2019-09-17 09:43:32'],
            [10, 4, 7, 'Mekanisme Penetapan Direksi', 0, 'Informasi/Penetapan/Mekanisme_Penetapan_Direksi.pdf', '0', '2019-09-17 09:44:02'],
            [11, 4, 7, 'Mekanisme Penetapan Dewan Komisaris', 0, 'Informasi/Penetapan/Mekanisme_Penetapan_Dewan_Komisaris.pdf', '0', '2019-09-17 09:44:29'],
            [12, 5, 7, 'Pedoman Tata Kelola Perusahaan', 1, 'https://www.ptgaram.com/tataKelola', '0', '2019-09-17 09:44:46'],
            [13, 5, 7, 'Pedoman Whistle Blowing System', 1, 'https://www.ptgaram.com/tataKelola', '0', '2019-09-17 09:44:50'],
            [14, 6, 7, 'Penerimaan Pegawai', 1, null, '0', '2019-09-17 09:45:23'],
            [15, 6, 7, 'Pengadaan Barang dan Jasa', 1, 'https://ptgaram.com/Pengadaan', '0', '2019-09-17 09:45:28'],
            [16, 7, 7, 'Tugas dan Fungsi PPID', 0, 'Informasi/profil-ppid/SK_58.DIR.SK.VII.2018_31-Juli-2018_Perubahan-Pejabat-Pengelola-Informasi&Dokumentasi.pdf', '0', '2019-09-17 09:45:49'],
            [17, 7, 7, 'Struktur Organisasi PPID', 0, null, '0', '2019-09-17 09:45:53'],
            [18, 7, 7, 'Visi dan Misi PPID', 0, null, '0', '2019-09-17 09:45:57'],
            [19, 8, 9, 'Daftar Informasi Publik PT Garam', 0, 'Informasi1/Daftar.xlsx', '0', '2019-09-17 09:46:28']
        ];
        foreach ($informasi as $i) {
            DB::table('informasi')->insert(['informasi_id' => $i[0], 'kategori_id' => $i[1], 'menu_id' => $i[2], 'judul' => $i[3], 'tipe' => $i[4], 'link' => $i[5], 'status' => $i[6], 'created_at' => $i[7], 'updated_at' => $i[7]]);
        }

        // 4. Menu
        $menu = [
            [1, 'Profil', 'Profile', null, 1, 1, 0, 1, 1, 'profil', 'active'],
            [2, 'Regulasi', 'Regulation', null, 2, 2, 0, 1, 1, 'regulasi', 'active'],
            [3, 'Maklumat', 'Notice', null, 3, 3, 0, 1, 1, 'maklumat', 'active'],
            [4, 'Informasi Publik', 'Public Information', null, 4, 4, 0, 1, 1, 'static', 'active'],
            [5, 'Prosedur', 'Information Services', null, 5, 5, 0, 1, 1, 'static', 'active'],
            [6, 'Daftar / Login', 'Register', null, 6, 8, 0, 1, 1, 'daftar', 'active'],
            [7, 'Informasi yang wajib disediakan dan diumumkan secara berkala', '#', null, 4, 9, 0, 1, 1, 'informasi/7', 'active'],
            [8, 'Informasi yang wajib disediakan dan diumumkan secara serta-merta', '#', null, 4, 10, 0, 1, 1, 'informasi/8', 'active'],
            [9, 'Informasi yang wajib sedia setiap saat', '#', null, 4, 11, 0, 1, 1, 'informasi/9', 'active'],
            [10, 'Kalender Kerja', 'Work Calendar', null, 1, 1, 0, 1, 1, 'kalender', 'unactive'],
            [11, 'Prosedur Pengajuan', '#', null, 5, 1, 0, 1, 1, 'layanan', 'active'],
            [12, 'Prosedur Keberatan', '#', null, 5, 2, 0, 1, 1, 'keberatan', 'active']
        ];
        foreach ($menu as $m) {
            DB::table('menu')->insert(['id' => $m[0], 'judul' => $m[1], 'judul_en' => $m[2], 'slug' => $m[3], 'id_menu' => $m[4], 'urut' => $m[5], 'sub_menu' => $m[6], 'status' => $m[7], 'static' => $m[8], 'link' => $m[9], 'status_link' => $m[10], 'created_at' => now(), 'updated_at' => now()]);
        }

        // 5. Kontak
        DB::table('kontak')->insert([
            ['id' => 1, 'alamat' => 'KANTOR ADMINISTRASI : Jalan Arif Rahman Hakim No.93 Surabaya, Jawa Timur, Indonesia 60117', 'alamat_produksi' => 'KANTOR PUSAT : Jl. Raya Kalianget 9 Kalianget, Sumenep - Madura (69471)Sumenep - 69471', 'telp' => '(031) 5937578-82', 'fax' => '(031) 5937583', 'email' => 'sekretariat@ptgaram.com', 'fb' => 'https://www.facebook.com/profile.php?id=100015839194415', 'google' => '-', 'twitter' => 'https://twitter.com/ptgarampersero/', 'instagram' => 'https://www.instagram.com/ptgarampersero/?hl=id', 'created_at' => now(), 'updated_at' => now()]
        ]);

        // 6. Logo & TB_API_WA
        DB::table('logo')->insert([
            ['id' => 1, 'gambar' => 'garam.png', 'created_at' => now(), 'updated_at' => now()]
        ]);
        DB::table('tb_api_wa')->insert([
            ['id' => 1, 'api_wa' => '648d4d7956f68e28bf60ce34f6fec75a430463d35fd068c2', 'link' => 'http://116.203.92.59/api/send_message', 'created_at' => now(), 'updated_at' => now()]
        ]);

        // 7. Regulasi
        $regulasi = [
            [1, 'Peraturan Pemerintah Nomor 61 Tahun 2010 tentang Pelaksanaan Keterbukaan Informasi Publik', '-', 'IMG', 'Regulasi/Peraturan-KI-No.1-Tahun-2010-Tentang-Standar-Layanan-Informasi-Publik.pdf', '0'],
            [2, 'Undang-undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik', '-', null, 'Regulasi/UU_KIP.pdf', '0'],
            [3, 'Peraturan Komisi Informasi Nomor 1 Tahun 2010 tentang Standar Layanan Informasi Publik', '-', null, 'Regulasi/pp-61-tahun-2010.pdf', '0'],
            [4, 'Peraturan Komisi Informasi Nomor 1 Tahun 2017 tentang Pengklasifikasian Informasi Publik', '-', null, 'Regulasi/perki-no-1-tahun-2017.pdf', '0'],
            [5, 'Peraturan Komisi Informasi No 1 Tahun 2013 Tentang Prosedur Penyelesaian Sengketa Informasi Publik\r\n', '-', null, 'Regulasi/perki_no.1_tahun_2013_.pdf', '0'],
            [6, 'Pedoman Keterbukaan Informasi Publik PT Garam', '-', null, 'Regulasi/SK_100.DIR.XII.2020_17DEs2020_Pedoman%20Keterbukaan%20Informasi%20Publik%20PT%20Garam_Stample_compressed%20%281%29.pdf', '0']
        ];
        foreach ($regulasi as $r) {
            DB::table('regulasi')->insert(['regulasi_id' => $r[0], 'aturan' => $r[1], 'keterangan' => $r[2], 'tipe_file' => $r[3], 'file' => $r[4], 'status' => $r[5], 'created_at' => now(), 'updated_at' => now()]);
        }

        // 8. Users (Admin + Pemohon)
        // Super Admin
        User::create([
            'id'       => 1,
            'name'     => 'Super Admin',
            'email'    => 'superadmin@gmail.com',
            'password' => Hash::make('superadmin123'),
            'role'     => 'super_admin',
            'id_emp'   => null,
            'status'   => 1,
        ]);

        // Admin
        User::create([
            'id'       => 2,
            'name'     => 'Admin',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('12345'), // Dari CI3 plaintext
            'role'     => 'admin',
            'id_emp'   => 1,
            'status'   => 1
        ]);
        
        // Pemohon Dummy 1
        Pemohon::create([
            'id_pemohon' => 2,
            'nama' => 'Aldi',
            'email' => 'aldiragilromadhon@gmail.com',
            'password' => Hash::make('admin'), // dari CI3 plaintext
            'id_jenis' => 1,
            'id_identitas' => 1,
            'nomor_identitas' => '12345',
            'npwp' => '12345',
            'pekerjaan' => 'Karyawan',
            'alamat' => 'Kalianget',
            'notelp' => '081336643668',
            'nofax' => '081336643668',
            'status' => 1
        ]);
    }
}
