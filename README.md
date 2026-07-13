# Aplikasi e-PPID v2 (Laravel 12 Version)

Aplikasi **e-PPID (Pejabat Pengelola Informasi dan Dokumentasi)** versi 2 merupakan sistem informasi terpadu yang memfasilitasi pelaporan, permohonan informasi, dan dokumentasi layanan publik. 

Proyek ini adalah hasil **Refactoring/Migrasi** dari *framework* peninggalan CodeIgniter 3 (PHP 5.6) ke dalam arsitektur modern **Laravel 12 (PHP 8.2)** dengan mengadaptasi model keamanan otentikasi *Multi-Guard* (pemisahan logis antara data Admin dan data Masyarakat/Pemohon).

---

## 🛠️ Persyaratan Sistem (System Requirements)

Sebelum melakukan instalasi, pastikan *server* atau lingkungan pengembangan (Localhost) Anda memenuhi syarat minimum berikut:

- **PHP** : Versi `8.2` atau lebih baru.
- **Database** : MySQL `8.0+` atau MariaDB.
- **Web Server** : Nginx atau Apache (Laragon/XAMPP direkomendasikan untuk Windows).
- **Composer** : *Dependency Manager* PHP versi terbaru.

---

## 🚀 Panduan Instalasi Cepat

Ikuti langkah-langkah di bawah ini untuk menjalankan aplikasi pada *local machine* (komputer lokal) Anda.

### 1. Kloning Repositori
Jika Anda mendapatkan *source code* berupa file `.zip`, ekstrak folder tersebut. Masuk ke dalam direktori aplikasi melalui Terminal (Command Prompt / Git Bash):
```bash
cd c:/laragon/www/e-ppidv2
```

### 2. Instalasi Dependensi (Packages)
Pastikan Anda sudah menginstal Composer. Jalankan perintah berikut untuk mengunduh seluruh *library* pendukung Laravel:
```bash
composer install
```

### 3. Konfigurasi Environment (`.env`)
Laravel membutuhkan file penyimpan konfigurasi rahasia (`.env`).
- Salin *template* file konfigurasi bawaan. Di Terminal, jalankan:
  ```bash
  cp .env.example .env
  ```
- Buka file `.env` menggunakan *code editor* pilihan Anda (seperti VSCode), dan modifikasi bagian *Database* agar sesuai dengan koneksi MySQL Anda:
  ```ini
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=ptgaramc_ppid    # Sesuaikan nama database
  DB_USERNAME=root
  DB_PASSWORD=
  ```

### 4. Buat Kunci Enkripsi (App Key)
Amankan instalasi Anda dengan men-generate *encryption key*. Kunci ini krusial untuk sesi pengguna:
```bash
php artisan key:generate
```

### 5. Konfigurasi Storage & Folder Upload
Sistem e-PPID sangat bergantung pada fitur unggah berkas (seperti KTP, Akta, Surat Keputusan).
Pastikan *directory* (folder) berikut ada di dalam proyek Anda dan memiliki izin tulis (_write permission_):
- `public/file/` (Untuk unggahan surat tanggapan dan berkas admin)
- `public/upload/` (Untuk foto bukti kependudukan)

### 6. Jalankan Server Development
Anda dapat menyalakan *built-in server* Laravel dengan perintah:
```bash
php artisan serve
```
Akses aplikasi melalui browser di: `http://localhost:8000`

> **Note**: Jika Anda menggunakan **Laragon**, Anda cukup mengakses URL *virtual host* (misal: `http://e-ppidv2.test`) langsung dari browser tanpa perlu mengeksekusi `php artisan serve`.

---

## 📚 Bacaan Lebih Lanjut
Untuk pemahaman mendalam secara arsitektur pengembangan dan modifikasi lanjutan, Anda dapat membaca dokumentasi yang terlampir pada direktori `/docs/`:
- **`docs/laporan.md`** : Dokumen ringkas riwayat migrasi hulu ke hilir.
- **`docs/dokumentasi_teknis.md`** : Peta dan alur perjalanan MVC arsitektur.
- **`docs/dokumentasi_fitur.md`** : Bedah teknis API dan pergerakan antar modul/fitur fungsional.
- **`docs/dokumentasi_maintenance.md`** : Konfigurasi ERD, `.env`, dan kumpulan modul pihak ketiga.

---

> **Developer Note**
> Aplikasi ini dibangun dengan metode _hybrid_ untuk menekan ongkos perubahan UI/UX pengguna awal. Oleh karenanya, hindari penambahan *package backend* pihak ketiga (seperti DataTables Laravel Package) secara sembarangan yang bisa memicu intervensi merusak pada logika JavaScript jQuery bawaan (skrip DataTables dan AJAX form asli) di dalam file *View*. 