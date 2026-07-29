<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperAdminController;

// Halaman Publik (WelcomeController)
Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::get('/beranda', [WelcomeController::class, 'index'])->name('beranda');
Route::get('/profil', [WelcomeController::class, 'profil'])->name('profil');
Route::get('/kalender', [WelcomeController::class, 'kalender'])->name('kalender');
Route::get('/regulasi', [WelcomeController::class, 'regulasi'])->name('regulasi');
Route::get('/maklumat', [WelcomeController::class, 'maklumat'])->name('maklumat');
Route::get('/layanan', [WelcomeController::class, 'layanan_informasi'])->name('layanan');
Route::get('/keberatan', [WelcomeController::class, 'layanan_keberatan'])->name('keberatan');
Route::get('/permohonan', [WelcomeController::class, 'permohonan'])->name('permohonan');
Route::post('/permohonan', [WelcomeController::class, 'submit_permohonan'])->name('permohonan.submit');
Route::get('/informasi/{id}', [WelcomeController::class, 'informasi_publik'])->name('informasi');
Route::get('/validasi', [WelcomeController::class, 'validasi'])->name('validasi');
Route::get('/verifikasi-akun/{id}/{hash}', [WelcomeController::class, 'verify_email_link'])->name('verifikasi.link');
Route::get('/ubah_password', [WelcomeController::class, 'ubah_password'])->name('ubah_password');

// AJAX Routes untuk WelcomeController
Route::post('/register_visitor2', [WelcomeController::class, 'register_visitor2']);
Route::post('/validasi_kode_unik', [WelcomeController::class, 'validasi_kode_unik']);
Route::post('/resend_otp', [WelcomeController::class, 'resend_otp'])->name('resend.otp');
Route::post('/cancel_registration', [WelcomeController::class, 'cancel_registration'])->name('cancel.registration');
Route::post('/cek_email', [WelcomeController::class, 'cek_email']);
Route::post('/lupa_password2', [WelcomeController::class, 'lupa_password2']);
Route::post('/change_password', [WelcomeController::class, 'change_password']);

// Otentikasi (AuthController / Secure)
// Login route harus bernama 'login' agar middleware auth default Laravel bisa redirect ke sini
Route::get('/daftar', [AuthController::class, 'daftar'])->name('login'); 
Route::get('/login', function() {
    return redirect()->route('login');
});

Route::post('/daftar', [AuthController::class, 'submit_daftar'])->name('daftar.submit');
Route::post('/login', [AuthController::class, 'submit_login'])->name('login.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/secure/logout', [AuthController::class, 'logout']); // Fallback untuk link lama
Route::get('/lupa_password', [AuthController::class, 'lupa_password'])->name('lupa_password');

// Area Pengguna Biasa / Pemohon (UserController) - Diproteksi auth & verified email OTP
Route::middleware(['auth:pemohon', 'verified.pemohon'])->prefix('user')->name('user.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('dashboard');
    Route::get('/view_permohonan', [UserController::class, 'view_permohonan'])->name('view_permohonan');
    Route::get('/listdatapemohon', [UserController::class, 'listdatapemohon']);
    Route::post('/getModalAddPermohonan', [UserController::class, 'getModalAddPermohonan']);
    Route::post('/add_permohonan', [UserController::class, 'add_permohonan']);
    Route::post('/delete_permohonan', [UserController::class, 'delete_permohonan']);
    Route::post('/form_editView_permohonan', [UserController::class, 'form_editView_permohonan']);
    Route::post('/edit_permohonan', [UserController::class, 'edit_permohonan']);
    // Tambahkan rute user lainnya dari CI3 di sini
});

