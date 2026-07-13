# Laporan Lengkap dan Komprehensif: Migrasi e-PPID (CodeIgniter 3 ke Laravel 12)

Dokumen ini merupakan laporan teknis mendalam yang merekam secara rinci proses refactoring, restrukturisasi database, serta pembaruan kode aplikasi e-PPID dari kerangka kerja *legacy* **CodeIgniter 3 (CI3)** yang berjalan di PHP 5.6 menuju kerangka kerja modern **Laravel 12** yang berjalan di PHP 8.2.

Pendekatan strategis yang digunakan dalam migrasi ini adalah **Hybrid Migration**. Artinya, tulang punggung (backend) sistem seperti Router, Controller, Model, dan Database sepenuhnya diganti menggunakan arsitektur Laravel, sementara antarmuka pengguna (Frontend), struktur View (AdminLTE), dan AJAX (jQuery/DataTables) sebisa mungkin dipertahankan agar tidak mengubah *User Experience* secara drastis.

---

## 1. Arsitektur Database & Penyesuaian Skema

Sistem CI3 sebelumnya memiliki konvensi database yang kurang terstandarisasi, terutama dalam pencatatan jejak waktu (timestamps) dan penggabungan entitas pengguna. Di Laravel, semuanya dibuat lebih terstruktur menggunakan fitur *Migrations*.

### A. Pemisahan Entitas (Tabel `users` vs `pemohon`)
Pada sistem lama, Admin dan Pemohon digabungkan dalam pengelolaan yang rentan. Kami melakukan pemisahan:
- **Tabel `users`**: Didedikasikan khusus untuk Super Admin dan Admin.
- **Tabel `pemohon`**: Tabel independen baru untuk menyimpan data akun masyarakat (pemohon).
Tindakan ini memastikan level akses tabel tidak bercampur.

### B. Standardisasi Timestamps (Waktu Pencatatan)
CodeIgniter lama menggunakan berbagai macam nama kolom acak untuk mencatat waktu, seperti `entry_date`, `update_date`, dan `createDate`. 
Saat tabel dibuat menggunakan Laravel Migrations, Laravel secara otomatis menyertakan kolom `$table->timestamps()` yang mewakili `created_at` dan `updated_at`. 
**Solusi Migrasi**: Kami mengubah ratusan pemanggilan kueri SQL di dalam Controller yang dulunya mencari `entry_date` atau `createDate` menjadi `created_at` agar sistem tidak menghasilkan error `Unknown column 1054`.

### C. Penyesuaian *Strict Mode* MySQL (Error DataTables)
Laravel 12 mengaktifkan *Strict Mode* pada MySQL secara *default*. Ini berdampak pada fitur **DataTables** seperti Daftar Akun Pemohon yang sebelumnya menggunakan sintaks `GROUP BY` yang tidak lengkap di CI3.
- **Masalah**: Kueri DataTables gagal merender (Ajax Error 7) karena kueri SQL `SELECT a.* ... GROUP BY a.id_pemohon` tidak menyertakan seluruh kolom secara eksplisit.
- **Penyelesaian**: Kueri `groupBy` di `AdminController@listakunpemohon` diperbaiki untuk menuliskan seluruh kolom secara terperinci (`a.nama`, `a.npwp`, `a.ktp`, `a.akta`, `a.created_at`, dll), menggantikan variabel lawas seperti `a.foto` yang sudah dihapus dari skema baru.

---

## 2. Sistem Otentikasi, Session, & Multi-Guard Security

Bagian yang mengalami perombakan paling masif adalah sistem Login dan Manajemen Sesi.

### A. Penerapan Multi-Guard Auth Laravel
Sesi statis berbasis ID di CI3 (`$this->session->userdata()`) sepenuhnya dihilangkan. Sebagai gantinya, **Multi-Guard Authentication** diatur di `config/auth.php`:
- `Auth::guard('web')` melindungi rute dasbor Admin (via *middleware* `auth:web`).
- `Auth::guard('pemohon')` melindungi rute pengajuan permohonan masyarakat (via *middleware* `auth:pemohon`).

### B. Refactoring Halaman Login Hybrid (`/daftar`)
Halaman login dan pendaftaran (`WelcomeController@pendaftaran`) didesain agar cerdas:
1. Saat form login disubmit, sistem akan mencoba mencari kredensial email tersebut menggunakan Guard Admin.
2. Apabila kredensial tidak ditemukan sebagai Admin, sistem otomatis mengalihkan pengecekan kredensial menggunakan Guard Pemohon.
3. Form Registrasi baru 100% dialirkan ke dalam tabel `pemohon` menggunakan enkripsi MD5 (untuk menjaga kompatibilitas dengan *password hash* CI3 yang lama).

### C. Pembersihan Sesi Mentah
Pada puluhan *View* header dan sidebar (baik Admin maupun User), variabel lama `<?php echo $this->session->userdata('nama'); ?>` sepenuhnya direfaktor menjadi standar Blade elegan: `{{ Auth::guard('web')->user()->nama ?? '' }}`.

---

## 3. Refactoring Logika Backend (Controllers & Routing)

Logika inti yang dulunya terpusat di file raksasa `Admin.php` dan `Welcome.php` telah diurai menjadi pola *Routing* Laravel di `routes/web.php` dengan pembagian *Controller* yang rapi.

