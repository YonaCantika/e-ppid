# Ringkasan Pemisahan Tabel Pemohon dan Admin

Saya telah berhasil merombak ulang kerangka otentikasi agar persis mengikuti gaya arsitektur CI3 lama di mana Admin dan Pemohon dipisahkan di level tabel, namun tetap modern dengan pendekatan Multi-Guard Authentication bawaan Laravel.

## Yang Telah Diselesaikan:
1. **Pembuatan Tabel Terpisah**
   - Tabel `users`: Dikembalikan fungsinya murni khusus untuk menampung *Super Admin* dan *Admin*.
   - Tabel `pemohon`: Diciptakan tabel mandiri baru yang khusus menampung data pemohon publik.
2. **Penerapan Multi-Guard**
   - `Auth::guard('web')`: Digunakan untuk melindungi rute dan mengecek sesi login para Admin.
   - `Auth::guard('pemohon')`: Digunakan untuk melindungi rute dan mengecek sesi login para Pemohon.
3. **Penyatuan Form Login di `/daftar`**
   - Logika form login (di `/daftar`) telah diubah sehingga saat user menekan tombol Login, sistem akan terlebih dahulu mengecek ketersediaan email di tabel `users` (Admin). Jika gagal, sistem akan otomatis mencarinya di tabel `pemohon`.
   - Form Registrasi (Daftar) dirancang murni hanya akan menyimpan data ke tabel `pemohon`.

### Tahap 3: Website Publik & Pendaftaran (Selesai)
- **Controller**: `WelcomeController` sudah ditambahkan dengan metode `informasi_publik`, `pendaftaran`, `lupa_password`.
- **AJAX Endpoints**: Fungsionalitas AJAX pada registrasi (`register_visitor2`, `validasi_kode_unik`) dan lupa password (`lupa_password2`) sudah dimigrasikan.
- **Views**: View publik (`welcome_message.blade.php`, `web/pendaftaran.blade.php`, dll.) sudah diperbaiki `<img>` path, `@include`, dan diberikan perlindungan CSRF.

### Tahap 4: Admin Inti (Selesai)
- **Controller**: `AdminController` kini menangani menu "My Task", "Daftar Permohonan", dan "Daftar Pemohon".
- **Chart & DataTables**: Endpoint API `chart_donat_status`, `chart_pie_tipe`, `listdatapemohon`, dan `listakunpemohon` sudah dikonversi menggunakan Eloquent/Query Builder Laravel.
- **Tanggapan**: Form upload `tanggapan` dari sisi Admin sudah dikonfigurasi agar memindahkan file ke `public/file` (menjaga kompatibilitas URL file CI3).
- **Views**: `header.blade.php` dan `sidebar.blade.php` pada Admin sudah di-refactor untuk tidak menggunakan `$this->session` namun menggunakan `Auth::guard('web')->user()`.

### Tahap 5: Pengaturan Admin Selesai
- **CRUD Settings**: Pembuatan fitur manajemen menu, profil, regulasi, maklumat, prosedur, dan informasi publik sudah dibuat rutenya dan ditulis ulang dalam Laravel.

## Hasil Validasi
Semua perubahan kini berjalan dalam ekosistem Laravel menggunakan teknik hybrid: Auth multi-guard Laravel dan tampilan + AJAX bawaan CI3. Dengan konfigurasi ini, transisi dari PHP 5.6 ke PHP 8.2 bisa dilakukan tanpa harus menulis ulang interface secara drastis dari awal.
