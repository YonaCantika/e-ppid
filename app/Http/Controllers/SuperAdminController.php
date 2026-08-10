<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Helpers\MenuHelper;

class SuperAdminController extends Controller
{
    // ─────────────────────────────────────────────────────────────
    // DASHBOARD
    // ─────────────────────────────────────────────────────────────

    /**
     * Menampilkan halaman dashboard Super Admin.
     */
    public function index()
    {
        $total_admin    = User::where('role', 'admin')->count();
        $admin_aktif    = User::where('role', 'admin')->where('status', 1)->count();
        $admin_nonaktif = User::where('role', 'admin')->where('status', 0)->count();
        $total_pemohon  = DB::table('pemohon')->count();

        return view('super_admin.template.gabungan', [
            'content'       => 'super_admin.dashboard.index_dashboard',
            'judul_header'  => 'DASHBOARD SUPER ADMIN',
            'total_admin'   => $total_admin,
            'admin_aktif'   => $admin_aktif,
            'admin_nonaktif'=> $admin_nonaktif,
            'total_pemohon' => $total_pemohon,
        ]);
    }

    // ─────────────────────────────────────────────────────────────
    // MANAJEMEN USER ADMIN
    // ─────────────────────────────────────────────────────────────

    /**
     * Menampilkan halaman daftar user admin.
     */
    public function view_admin()
    {
        return view('super_admin.template.gabungan', [
            'content'      => 'super_admin.admin.index_admin',
            'judul_header' => 'MANAJEMEN USER ADMIN',
        ]);
    }

    /**
     * Mengambil data daftar admin untuk DataTables (JSON).
     */
    public function list_admin()
    {
        // Ambil semua admin, cek apakah sudah pernah menjawab permohonan
        $admins = User::where('role', 'admin')->get();

        $data = [];
        $i = 1;
        foreach ($admins as $admin) {
            // Cek apakah admin ini sudah pernah menjawab permohonan
            $sudah_jawab = DB::table('informasi_permohonan')
                ->where('id_admin', $admin->id)
                ->whereNotNull('id_admin')
                ->exists();

            $row = [];
            $row[] = $i;
            $row[] = $admin->name;
            $row[] = $admin->email;
            $row[] = $admin->status == 1
                ? '<span class="badge badge-success">Aktif</span>'
                : '<span class="badge badge-danger">Nonaktif</span>';
            $row[] = $sudah_jawab
                ? '<span class="badge badge-warning"><i class="fas fa-check-circle"></i> Pernah Menjawab</span>'
                : '<span class="badge badge-secondary">Belum Menjawab</span>';

            // Kolom aksi: id | sudah_jawab (untuk kontrol tombol di JS)
            $row[] = $admin->id . '|' . ($sudah_jawab ? '1' : '0') . '|' . $admin->status;

            $data[] = $row;
            $i++;
        }

        return response()->json(['data' => $data]);
    }

    /**
     * Menampilkan modal form tambah admin baru.
     */
    public function getModalAddAdmin()
    {
        return view('super_admin.admin.modal_add_admin');
    }

