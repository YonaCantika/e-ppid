# Rencana Penyelesaian Migrasi e-PPID ke Laravel 12

Melanjutkan proses migrasi (Pemindahan) aplikasi dari **CodeIgniter 3** ke **Laravel 12**, saat ini sistem Otentikasi (Multi-Guard) dan area Pengguna/Pemohon (User Dashboard & CRUD Permohonan) sudah berhasil diselesaikan.

Langkah selanjutnya adalah memigrasikan dua komponen terbesar yang tersisa: **Website Publik (WelcomeController)** dan **Panel Admin (AdminController)**. Rencana ini menguraikan tahapan untuk memindahkan seluruh sisa logika bisnis tersebut tanpa mengubah kerangka tampilan (UI/UX) yang sudah ada.

## User Review Required

> [!IMPORTANT]  
> Migrasi panel Admin sangat masif (mengandung lebih dari 1200 baris kode CI3). Proses ini akan memakan waktu karena melibatkan banyak formulir, *upload* file, dan pengolahan *chart*. Apakah Anda menyetujui tahapan di bawah ini agar saya bisa langsung mengeksekusinya secara berurutan?

## Open Questions

> [!WARNING]  
> 1. **Pengiriman Email & Notifikasi WA**: Di versi lama, ada kode yang mengirimkan pesan via *WhatsApp API* (`$this->task->api_whatsapp3`) dan Email. Apakah Anda ingin fungsi ini langsung diaktifkan di versi Laravel, atau dinonaktifkan sementara untuk keperluan *testing*?
> 2. **File Uploads**: Laravel memiliki sistem manajemen *file* yang berbeda dengan CI3. Saya akan mengarahkan semua *file upload* ke folder `public/upload` agar *link* lama tetap bisa diakses. Apakah ini sesuai?

---

## Proposed Changes

Proses migrasi akan dibagi menjadi tiga tahapan besar (Fase 3, 4, dan 5).

### Fase 3: Melengkapi Fungsi Website Publik (WelcomeController)
Menyempurnakan fungsi halaman depan agar pengunjung dapat melihat informasi, mendaftar, dan melakukan *reset password*.

#### [MODIFY] `routes/web.php`
- Menambahkan semua rute AJAX untuk registrasi, validasi email, dan lupa *password* (misal: `/register_visitor2`, `/validasi_kode_unik`, dll).

#### [MODIFY] `app/Http/Controllers/WelcomeController.php`
- Memindahkan *query* statistik dan informasi publik di fungsi `informasi_publik()`.
- Memindahkan fungsi pengiriman *email* aktivasi menggunakan komponen *Mail* bawaan Laravel.
- Memindahkan fungsi AJAX untuk verifikasi kode unik dan *reset password*.

---

### Fase 4: Migrasi Panel Admin Inti (AdminController) - Part 1
Fase ini fokus pada fitur utama pengolahan data pemohon dan permohonan.

#### [MODIFY] `routes/web.php`
- Mendaftarkan rute khusus admin yang dilindungi oleh *middleware* `auth:web`.
- Mendaftarkan rute AJAX `listdatapemohon`, `listakunpemohon`, `tanggapan`, dll.

#### [MODIFY] `app/Http/Controllers/AdminController.php`
- **Dashboard & Charts**: Memindahkan fungsi pemanggilan data statistik `chart_donat_status` dan `chart_pie_tipe`.
- **Daftar Pemohon**: Memindahkan fungsi *DataTables* untuk akun pemohon.
- **Daftar Permohonan**: Memindahkan fungsi *DataTables* permohonan.
- **Tanggapan Permohonan**: Memindahkan logika *upload* file tanggapan (PDF/Gambar) ke dalam sistem *Storage* Laravel dan menyimpan status permohonan.

#### [MODIFY] Tampilan (Views) Admin
- Menghapus semua sintaks CI3 `$this->session->userdata(...)` di *sidebar* dan *header* Admin, diganti dengan `Auth::guard('web')`.
- Menyisipkan `<meta name="csrf-token">` ke dalam *header* admin agar AJAX berjalan normal.

---

### Fase 5: Migrasi Fitur Pengaturan Admin (AdminController) - Part 2
Fase ini fokus pada pengaturan dinamis web (Menu, Informasi Publik, Maklumat, Regulasi, dll).

#### [MODIFY] `app/Http/Controllers/AdminController.php`
- Memindahkan fungsi CRUD (Tambah/Edit/Hapus) untuk **Menu Dinamis**.
- Memindahkan fungsi CRUD untuk **Informasi Publik**.
- Memindahkan fungsi *upload file* untuk Regulasi & Prosedur.

## Verification Plan

### Manual Verification
1. **Pendaftaran Web**: Mencoba mendaftar sebagai pemohon baru dari halaman depan, memastikan email terkirim atau data masuk ke _database_ dengan status aktif.
2. **Dashboard Admin**: *Login* sebagai Admin, memverifikasi grafik donat dan *pie chart* muncul sesuai data.
3. **Menu Tanggapan**: Melakukan simulasi menanggapi permohonan dengan mengunggah sebuah *file* dari sisi Admin. Memastikan *file* berhasil diunggah dan bisa diunduh oleh Pemohon.
4. **DataTables**: Memastikan semua tabel di sisi Admin tidak memunculkan *error* AJAX 419 atau 500.
