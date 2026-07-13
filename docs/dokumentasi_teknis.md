# Dokumentasi Teknis Sistem e-PPID (Tingkat Tinggi / Overview)

Dokumen ini merupakan "peta" dari aplikasi e-PPID yang telah dimigrasikan. Bertujuan untuk memberikan gambaran arsitektur, alur data, dan struktur direktori agar mempermudah pemahaman bagi *developer* atau sistem administrator di masa depan.

---

## 1. Arsitektur Sistem

Aplikasi e-PPID ini mengadopsi pola arsitektur **MVC (Model-View-Controller)** yang dimodernisasi menggunakan kerangka kerja Laravel. Kami menggunakan pendekatan **Hybrid Stack**, yang memadukan keandalan *backend* modern dengan *frontend* bawaan *legacy*.

**Teknologi Utama (Stack):**
- **Bahasa Pemrograman**: PHP 8.2 (Minimum: 8.2)
- **Framework Backend**: Laravel 12.x
- **Web Server**: Apache/Nginx (Rekomendasi via Laragon/XAMPP)
- **Database**: MySQL 8.x / MariaDB (Driver PDO)
- **Frontend / Templating**: Blade Templating Engine (Laravel), HTML5, Vanilla CSS
- **Library Frontend**: AdminLTE 3 (UI Admin), jQuery (AJAX & DOM Manipulation), Bootstrap, DataTables (Grid & Server-Side Processing), Chart.js (Grafik)
- **Keamanan (Authentication)**: Laravel Multi-Guard Authentication (Guard `web` dan `pemohon`) & perlindungan token CSRF *built-in*.

---

## 2. Alur Data (Data Flow)

Gambaran umum bagaimana sebuah *request* (permintaan) dari pengguna diproses oleh aplikasi hingga membalikkan sebuah antarmuka (*response*).

1. **Frontend (Browser / Klien)**
   Pengguna menekan tombol atau mengisi *form* (misal: "Form Pendaftaran" atau memuat "Tabel DataTables"). Permintaan ini dikirim melalui HTTP Request atau jQuery AJAX.

2. **Routes (`routes/web.php`)**
   Permintaan diterima oleh sistem *Routing* Laravel. Di sini, rute akan dicek apakah membutuhkan akses khusus (melalui *Middleware* seperti `auth:web` atau `auth:pemohon`) atau terbuka untuk publik.

3. **Controller (Logika Bisnis)**
   Setelah melewati *routing*, permintaan diteruskan ke fungsi spesifik di dalam Controller (misal: `AdminController`, `UserController`, `WelcomeController`).
   - *Validasi data* (jika ada input dari user).
   - Memanggil fungsi pengunggahan file (`public_path()`).
   - Menyusun kueri untuk mengambil atau memperbarui data.

4. **Model / Database Facade (Akses Data)**
   Controller berkomunikasi dengan *Database* menggunakan dua pendekatan:
   - **Query Builder/Facade**: `DB::table('nama_tabel')->where(...)->get()`
   - **Raw Query**: `\DB::select(...)` (Biasanya untuk _grouping_ statistik yang rumit dari kueri CI3 yang diadaptasi).

5. **Response (Kembali ke Frontend)**
   Setelah data didapat dari *database*:
   - Jika *request* berupa halaman web (HTML), Controller memanggil `return view('nama_blade', $data)`.
   - Jika *request* berasal dari jQuery AJAX (seperti validasi kode atau DataTables), Controller akan melempar format data mentah via `return response()->json($data)`.

---

## 3. Struktur Direktori Utama

Berikut adalah penjelasan singkat tentang folder-folder kunci di dalam *repository* (proyek) aplikasi e-PPID. 

```text
e-ppidv2/
├── app/
│   ├── Http/
│   │   ├── Controllers/       (Logika utama aplikasi bersarang di sini)
│   │   │   ├── AdminController.php   # Mengelola dasbor Admin, DataTables, & Pengaturan
│   │   │   ├── UserController.php    # Mengelola dasbor Pemohon & pengajuan berkas
│   │   │   └── WelcomeController.php # Melayani pengunjung publik & pendaftaran
│   │   └── Middleware/        (Lapisan penyaring / proteksi rute)
│   └── Models/                (Struktur Eloquent yang mewakili entitas tabel - e.g User.php)
│
├── config/                    (Konfigurasi kerangka aplikasi)
│   ├── auth.php               # Konfigurasi Multi-Guard (admin vs pemohon) diatur di sini
│   └── database.php           # Pengaturan koneksi MySQL
│
├── database/
│   └── migrations/            (Skema *blueprint* pembuatan tabel database secara terstruktur)
│
├── public/                    (Satu-satunya folder yang bisa diakses publik via internet)
│   ├── assets_user/           # File CSS, JS (jQuery, AdminLTE, DataTables), dan gambar sistem
│   ├── file/                  # (Penting) Tempat mendaratnya unggahan file tanggapan Admin 
│   ├── upload/                # (Penting) Tempat mendaratnya foto KTP/Akta Pemohon
│   └── index.php              # Gerbang utama (*entry point*) aplikasi Laravel
│
├── resources/
│   └── views/                 (Seluruh tampilan antarmuka / HTML sistem)
│       ├── admin/             # (Sub-direktori) Blade komponen khusus Admin
│       ├── user/              # (Sub-direktori) Blade komponen khusus Pemohon
│       ├── web/               # (Sub-direktori) Blade untuk website publik (Home, Maklumat)
│       └── welcome_message.blade.php # Tampilan *Master Layout* untuk Publik
│
├── routes/
│   └── web.php                (Peta rute URL - mendaftar seluruh tautan sistem e-PPID)
│
├── storage/                   (Berisi log, dan cache internal framework)
│   └── logs/
│       └── laravel.log        (File log yang wajib diinspeksi pertama kali bila terjadi HTTP 500)
│
└── .env                       (File berisi kredensial dan variabel sensitif sistem - JANGAN DIEKSPOS)
```

## 4. Pola & Praktik Khusus (Custom Practices)

Karena aplikasi ini berakar dari sistem CodeIgniter (Hybrid), ada beberapa hal "unik" di proyek ini yang harus dipahami oleh *developer* selanjutnya:

1. **Penggunaan *Raw Query***: Masih banyak dijumpai `\DB::select(...)` di dalam Controller. Hal ini dilakukan demi mempercepat proses migrasi logika kompleks dari CI3 yang menggunakan sintaks Mentah `GROUP BY`.
2. **Master Layout (Template Engine)**: Layout master untuk modul admin dapat ditemukan di `resources/views/admin/template_admin/gabungan.blade.php`. Menggunakan arahan `@include` gaya Laravel untuk memanggil *sidebar* dan *header*.
3. **AJAX Security Setup**: Token CSRF otomatis di-*inject* pada file `header.blade.php`. Jika Anda membuat form AJAX baru, abaikan token CSRF karena jQuery secara otomatis akan mengambilnya dari _header HTTP_.
4. **Guard Spesifik di Blade**: Untuk menampilkan nama / info pengguna di *View* (Blade), wajib mendefinisikan tipe guard:
   - Jika admin: `Auth::guard('web')->user()->nama`
   - Jika pemohon: `Auth::guard('pemohon')->user()->nama`