    /**
     * Menyimpan user admin baru ke database.
     */
    public function add_admin(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role'     => 'admin',
            'status'   => 1,
        ]);

        return response()->json(['status' => true, 'msg' => 'User admin berhasil ditambahkan.']);
    }

    /**
     * Menghapus user admin.
     * Tidak bisa dihapus jika sudah pernah menjawab permohonan.
     */
    public function delete_admin(Request $request)
    {
        $id = $request->input('id');

        // Jangan boleh hapus diri sendiri
        if ($id == Auth::guard('web')->id()) {
            return response()->json(['status' => false, 'msg' => 'Tidak dapat menghapus akun sendiri.']);
        }

        $admin = User::where('id', $id)->where('role', 'admin')->first();
        if (!$admin) {
            return response()->json(['status' => false, 'msg' => 'Admin tidak ditemukan.']);
        }

        // Cek apakah sudah pernah menjawab permohonan
        $sudah_jawab = DB::table('informasi_permohonan')
            ->where('id_admin', $id)
            ->whereNotNull('id_admin')
            ->exists();

        if ($sudah_jawab) {
            return response()->json([
                'status' => false,
                'msg'    => 'Admin ini tidak dapat dihapus karena sudah pernah menjawab permohonan.'
            ]);
        }

        $admin->delete();

        return response()->json(['status' => true, 'msg' => 'Admin berhasil dihapus.']);
    }

    /**
     * Mengaktifkan atau menonaktifkan akun admin.
     */
    public function toggle_status_admin(Request $request)
    {
        $id = $request->input('id');

        // Jangan boleh nonaktifkan diri sendiri
        if ($id == Auth::guard('web')->id()) {
            return response()->json(['status' => false, 'msg' => 'Tidak dapat menonaktifkan akun sendiri.']);
        }

        $admin = User::where('id', $id)->where('role', 'admin')->first();
        if (!$admin) {
            return response()->json(['status' => false, 'msg' => 'Admin tidak ditemukan.']);
        }

        $new_status  = $admin->status == 1 ? 0 : 1;
        $admin->status = $new_status;
        $admin->save();

        $label = $new_status == 1 ? 'diaktifkan' : 'dinonaktifkan';

        return response()->json(['status' => true, 'msg' => "Akun admin berhasil {$label}.", 'new_status' => $new_status]);
    }

    // ─────────────────────────────────────────────────────────────
    // MANAJEMEN PEMOHON
    // ─────────────────────────────────────────────────────────────

    /**
     * Menampilkan halaman daftar pemohon untuk toggle status.
     */
    public function view_pemohon()
    {
        return view('super_admin.template.gabungan', [
            'content'      => 'super_admin.pemohon.index_pemohon',
            'judul_header' => 'MANAJEMEN AKUN PEMOHON',
        ]);
    }

    /**
     * Mengambil data daftar pemohon untuk DataTables (JSON).
     */
    public function list_pemohon()
    {
        $results = DB::table('pemohon')->get();

        $data = [];
        $i = 1;
        foreach ($results as $pemohon) {
            $row = [];
            $row[] = $i;
            $row[] = $pemohon->nama;
            $row[] = $pemohon->email;
            $row[] = $pemohon->notelp ?? '-';
            $row[] = $pemohon->pekerjaan ?? '-';
            $row[] = $pemohon->status == 1
                ? '<span class="badge badge-success">Aktif</span>'
                : '<span class="badge badge-danger">Nonaktif</span>';

            // Kirim id_pemohon dan status untuk keperluan JS
            $row[] = $pemohon->id_pemohon . '|' . $pemohon->status;

            $data[] = $row;
            $i++;
        }

        return response()->json(['data' => $data]);
    }

    /**
     * Mengaktifkan atau menonaktifkan akun pemohon.
     */
    public function toggle_status_pemohon(Request $request)
    {
        $id = $request->input('id');

        $pemohon = DB::table('pemohon')->where('id_pemohon', $id)->first();
        if (!$pemohon) {
            return response()->json(['status' => false, 'msg' => 'Pemohon tidak ditemukan.']);
        }

        $new_status = $pemohon->status == 1 ? 0 : 1;
        DB::table('pemohon')->where('id_pemohon', $id)->update(['status' => $new_status]);

        $label = $new_status == 1 ? 'diaktifkan' : 'dinonaktifkan';

        return response()->json(['status' => true, 'msg' => "Akun pemohon berhasil {$label}.", 'new_status' => $new_status]);
    }

    // ─────────────────────────────────────────────────────────────
    // MANAJEMEN AKSES MENU — ADMIN
    // ─────────────────────────────────────────────────────────────

    /**
     * Menampilkan modal pengaturan akses menu untuk user admin tertentu.
     */
    public function getModalAksesAdmin(Request $request)
    {
        $id    = $request->input('id');
        $admin = User::where('id', $id)->where('role', 'admin')->firstOrFail();

        $allMenus    = MenuHelper::adminMenus();
        $blockedList = MenuHelper::getBlockedAdminMenus($id);

        return view('super_admin.admin.modal_akses_menu', [
            'user'        => $admin,
            'user_type'   => 'admin',
            'all_menus'   => $allMenus,
            'blocked_list'=> $blockedList,
        ]);
    }

    /**
     * Menyimpan pengaturan akses menu untuk user admin.
     * $allowed_menus = array of menu_key yang DIIZINKAN (dikirim via checkbox).
     * Yang tidak ada di array → diblokir.
     */
    public function save_akses_admin(Request $request)
    {
        $id            = $request->input('user_id');
        $allowed_menus = $request->input('allowed_menus', []);  // array dari checkbox

        $admin = User::where('id', $id)->where('role', 'admin')->first();
        if (!$admin) {
            return response()->json(['status' => false, 'msg' => 'Admin tidak ditemukan.']);
        }

        // Hitung menu yang DIBLOKIR = semua menu dikurangi yang diizinkan
        $all_keys     = array_keys(MenuHelper::adminMenus());
        $blocked_keys = array_diff($all_keys, $allowed_menus);

        MenuHelper::saveAdminPermissions($id, array_values($blocked_keys));

        return response()->json(['status' => true, 'msg' => "Akses menu admin '{$admin->name}' berhasil diperbarui."]);
    }

    // ─────────────────────────────────────────────────────────────
    // MANAJEMEN AKSES MENU — PEMOHON
    // ─────────────────────────────────────────────────────────────

    /**
     * Menampilkan modal pengaturan akses menu untuk pemohon tertentu.
     */
    public function getModalAksesPemohon(Request $request)
    {
        $id      = $request->input('id');
        $pemohon = DB::table('pemohon')->where('id_pemohon', $id)->first();
        if (!$pemohon) abort(404);

        $allMenus    = MenuHelper::pemohonMenus();
        $blockedList = MenuHelper::getBlockedPemohonMenus($id);

        return view('super_admin.admin.modal_akses_menu', [
            'user'        => $pemohon,
            'user_type'   => 'pemohon',
            'all_menus'   => $allMenus,
            'blocked_list'=> $blockedList,
        ]);
    }

    /**
     * Menyimpan pengaturan akses menu untuk pemohon.
     */
    public function save_akses_pemohon(Request $request)
    {
        $id            = $request->input('user_id');
        $allowed_menus = $request->input('allowed_menus', []);

        $pemohon = DB::table('pemohon')->where('id_pemohon', $id)->first();
        if (!$pemohon) {
            return response()->json(['status' => false, 'msg' => 'Pemohon tidak ditemukan.']);
        }

        $all_keys     = array_keys(MenuHelper::pemohonMenus());
        $blocked_keys = array_diff($all_keys, $allowed_menus);

        MenuHelper::savePemohonPermissions($id, array_values($blocked_keys));

        return response()->json(['status' => true, 'msg' => "Akses menu pemohon '{$pemohon->nama}' berhasil diperbarui."]);
    }
}