### A. Konversi Kueri Database (DB Facade)
Ratusan pemanggilan sintaks Mentah CI3 `$this->db->query("SELECT ...")` diubah menggunakan Fasad Database Laravel:
- **Query Builder Mentah**: `\DB::select("SELECT ...")`
- **Eloquent / Fluent Builder**: `DB::table('informasi_permohonan')->where('status', 'OPEN')->get()`

### B. Migrasi `WelcomeController.php` (Area Publik)
Menangani *landing page*, statistik publik, regulasi, maklumat, layanan informasi, dan AJAX pendaftaran. Fungsi-fungsi validasi (seperti validasi kode unik saat registrasi) diubah menggunakan `Request $request` dari Laravel, dan melempar *response* JSON native `response()->json()`.

### C. Migrasi `UserController.php` (Area Pemohon)
Berfungsi eksklusif menangani pengajuan permohonan informasi baru oleh masyarakat. Skrip unggahan (upload) dokumen persyaratan seperti KTP dan Akta dialihkan agar terintegrasi dengan metode penerimaan *File Object* dari `Illuminate\Http\Request`.

### D. Migrasi `AdminController.php` (Jantung Admin)
Lebih dari 1.200 baris kode berhasil di-*porting*:
- **Dasbor**: Mengembalikan data untuk Grafik Donat (status permohonan) dan Pie (tipe permohonan) melalui endpoint JSON.
- **DataTables Permohonan**: Server-side processing yang memfilter data berdasarkan tahun dan rentang waktu. Di sini letak perubahan paling kompleks terkait fungsi pencarian dan `GROUP BY`.
- **Tanggapan Berkas**: Fungsi `tanggapan` Admin memproses balasan surat, status ("APPROVE", "REJECT"), serta menangani unggahan berkas tanggapan resmi.
- **CRUD Pengaturan**: Pengelolaan "Informasi Publik", "Regulasi", "Maklumat", dan "Prosedur" sudah dikonversi sepenuhnya menjadi routing `GET`/`POST` khas Laravel.

---

## 4. Templating (Blade), View, & CSRF Protection

Demi mempertahankan UI/UX tanpa mematahkan logika frontend yang ribuan baris, kami mengadaptasi strategi injeksi keamanan ke dalam *view* lama.

### A. Restrukturisasi Blade dan Master Layout
Seluruh ekstensi file `.php` murni diubah menjadi `.blade.php`.
Master layout seperti `gabungan.blade.php` dikonfigurasi ulang:
Dari `<?php $this->load->view('admin/header.php'); ?>` menjadi `@include('admin.template_admin.header')`

### B. Cross-Site Request Forgery (CSRF) Security
Aplikasi bawaan sangat rentan karena AJAX tidak dilindungi. Di lingkungan baru:
1. Meta tag token CSRF ditanam ke setiap `<head>` HTML:
   `<meta name="csrf-token" content="{{ csrf_token() }}">`
2. **Global AJAX Setup**: 
   Skrip `$.ajaxSetup()` disuntikkan ke dalam `header.blade.php` agar setiap form dan kueri AJAX DataTables secara otomatis membungkus token keamanan tanpa perlu mengubah sintaks jQuery satu per satu.

### C. Manajemen *Assets Path*
Fungsi `base_url()` khas CI3 dikonversi menjadi `{{ url('/') }}` untuk memuat *style*, logo, skrip jQuery, dan plugin pihak ketiga.

---

## 5. File & Storage Management (Path Resolving)

Masalah paling signifikan pada migrasi sistem *legacy* adalah pemetaan file *upload* lama.
- **Skema CI3**: File disimpan pada *root* proyek seperti `./file/` atau `./upload/`.
- **Skema Laravel**: Secara arsitektur, aset eksternal dan unggahan publik wajib berada di bawah subdirektori `/public/`.
- **Eksekusi Migrasi**: Kami memindahkan direktori tampungan unggahan ke `public/file/` dan `public/upload/`. Kami kemudian merevisi perintah penyimpanan (fungsi `move_uploaded_file` bawaan dan *request* HTTP) agar menunjuk ke `public_path('file')`. 
Tindakan ini menjamin URL berkas lama dari CI3 di database tidak rusak (broken link) karena browser tetap dapat membacanya langsung layaknya URL asli di masa lalu.

---

## Validasi, Pengujian, dan Kesimpulan

Seluruh fungsi tulang punggung sistem kini berjalan stabil di lingkungan baru:
1. **Pendaftaran dan Login Hybrid** berhasil membaca Guard dengan sempurna.
2. Kueri **DataTables** untuk Dasbor Pemohon dan Dasbor Admin (Daftar Akun dan Daftar Permohonan) kini me-*render* tabel tanpa menghasilkan _Ajax Error_ (sebelumnya diakibatkan oleh *Strict Mode MySQL* dan konflik penamaan waktu `entry_date` vs `created_at`).
3. Seluruh fitur pengajuan dokumen masyarakat dan persetujuan/penolakan permohonan oleh Admin bekerja sesuai alur awal.

Dengan migrasi ini, **e-PPID** telah naik kelas dari segi keamanan (berkat Blade dan proteksi CSRF Laravel) dan maintainabilitas kueri database tanpa memaksa *developer* untuk menulis ulang ribuan baris CSS/jQuery dari awal. Sistem ini sekarang sudah 100% siap dikembangkan lebih jauh mengikuti standar PHP masa depan.
