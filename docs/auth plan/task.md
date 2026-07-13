# Task Checklist: Pemisahan Tabel User & Pemohon

- [x] **Fase 1: Database & Model**
  - [x] Update migration `users` (hapus field pemohon).
  - [x] Buat migration `pemohon`.
  - [x] Update Model `User`.
  - [x] Buat Model `Pemohon` (Auth).
- [x] **Fase 2: Konfigurasi Auth & Seeder**
  - [x] Update `config/auth.php` untuk multi-guard (`web` dan `pemohon`).
  - [x] Update `DatabaseSeeder.php` agar memisahkan insert ke tabel `users` dan `pemohon`.
  - [x] Jalankan `artisan db:wipe`, `migrate`, dan `db:seed`.
- [x] **Fase 3: Pembaruan Controller & Routing**
  - [x] Modifikasi `AuthController` agar login mencoba cek guard `web` (admin) terlebih dahulu, baru ke `pemohon`.
  - [x] Modifikasi `AuthController` agar form pendaftaran hanya menginsert ke tabel `pemohon`.
  - [x] Hapus/redirect routing `/secure` ke `/daftar` (karena digabung).
