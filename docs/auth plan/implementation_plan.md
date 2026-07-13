# Pemisahan Tabel User dan Pemohon (Multi-Guard Authentication)

Mengembalikan struktur database sesuai dengan versi CodeIgniter 3 di mana entitas admin (`users`) dan pemohon (`pemohon`) dipisahkan ke dalam dua tabel dan model yang berbeda. Kita juga akan menerapkan dua pintu masuk (form login) yang berbeda dengan pengamanan (guard) yang saling terpisah.

## User Review Required
> [!IMPORTANT]
> Pemisahan ini akan menghapus skema tabel `users` gabungan saat ini, lalu membaginya menjadi 2 tabel:
> 1. Tabel **`users`** (Khusus untuk Super Admin & Admin)
> 2. Tabel **`pemohon`** (Khusus untuk Pengguna Publik/Pemohon)
>
> Hal ini mengharuskan kita untuk melakukan **Migration Fresh** ulang yang akan menghapus data di database saat ini, namun karena kita sudah punya *Seeder* dari data SQL lama Anda, data awal tidak akan hilang permanen dan akan otomatis dimasukkan kembali.

## Open Questions
> [!WARNING]
> 1. Apakah Anda ingin URL login admin tetap menggunakan path `/secure` seperti di CI3 lama?
> 2. Apakah form pendaftaran hanya khusus untuk tabel `pemohon` saja, sedangkan penambahan admin baru hanya bisa dilakukan dari dalam *Dashboard Admin*?

## Proposed Changes

### Database & Migrations
#### [MODIFY] `database/migrations/2024_01_01_000000_create_users_table.php`
- Menghapus kolom-kolom terkait pemohon dari tabel `users`.
- Menyesuaikan kolom `users` hanya untuk admin: `nama`, `email`, `password`, `role` (super_admin, admin), `id_emp`, `status`.

#### [NEW] `database/migrations/xxxx_xx_xx_xxxxxx_create_pemohon_table.php`
- Membuat skema tabel khusus untuk pemohon dengan kolom: `id_jenis`, `id_identitas`, `nomor_identitas`, `nama`, `npwp`, `pekerjaan`, `alamat`, `notelp`, `nofax`, `email`, `password`, `ktp`, `akta`, `status`, `kode_unik`.

### Models & Security Configurations
#### [MODIFY] `app/Models/User.php`
- Merapikan struktur model admin.

#### [NEW] `app/Models/Pemohon.php`
- Membuat model otentikasi khusus untuk tabel pemohon (meng-extend `Illuminate\Foundation\Auth\User`).

#### [MODIFY] `config/auth.php`
- Menambahkan konfigurasi *Multi-Guard*:
  - Guard `web`: menggunakan provider `users`.
  - Guard `pemohon`: menggunakan provider `pemohon`.

### Controllers & Seeder
#### [MODIFY] `database/seeders/DatabaseSeeder.php`
- Memperbarui penyisipan data lama agar admin masuk ke tabel `users` dan pemohon masuk ke tabel `pemohon`.

#### [MODIFY] `app/Http/Controllers/AuthController.php`
- Memisahkan logika pengecekan login:
  - Form Pemohon (`/daftar`): menggunakan `Auth::guard('pemohon')->attempt()`.
  - Form Admin (`/secure`): menggunakan `Auth::guard('web')->attempt()`.

#### [MODIFY] `routes/web.php`
- Memasang *middleware* perlindungan rute:
  - `auth:pemohon` untuk rute-rute dashboard pemohon.
  - `auth:web` untuk rute-rute dashboard admin.

## Verification Plan

### Manual Verification
1. Jalankan `php artisan migrate:fresh --seed`.
2. Buka rute login pemohon (`/daftar`) dan lakukan login. Verifikasi bahwa sesi tersimpan menggunakan guard `pemohon`.
3. Buka rute login admin (`/secure`) dan lakukan login. Verifikasi bahwa sesi tersimpan menggunakan guard `web`.
4. Akses *dashboard* admin dengan sesi pemohon dan pastikan otomatis tertolak (redirect back to login).
