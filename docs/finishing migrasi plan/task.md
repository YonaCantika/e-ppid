# Task: Migrasi WelcomeController dan AdminController

- `[x]` Fase 3: Website Publik (WelcomeController)
  - `[x]` Mendaftarkan rute AJAX dan rute halaman di `routes/web.php`
  - `[x]` Memigrasikan fungsi statistik pada `informasi_publik`
  - `[x]` Memigrasikan fungsi pendaftaran (`register_visitor2`) - Matikan notif WA/Email
  - `[x]` Memigrasikan fungsi AJAX `validasi_kode_unik`, `cek_email`, `lupa_password2`, `change_password`
- `[x]` Fase 4: Panel Admin Inti (AdminController)
  - `[x]` Mendaftarkan rute dashboard dan DataTables pemohon & permohonan
  - `[x]` Memigrasikan fungsi `listdatapemohon` dan `listakunpemohon`
  - `[x]` Memigrasikan fungsi `chart_donat_status` dan `chart_pie_tipe`
  - `[x]` Memigrasikan fungsi `tanggapan` (Upload file ke folder public/file atau public/upload)
  - `[x]` Memperbarui View Admin (Hapus `$this->session`, tambahkan CSRF)
- `[x]` Fase 5: Pengaturan Admin
  - `[x]` CRUD Menu
  - `[x]` CRUD Informasi Publik
  - `[x]` CRUD Lainnya (Regulasi, Prosedur, dll)
