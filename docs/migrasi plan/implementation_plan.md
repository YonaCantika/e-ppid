# Rencana Migrasi: CodeIgniter 3 (e-ppid) ke Laravel (e-ppidv2)

Dokumen ini menguraikan langkah-langkah rencana untuk memigrasikan aplikasi CodeIgniter 3 `e-ppid` ke framework Laravel di folder `e-ppidv2`.

## Membutuhkan Tinjauan Pengguna (User Review Required)

> [!WARNING]
> Ini adalah migrasi framework penuh (total). Proses ini akan melibatkan penggantian seluruh logika backend dan pembaruan pada lapisan tampilan (view). Harap tinjau rencana di bawah ini. Kita akan menggunakan direktori Laravel `e-ppidv2` yang sudah ada. Jika database `ptgaramc_ppid` sudah ada di lokal, kita akan menggunakannya; jika belum, kita perlu mengaturnya.

## Pertanyaan Terbuka (Open Questions)

> [!IMPORTANT]
> 1. Apakah Anda ingin menggunakan database MySQL `ptgaramc_ppid` yang sudah ada langsung, atau haruskah kita membuat Migration & Seeder Laravel untuk membuat struktur database dari awal berdasarkan file `.sql` yang disediakan?
> 2. Apakah ada paket otentikasi tertentu yang Anda sukai di Laravel (misalnya, Laravel Breeze, Jetstream, UI) atau haruskah kita memigrasikan logika otentikasi custom (bawaan CI3) yang sudah ada secara manual?
> 3. Apakah kita harus mempertahankan antarmuka pengguna (UI) yang persis sama dan hanya mengubahnya ke sistem templating Blade, atau apakah Anda mengharapkan adanya modernisasi UI selama migrasi ini?

## Rencana Perubahan (Proposed Changes)

Kita akan membagi migrasi ini menjadi fase-fase berikut:

---

### Fase 1: Konfigurasi Lingkungan & Database
- Mengkonfigurasi `.env` di `e-ppidv2` untuk terhubung ke database MySQL.
- Membuat Migration Laravel untuk semua tabel yang ada di `ptgaramc_ppid.sql`:
  - `background`, `informasi`, `informasi_permohonan`, `kategori`, `kontak`, `logo`, `menu`, `pemohon`, `regulasi`, `tb_api_wa`, `user`.
- Membuat Model Eloquent untuk semua tabel tersebut di dalam `app/Models/`.

### Fase 2: Migrasi Aset (Asset Migration)
- Menyalin semua aset statis dari proyek CI3 ke direktori `public` di Laravel:
  - `assets/`, `assets_user/`, `file/`, `foto/`, `galery/`, `upload/`.

### Fase 3: Migrasi Routing
- Menerjemahkan rute-rute di `application/config/routes.php` dan rute implisit CI3 ke dalam Laravel `routes/web.php`.
- Rute-rute yang diharapkan untuk dipetakan: `/beranda`, `/profil`, `/kalender`, `/regulasi`, `/maklumat`, `/layanan`, `/keberatan`, `/permohonan`, `/daftar`, `/informasi/{id}`, serta semua rute `/admin`, `/user`, dan `/secure`.

### Fase 4: Migrasi Controller & Logika
Memigrasikan 4 controller utama CI3 ke Controller Laravel:
- **WelcomeController**: Menangani halaman publik (beranda, profil, dll).
- **AuthController** (dari `Secure.php`): Menangani login, logout, dan pendaftaran (registrasi).
- **AdminController**: Menangani dashboard admin dan operasi CRUD (Create, Read, Update, Delete).
- **UserController**: Menangani dashboard pengguna/pemohon.

### Fase 5: Migrasi Tampilan (Blade Views)
- Mengonversi semua file `.php` di `application/views/` (admin, user, web, errors) menjadi template Laravel Blade (`.blade.php`) di dalam `resources/views/`.
- Mengganti helper URL CI3 (`base_url()`, `site_url()`) dengan helper Laravel (`asset()`, `url()`, `route()`).
- Memperbarui pengiriman form (form submit) untuk menyertakan token `@csrf`.

---

## Rencana Verifikasi (Verification Plan)

### Pengujian Otomatis
- Tidak Ada (Kita akan mengandalkan pengujian manual kecuali jika Anda meminta pembuatan test otomatis).

### Verifikasi Manual
- Menjalankan server pengembangan lokal Laravel (`php artisan serve` atau via URL Laragon).
- Memverifikasi halaman publik dimuat dengan benar dan aset statis (CSS/JS/gambar) berfungsi.
- Menguji alur pendaftaran dan login pengguna.
- Menguji login admin dan operasi CRUD pada dashboard admin.
- Memverifikasi unggahan file (file upload) berfungsi dengan benar di lingkungan Laravel yang baru.
