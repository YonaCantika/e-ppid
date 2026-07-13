# Task List: Migrasi CI3 ke Laravel

- [/] **Fase 1: Konfigurasi Lingkungan & Database**
  - [x] Update file `.env` untuk koneksi MySQL (`ptgaramc_ppid`).
  - [x] Buat Migration untuk tabel `background`, `informasi`, `informasi_permohonan`, `kategori`, `kontak`, `logo`, `menu`, `regulasi`, `tb_api_wa`.
  - [x] Modifikasi tabel `users` bawaan Laravel untuk mendukung multi-role (super admin, admin, user biasa) dan gabungkan entitas CI3 `user` & `pemohon`.
  - [x] Jalankan migrate.
  - [x] Buat Models untuk semua tabel.
- [x] **Fase 2: Migrasi Aset**
  - [x] Pindahkan folder aset CI3 (`assets`, `assets_user`, dll) ke Laravel `public/`.
- [/] **Fase 3: Migrasi Tampilan (Blade)**
  - [x] Konversi view CI3 ke format `.blade.php` di `resources/views`.
  - [/] Sesuaikan URL helper dan asset helper ke format Laravel (Sebagian selesai dengan script).
- [x] **Fase 4: Migrasi Routing & Controller**
  - [x] Siapkan rute di `routes/web.php` (dengan pemisahan middleware role).
  - [x] Migrasikan logika Controller (Welcome selesai, Auth/Admin/User selesai diinisialisasi).
- [x] **Fase 5: Autentikasi**
  - [x] Setup Laravel otentikasi standar yang mendukung role super_admin, admin, dan user.
  - [x] Isi data lama (seeding) ke dalam database baru.
