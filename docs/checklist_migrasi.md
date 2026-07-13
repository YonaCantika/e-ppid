# Checklist Status Migrasi e-PPID (CI3 ke Laravel 12)

Berikut adalah tabel rekapitulasi status migrasi fitur dari sistem lama (CodeIgniter 3) ke dalam struktur aplikasi baru (Laravel 12).

| Fitur di CI3 (Legacy) | Status (Laravel 12) | Catatan Penting / Perbedaan Logika |
| :--- | :---: | :--- |
| **Sistem Session & Login** | ✅ Selesai | Menggunakan **Multi-Guard Authentication** bawaan Laravel (`web` dan `pemohon`), menggantikan `$this->session->userdata()`. Form login publik digabung secara cerdas (*hybrid*). |
| **Registrasi & Kode Unik** | ✅ Selesai | Validasi form dipindah ke `WelcomeController@register_visitor2`. Proses simpan menggunakan Eloquent/Query Builder. Password lama tetap di-hash pakai MD5 untuk kompatibilitas. |
| **Upload KTP & Akta** | ✅ Selesai | Path penyimpanan diubah secara permanen dari `./file/` menjadi folder `public/upload/` agar file dapat diakses langsung tanpa terhalang *routing* framework. |
| **Dasbor Pengguna (Pemohon)** | ✅ Selesai | DataTables dirender di `UserController`. Query `GROUP BY` dirapikan untuk mencegah bentrok dengan *Strict Mode* MySQL Laravel. |
| **Pengajuan Informasi (Form)** | ✅ Selesai | Fungsi form *submit* menggunakan CSRF Token otomatis dari `$.ajaxSetup` di *header* `gabungan.blade.php`. |
| **Daftar Permohonan (Admin)** | ✅ Selesai | Fungsi Server-Side DataTables dipindah ke `AdminController@listdatapemohon`. Kolom pencarian disesuaikan dengan struktur `$table->timestamps()` (`created_at`). |
| **Daftar Akun (Admin)** | ✅ Selesai | Query kompleks DataTables yang menghitung total pengajuan per-akun berhasil dieksekusi menggunakan `DB::raw()` di `AdminController@listakunpemohon`. |
| **Tanggapan Berkas (Admin)** | ✅ Selesai | Admin bisa memberikan respons `APPROVE`/`REJECT`. Upload PDF lampiran tanggapan dialihkan ke direktori `public/file/`. |
| **Pengaturan / CMS Publik** | ✅ Selesai | Manajemen Maklumat, Menu, Regulasi, dan Profil (CRUD biasa) dipindah ke `AdminController` menggunakan `\DB::table()->insert()` dan `update()`. |
| **Notifikasi WA/Email** | ⏳ Tertunda | (Opsional) Fungsi panggilan ke SMTP dan API Fonnte / WhatsApp dinonaktifkan sementara (di-komen) sesuai instruksi _user_ agar pengujian tidak tertahan. |
| **Template UI (AdminLTE)** | ✅ Selesai | 100% Antarmuka lama dipertahankan. File berektensi `.php` murni diubah jadi `.blade.php` dan dilindungi oleh `@csrf`. |

Tabel ini dapat digunakan sebagai landasan apabila ada *testing* atau fase *Quality Assurance (QA)* di kemudian hari.
