# Hasil Migrasi e-ppid ke Laravel

Migrasi tahap awal dari CodeIgniter 3 ke Laravel telah berhasil dilakukan. Berikut adalah rangkuman dari apa saja yang telah dibangun di dalam aplikasi `e-ppidv2`:

## Database & Data Lama
- Semua tabel dari CI3 telah dikonversi menjadi skema **Laravel Migration**.
- **Data Lama (Seeding):** Saya telah membuat `DatabaseSeeder` yang menyuntikkan (insert) kembali data-data dari file SQL lama Anda (seperti data kategori, menu, regulasi, kontak, dan logo) ke dalam database baru.

## Sistem Otentikasi (Multi-Role)
> [!NOTE]
> **Tidak menggunakan Laravel Breeze.** Sesuai dengan instruksi Anda ("standar aja"), saya membangun logika otentikasi kustom menggunakan standar bawaan `Illuminate\Support\Facades\Auth`. 

Hal ini dilakukan agar lebih mudah mengadopsi skema *legacy* dari CI3 (di mana `user` dan `pemohon` digabungkan menjadi satu tabel `users` dengan peran yang berbeda). 
- **AuthController:** Telah dibuat untuk menangani logika `login`, `daftar`, dan `logout`.
- **Role System:** Tabel `users` kini memiliki kolom `role` (berisi: `super_admin`, `admin`, `user`).
- Saat login, aplikasi akan mengecek *role* pengguna dan mengarahkannya ke dashboard yang sesuai (`AdminController` atau `UserController`).

## Tampilan (View)
- Semua tampilan CI3 (`.php`) telah dikonversi menjadi ekstensi `.blade.php`.
- Tag-tag PHP dasar (seperti `<?php echo ... ?>` dan `<?= ... ?>`) telah di-*replace* secara otomatis menggunakan script menjadi *Blade syntax* (`{{ ... }}`).
- **AdminController & UserController** telah dibuat kerangkanya (skeleton) untuk menyambungkan dengan tampilan *dashboard* mereka.

## Langkah Selanjutnya untuk Anda
Aplikasi ini sudah berstruktur Laravel secara utuh dan siap dijalankan. Anda dapat mencoba melihat halamannya dan *login* menggunakan akun lama yang telah dimasukkan via Seeder:
- **Admin:** `admin@gmail.com` / Password: `12345`
- **User Biasa (Pemohon):** `aldiragilromadhon@gmail.com` / Password: `admin`

Jika ada tampilan (view) yang terlihat error (karena ada sisa fungsi CI3 yang terlalu kompleks dan gagal dikonversi oleh *script* otomatis), kita bisa merapikannya satu per satu.