// Area Admin (AdminController)
Route::middleware(['auth:web'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/view_permohonan', [AdminController::class, 'view_permohonan'])->name('view_permohonan');
    Route::get('/view_pemohon', [AdminController::class, 'view_pemohon'])->name('view_pemohon');
    Route::get('/view_menu', [AdminController::class, 'view_menu'])->name('view_menu');
    Route::get('/menu_menu/{id}', [AdminController::class, 'menu_menu']);
    
    // API DataTables & Chart
    Route::get('/listdatapemohon', [AdminController::class, 'listdatapemohon']);
    Route::get('/listakunpemohon', [AdminController::class, 'listakunpemohon']);
    Route::get('/chart_donat_status', [AdminController::class, 'chart_donat_status']);
    Route::get('/chart_pie_tipe', [AdminController::class, 'chart_pie_tipe']);
    Route::get('/listmenu', [AdminController::class, 'listmenu']);
    Route::get('/list_informasi_publik', [AdminController::class, 'list_informasi_publik']);
    Route::get('/list_regulasi', [AdminController::class, 'list_regulasi']);
    Route::get('/list_maklumat', [AdminController::class, 'list_maklumat']);
    Route::get('/list_profil', [AdminController::class, 'list_profil']);
    Route::get('/list_prosedur', [AdminController::class, 'list_prosedur']);
    
    // CRUD Permohonan & Tanggapan
    Route::post('/tanggapan', [AdminController::class, 'tanggapan']);
    Route::post('/form_editView_permohonan', [AdminController::class, 'form_editView_permohonan']);

    // CRUD Menu
    Route::post('/getModalAddMenu', [AdminController::class, 'getModalAddMenu']);
    Route::post('/generate_link', [AdminController::class, 'generate_link']);
    Route::post('/add_menu', [AdminController::class, 'add_menu']);
    Route::post('/form_editView_menu', [AdminController::class, 'form_editView_menu']);
    Route::post('/save_editmenu', [AdminController::class, 'save_editmenu']);

    // CRUD Informasi Publik
    Route::post('/getModalAddMenu_informasi', [AdminController::class, 'getModalAddMenu_informasi']);
    Route::post('/add_informasi_publik', [AdminController::class, 'add_informasi_publik']);
    Route::post('/form_editView_informasi', [AdminController::class, 'form_editView_informasi']);
    Route::post('/save_editinformasi', [AdminController::class, 'save_editinformasi']);

    // CRUD Settings (Regulasi, Maklumat, Profil, Prosedur)
    Route::post('/getModalAddMenu_regulasi', [AdminController::class, 'getModalAddMenu_regulasi']);
    Route::post('/add_regulasi', [AdminController::class, 'add_regulasi']);
    Route::post('/form_editView_regulasi', [AdminController::class, 'form_editView_regulasi']);
    Route::post('/edit_regulasi', [AdminController::class, 'edit_regulasi']);
    
    Route::post('/form_editView_maklumat', [AdminController::class, 'form_editView_maklumat']);
    Route::post('/edit_maklumat', [AdminController::class, 'edit_maklumat']);

    Route::post('/form_editView_profil', [AdminController::class, 'form_editView_profil']);
    Route::post('/edit_profil', [AdminController::class, 'edit_profil']);

    Route::post('/form_editView_prosedur', [AdminController::class, 'form_editView_prosedur']);
    Route::post('/edit_prosedur', [AdminController::class, 'edit_prosedur']);
});

// ─────────────────────────────────────────────────────────────────────────────
// Area Super Admin (SuperAdminController)
// ─────────────────────────────────────────────────────────────────────────────
Route::middleware(['auth:web', 'super_admin'])->prefix('super-admin')->name('super_admin.')->group(function () {
    // Dashboard
    Route::get('/', [SuperAdminController::class, 'index'])->name('dashboard');

    // Manajemen User Admin
    Route::get('/view_admin', [SuperAdminController::class, 'view_admin'])->name('view_admin');
    Route::get('/list_admin', [SuperAdminController::class, 'list_admin'])->name('list_admin');
    Route::post('/getModalAddAdmin', [SuperAdminController::class, 'getModalAddAdmin'])->name('getModalAddAdmin');
    Route::post('/add_admin', [SuperAdminController::class, 'add_admin'])->name('add_admin');
    Route::post('/delete_admin', [SuperAdminController::class, 'delete_admin'])->name('delete_admin');
    Route::post('/toggle_status_admin', [SuperAdminController::class, 'toggle_status_admin'])->name('toggle_status_admin');

    // Manajemen Pemohon
    Route::get('/view_pemohon', [SuperAdminController::class, 'view_pemohon'])->name('view_pemohon');
    Route::get('/list_pemohon', [SuperAdminController::class, 'list_pemohon'])->name('list_pemohon');
    Route::post('/toggle_status_pemohon', [SuperAdminController::class, 'toggle_status_pemohon'])->name('toggle_status_pemohon');

    // Manajemen Akses Menu — Admin
    Route::post('/getModalAksesAdmin', [SuperAdminController::class, 'getModalAksesAdmin'])->name('getModalAksesAdmin');
    Route::post('/save_akses_admin', [SuperAdminController::class, 'save_akses_admin'])->name('save_akses_admin');

    // Manajemen Akses Menu — Pemohon
    Route::post('/getModalAksesPemohon', [SuperAdminController::class, 'getModalAksesPemohon'])->name('getModalAksesPemohon');
    Route::post('/save_akses_pemohon', [SuperAdminController::class, 'save_akses_pemohon'])->name('save_akses_pemohon');
});
