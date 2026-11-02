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
    // -------------------------------------------------------------
    // MANAJEMEN MENU WEBSITE
    // -------------------------------------------------------------
    public function view_menu()
    {
        return view('super_admin.template.gabungan', [
            'content'      => 'super_admin.menu.index_menu',
            'judul_header' => 'DAFTAR MENU',
        ]);
    }

    public function menu_menu($id)
    {
        $query = DB::table('menu')->where('id', $id)->first();
        if (!$query) abort(404);

        // Cek berdasarkan link terlebih dahulu agar dinamis, fallback ke ID lama jika tidak cocok
        $content = '';
        switch ($query->link) {
            case 'profil':
                $content = 'super_admin.settings.profil.index_profil';
                break;
            case 'regulasi':
                $content = 'super_admin.settings.regulasi.index_regulasi';
                break;
            case 'maklumat':
                $content = 'super_admin.settings.maklumat.index_maklumat';
                break;
            case 'informasi/7':
            case 'informasi/9':
                $content = 'super_admin.settings.informasi_publik.index_informasi';
                break;
            case 'layanan':
            case 'keberatan':
                $content = 'super_admin.settings.prosedur.index_prosedur';
                break;
        }

        // Fallback untuk legacy ID
        if ($content == '') {
            switch ($id) {
                case '1':
                    $content = 'super_admin.settings.profil.index_profil';
                    break;
                case '2':
                    $content = 'super_admin.settings.regulasi.index_regulasi';
                    break;
                case '3':
                    $content = 'super_admin.settings.maklumat.index_maklumat';
                    break;
                case '7':
                case '9':
                    $content = 'super_admin.settings.informasi_publik.index_informasi';
                    break;
                case '11':
                case '12':
                    $content = 'super_admin.settings.prosedur.index_prosedur';
                    break;
                default:
                    $content = '';
                    break;
            }
        }

        return view('super_admin.template.gabungan', [
            'id'           => $id,
            'content'      => $content,
            'judul_header' => $query->judul,
        ]);
    }

    public function listmenu()
    {
        $results = DB::table('menu as b')
            ->select('b.id', 'p.judul as parent', 'b.judul as nama', 'b.urut', 'b.status_link', 'b.sub_menu', 'b.link')
            ->leftJoin('menu as p', 'b.id_menu', '=', 'p.id')
            ->orderBy('b.id', 'asc')
            ->get();

        $data = [];
        $i = 1;
        foreach ($results as $hasil) {
            $row = [];
            $row[] = $i;
            $row[] = $hasil->nama;
            
            // Jika sub_menu = 0, berarti dia parent utama
            if ($hasil->sub_menu == 0) {
                $row[] = '<span class="badge badge-primary">Menu Utama</span>';
            } else {
                $row[] = $hasil->parent ?? '-';
            }

            $row[] = $hasil->urut;
            if ($hasil->status_link == 'unactive') {
                $row[] = '<p style="color:red">' . $hasil->status_link . '<p>';
            } else {
                $row[] = $hasil->status_link;
            }
            $row[] = $hasil->id;
            $row[] = $hasil->link; // Pass link at index 6
            $data[] = $row;
            $i++;
        }
        return response()->json(["data" => $data]);
    }

    public function getModalAddMenu()
    {
        $list_parent = DB::table('menu')->where('status_link', 'active')->where('sub_menu', 0)->get();
        return view('super_admin.menu.modal_addmenu', ['list_parent' => $list_parent]);
    }

    public function generate_link(Request $request)
    {
        $value = $request->input('id');
        $parent = $request->input('parent');
        $menu = $request->input('menu');
        $html = "";

        if ($parent == '') {
            $text1 = str_replace(' ', '-', strtolower($menu));
        } else {
            $nama_parent = DB::table('menu')->where('id', $parent)->first();
            $text = str_replace(' ', '-', strtolower($nama_parent->judul));
            $hitung = DB::table('menu')->where('id_menu', $parent)->count();
        }

        if ($value == 'static') {
            $html .= "static";
        } else {
            if ($parent == '') {
                $html .= $text1;
            } else {
                $html .= $text . "/" . $hitung;
            }
        }

        return response($html);
    }

    public function form_editView_menu(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');
        $header = $request->input('header');
        
        $data_menu = DB::table('menu as b')
            ->select('b.*', 'a.judul as parent')
            ->leftJoin('menu as a', 'b.id_menu', '=', 'a.id')
            ->where('b.id', $id)
            ->first();

        $list_parent = DB::table('menu')->where('status_link', 'active')->where('sub_menu', 0)->get();

        return view('super_admin.menu.modal_editmenu', [
            'data_menu'   => $data_menu,
            'list_parent' => $list_parent,
            'status'      => $status,
            'header'      => $header,
        ]);
    }

    public function save_editmenu(Request $request)
    {
        $id = $request->input('id_menu');
        $menu = $request->input('menu');
        $menu_en = $request->input('menu_en');
        $sbg = $request->input('sbg');
        $parent = $request->input('parent');
        $urut = $request->input('urutan');
        $link = $request->input('link');
        $status = $request->input('status');

        if ($sbg == 'Parent') {
            $data = [
                'judul'       => $menu,
                'judul_en'    => $menu_en,
                'link'        => $link,
                'urut'        => $urut,
                'status_link' => $status
            ];
        } elseif ($sbg == 'Child') {
            $data = [
                'judul'       => $menu,
                'judul_en'    => $menu_en,
                'id_menu'     => $parent,
                'urut'        => $urut,
                'status_link' => $status
            ];
        }

        $affected = DB::table('menu')->where('id', $id)->update($data);

        if ($affected) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false, 'msg' => 'gagal simpan']);
        }
    }

    public function add_menu(Request $request)
    {
        $menu = $request->input('menu');
        $menu_en = $request->input('menu_en');
        $id_menu = $request->input('parent');
        $urut = $request->input('urutan');
        $link = $request->input('link');
        $sbg = $request->input('sbg');

        if ($sbg == 'parent') {
            $data = [
                'judul'       => $menu,
                'judul_en'    => $menu_en,
                'urut'        => $urut,
                'sub_menu'    => 0,
                'status'      => 1,
                'static'      => 1,
                'link'        => $link,
                'status_link' => 'active'
            ];
        } else {
            $data = [
                'judul'       => $menu,
                'judul_en'    => $menu_en,
                'urut'        => $urut,
                'sub_menu'    => 1,
                'status'      => 1,
                'static'      => 1,
                'link'        => $link,
                'status_link' => 'active'
            ];
        }

        $id = DB::table('menu')->insertGetId($data);

        if ($id) {
            if ($id_menu == '') {
                DB::table('menu')->where('id', $id)->update(['id_menu' => $id]);
            } else {
                DB::table('menu')->where('id', $id)->update(['id_menu' => $id_menu]);
            }
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false, 'msg' => 'gagal simpan']);
        }
    }

    public function delete_menu(Request $request)
    {
        $id = $request->input('id');
        
        // Cek apakah punya sub_menu jika dia parent
        $cek_child = DB::table('menu')->where('id_menu', $id)->where('id', '!=', $id)->count();
        if ($cek_child > 0) {
            return response()->json(['status' => false, 'msg' => 'Tidak dapat menghapus Parent Menu karena masih memiliki Sub Menu.']);
        }

        $affected = DB::table('menu')->where('id', $id)->delete();

        if ($affected) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false, 'msg' => 'Gagal menghapus menu.']);
        }
    }
    // ===========================================================================
    // MANAJEMEN KONTEN MENU SETTINGS
    // ===========================================================================
    public function list_informasi_publik(Request $request)
    {
        $id = $request->input('id');
        $results = DB::table('informasi as a')
            ->select('a.*', 'b.nama_kategori', 'c.judul as jdl_menu')
            ->join('kategori as b', 'a.kategori_id', '=', 'b.kategori_id')
            ->join('menu as c', 'a.menu_id', '=', 'c.id')
            ->where('a.menu_id', $id)
            ->get();

        $data = [];
        $i = 1;
        foreach ($results as $hasil) {
            $row = [];
            $row[] = $i;
            $row[] = $hasil->judul;
            $row[] = $hasil->nama_kategori;
            $row[] = $hasil->jdl_menu;
            if ($hasil->tipe == 0) {
                $row[] = '<p style="color:red">Download<p>';
            } else {
                $row[] = '<p style="color:red">View<p>';
            }
            $row[] = $hasil->link;
            if ($hasil->status == 0) {
                $row[] = '<p style="color:green">Aktif<p>';
            } else {
                $row[] = '<p style="color:red">Tidak Aktif<p>';
            }
            $row[] = $hasil->informasi_id;
            $data[] = $row;
            $i++;
        }
        return response()->json(["data" => $data]);
    }

    public function getModalAddMenu_informasi(Request $request)
    {
        $kategori = DB::table('kategori')->where('status', 0)->orderBy('urutan', 'ASC')->get();
        return view('super_admin.settings.informasi_publik.modal_addinformasi', [
            'kategori' => $kategori,
            'id'       => $request->input('id')
        ]);
    }

    public function add_informasi_publik(Request $request)
    {
        $judul    = $request->input('judul');
        $menu_id  = $request->input('id');
        $kategori = $request->input('kategori');
        $tipe     = $request->input('tipe');
        $link     = $request->input('link');
        $id_admin = Auth::guard('web')->id();

        $data = [
            'kategori_id' => $kategori,
            'menu_id'     => $menu_id,
            'judul'       => $judul,
            'tipe'        => $tipe,
            'status'      => 0,
            'datetime'    => now(),
        ];

        $id = DB::table('informasi')->insertGetId($data);

        if ($tipe == 0) {
            if ($request->hasFile('files')) {
                $file = $request->file('files');
                if ($file->getSize() > 5999999) {
                    return response()->json(['status' => false, 'msg' => 'File Melebihi 10Mb atau tipe File tidak sesuai']);
                }

                $new_name = "Informasi-" . $id . "-" . $id_admin . "-" . date("YmdHis") . "." . $file->getClientOriginalExtension();
                $file->move(public_path('upload/Informasi'), $new_name);

                DB::table('informasi')->where('informasi_id', $id)->update(['link' => $new_name]);
            }
        } else {
            DB::table('informasi')->where('informasi_id', $id)->update(['link' => $link]);
        }

        return response()->json(['status' => true]);
    }

    public function form_editView_informasi(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');
        $header = $request->input('header');

        $data_informasi = DB::table('informasi as a')
            ->select('a.*', 'b.nama_kategori', 'c.judul as menu')
            ->join('kategori as b', 'a.kategori_id', '=', 'b.kategori_id')
            ->join('menu as c', 'a.menu_id', '=', 'c.id')
            ->where('a.informasi_id', $id)
            ->first();

        $file_html = '-';
        if ($status == 'edit' && $data_informasi) {
            $file_html = '<tr>
                <td><a href="' . url('/upload/Informasi/' . $data_informasi->link) . '" style="color:black" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> "' . $data_informasi->link . '"</a><br></td>
                <td style="width: 85px">
                    <input type="hidden" name="id_file[]" value="' . $data_informasi->informasi_id . '"><button onclick="delete_file(this)" type="button" title="Hapus" class="btn btn-danger btn-xs"><i class="fa fa-eraser"></i></button>  		
                </td>
            </tr>';
        }

        $kategori = DB::table('kategori')->where('status', 0)->orderBy('urutan', 'ASC')->get();

        return view('super_admin.settings.informasi_publik.modal_editinformasi', [
            'data_informasi' => $data_informasi,
            'list_kategori'  => $kategori,
            'list_file'      => $file_html,
            'status'         => $status,
            'header'         => $header,
        ]);
    }

    public function save_editinformasi(Request $request)
    {
        $id = $request->input('id_informasi');
        $judul = $request->input('judul');
        $kategori = $request->input('kategori');
        $tipe = $request->input('tipe');
        $link = $request->input('link');
        $status = $request->input('status');
        $id_admin = Auth::guard('web')->id();

        $informasi = DB::table('informasi')->where('informasi_id', $id)->first();

        if ($tipe == 1) {
            $data = [
                'kategori_id' => $kategori,
                'judul'       => $judul,
                'tipe'        => $tipe,
                'link'        => $link,
                'status'      => $status,
                'datetime'    => now()
            ];
        } else {
            if ($request->hasFile('files')) {
                $file = $request->file('files');
                if ($file->getSize() > 5999999) {
                    return response()->json(['status' => false, 'msg' => 'File Melebihi 10Mb atau tipe File tidak sesuai']);
                }

                if ($informasi && file_exists(public_path('upload/Informasi/' . $informasi->link))) {
                    @unlink(public_path('upload/Informasi/' . $informasi->link));
                }

                $new_name = "Informasi-" . $id . "-" . $id_admin . "-" . date("YmdHis") . "." . $file->getClientOriginalExtension();
                $file->move(public_path('upload/Informasi'), $new_name);

                DB::table('informasi')->where('informasi_id', $id)->update(['link' => $new_name]);
            }

            $data = [
                'kategori_id' => $kategori,
                'judul'       => $judul,
                'tipe'        => $tipe,
                'status'      => $status,
                'datetime'    => now()
            ];
        }

        $affected = DB::table('informasi')->where('informasi_id', $id)->update($data);

        if ($affected) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false, 'msg' => 'gagal simpan']);
        }
    }

    public function list_regulasi()
    {
        $query = DB::table('regulasi')->get();
        $data = [];
        $i = 1;
        foreach ($query as $hasil) {
            $row = [];
            $row[] = $i;
            $row[] = $hasil->aturan;
            $row[] = $hasil->file;
            if ($hasil->status == 0) {
                $row[] = '<p style="color:green">Aktif<p>';
            } else {
                $row[] = '<p style="color:red">Tidak Aktif<p>';
            }
            $row[] = $hasil->regulasi_id;
            $data[] = $row;
            $i++;
        }
        return response()->json(["data" => $data]);
    }

    public function getModalAddMenu_regulasi(Request $request)
    {
        return view('super_admin.settings.regulasi.modal_addregulasi', [
            'id' => $request->input('id')
        ]);
    }

    public function add_regulasi(Request $request)
    {
        $aturan = $request->input('aturan');
        $id_admin = Auth::guard('web')->id();

        $data = [
            'aturan'   => $aturan,
            'status'   => 0,
            'datetime' => now(),
        ];

        $id = DB::table('regulasi')->insertGetId($data);

        if ($request->hasFile('files')) {
            $file = $request->file('files');
            if ($file->getSize() > 5999999) {
                return response()->json(['status' => false, 'msg' => 'File Melebihi 10Mb atau tipe File tidak sesuai']);
            }

            $new_name = "Regulasi-" . $id . "-" . $id_admin . "-" . date("YmdHis") . "." . $file->getClientOriginalExtension();
            $file->move(public_path('upload/Regulasi'), $new_name);

            DB::table('regulasi')->where('regulasi_id', $id)->update(['file' => $new_name]);
        }

        return response()->json(['status' => true]);
    }

    public function form_editView_regulasi(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');
        $header = $request->input('header');

        $data_regulasi = DB::table('regulasi')->where('regulasi_id', $id)->first();

        $file_html = '-';
        if ($status == 'edit' && $data_regulasi) {
            $file_html = '<tr>
                <td><a href="' . url('/upload/Regulasi/' . $data_regulasi->file) . '" style="color:black" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> "' . $data_regulasi->file . '"</a><br></td>
                <td style="width: 85px">
                    <input type="hidden" name="id_file[]" value="' . $data_regulasi->regulasi_id . '"><button onclick="delete_file_reg(this)" type="button" title="Hapus" class="btn btn-danger btn-xs"><i class="fa fa-eraser"></i></button>  		
                </td>
            </tr>';
        }

        return view('super_admin.settings.regulasi.modal_editregulasi', [
            'data_regulasi' => $data_regulasi,
            'list_file'     => $file_html,
            'status'        => $status,
            'header'        => $header,
        ]);
    }

    public function edit_regulasi(Request $request)
    {
        $id = $request->input('id_reg');
        $aturan = $request->input('aturan');
        $status = $request->input('status');
        $id_admin = Auth::guard('web')->id();

        $regulasi = DB::table('regulasi')->where('regulasi_id', $id)->first();

        if ($request->hasFile('files')) {
            $file = $request->file('files');
            if ($file->getSize() > 5999999) {
                return response()->json(['status' => false, 'msg' => 'File Melebihi 10Mb atau tipe File tidak sesuai']);
            }

            if ($regulasi && file_exists(public_path('upload/Regulasi/' . $regulasi->file))) {
                @unlink(public_path('upload/Regulasi/' . $regulasi->file));
            }

            $new_name = "Regulasi-" . $id . "-" . $id_admin . "-" . date("YmdHis") . "." . $file->getClientOriginalExtension();
            $file->move(public_path('upload/Regulasi'), $new_name);

            DB::table('regulasi')->where('regulasi_id', $id)->update(['file' => $new_name]);
        }

        $data = [
            'aturan'   => $aturan,
            'status'   => $status,
            'datetime' => now()
        ];

        DB::table('regulasi')->where('regulasi_id', $id)->update($data);

        return response()->json(['status' => true]);
    }

    public function list_maklumat()
    {
        $query = DB::table('maklumat')->get();
        $data = [];
        foreach ($query as $hasil) {
            $row = [];
            $row[] = $hasil->judul;
            $row[] = $hasil->deskripsi;
            $row[] = $hasil->datetime;
            $row[] = $hasil->id;
            $data[] = $row;
        }
        return response()->json(["data" => $data]);
    }

    public function form_editView_maklumat(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');
        $header = $request->input('header');

        $data_maklumat = DB::table('maklumat')->where('id', $id)->first();

        return view('super_admin.settings.maklumat.modal_editmaklumat', [
            'data_maklumat' => $data_maklumat,
            'status'        => $status,
            'header'        => $header,
        ]);
    }

    public function edit_maklumat(Request $request)
    {
        $id = $request->input('id');
        $text = $request->input('summernote');
        $judul = $request->input('judul');
        $id_admin = Auth::guard('web')->id();

        $data = [
            'judul'     => $judul,
            'deskripsi' => $text,
            'user'      => $id_admin,
            'datetime'  => now()
        ];

        DB::table('maklumat')->where('id', $id)->update($data);

        return response()->json(['status' => true]);
    }

    public function list_profil()
    {
        $query = DB::table('profil')->get();
        $data = [];
        foreach ($query as $hasil) {
            $row = [];
            $row[] = $hasil->judul;
            $row[] = '<a href="' . url('/upload/' . $hasil->file) . '" style="color:black" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> ' . $hasil->file . '</a>';
            $row[] = $hasil->datetime;
            $row[] = $hasil->id;
            $data[] = $row;
        }
        return response()->json(["data" => $data]);
    }

    public function form_editView_profil(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');
        $header = $request->input('header');

        $data_profil = DB::table('profil')->where('id', $id)->first();

        $file_html = '-';
        if ($status == 'edit' && $data_profil) {
            $file_html = '<tr>
                <td><a href="' . url('/upload/' . $data_profil->file) . '" style="color:black" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> ' . $data_profil->file . '</a><br></td>
                <td style="width: 85px">
                    <input type="hidden" name="id_file[]" value="' . $data_profil->id . '"><button onclick="delete_file_profil(this)" type="button" title="Hapus" class="btn btn-danger btn-xs"><i class="fa fa-eraser"></i></button>  		
                </td>
            </tr>';
        }

        return view('super_admin.settings.profil.modal_editprofil', [
            'data_profil' => $data_profil,
            'list_file'   => $file_html,
            'status'      => $status,
            'header'      => $header,
        ]);
    }

    public function edit_profil(Request $request)
    {
        $id = $request->input('id');
        $judul = $request->input('judul');
        $id_admin = Auth::guard('web')->id();

        $profil = DB::table('profil')->where('id', $id)->first();

        if ($request->hasFile('files')) {
            $file = $request->file('files');
            if ($file->getSize() > 5999999) {
                return response()->json(['status' => false, 'msg' => 'File Melebihi 10Mb atau tipe File tidak sesuai']);
            }

            if ($profil && file_exists(public_path('upload/' . $profil->file))) {
                @unlink(public_path('upload/' . $profil->file));
            }

            $new_name = "Profil-" . $id . "-" . $id_admin . "-" . date("YmdHis") . "." . $file->getClientOriginalExtension();
            $file->move(public_path('upload'), $new_name);

            DB::table('profil')->where('id', $id)->update(['file' => $new_name]);
        }

        $data = [
            'judul'    => $judul,
            'datetime' => now()
        ];

        DB::table('profil')->where('id', $id)->update($data);

        return response()->json(['status' => true]);
    }

    public function list_prosedur(Request $request)
    {
        $id = $request->input('id');
        $results = DB::table('prosedur as a')
            ->select('a.*', 'c.judul as jdl_menu')
            ->join('menu as c', 'a.menu_id', '=', 'c.id')
            ->where('a.menu_id', $id)
            ->get();

        $data = [];
        $i = 1;
        foreach ($results as $hasil) {
            $row = [];
            $row[] = $i;
            $row[] = $hasil->judul;
            $row[] = '<img src="' . url('/upload/' . $hasil->file) . '" style="height:100px;width:100px;">';
            if ($hasil->status == 0) {
                $row[] = '<p style="color:green">Aktif<p>';
            } else {
                $row[] = '<p style="color:red">Tidak Aktif<p>';
            }
            $row[] = $hasil->id;
            $data[] = $row;
            $i++;
        }
        return response()->json(["data" => $data]);
    }

    public function form_editView_prosedur(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');
        $header = $request->input('header');

        $data_prosedur = DB::table('prosedur')->where('id', $id)->first();

        $file_html = '-';
        if ($status == 'edit' && $data_prosedur) {
            $file_html = '<tr>
                <td><center><img src="' . url('/upload/' . $data_prosedur->file) . '" style="height:100px;width:100px;"></center><br></td>
                <td style="width: 85px">
                    <input type="hidden" name="id_file[]" value="' . $data_prosedur->id . '"><center><button onclick="delete_file_prosedur(this)" type="button" title="Hapus" class="btn btn-danger btn-xs"><i class="fa fa-eraser"></i></button></center>  		
                </td>
            </tr>';
        }

        return view('super_admin.settings.prosedur.modal_editprosedur', [
            'data_prosedur' => $data_prosedur,
            'list_file'     => $file_html,
            'status'        => $status,
            'header'        => $header,
        ]);
    }

    public function edit_prosedur(Request $request)
    {
        $id = $request->input('id');
        $judul = $request->input('judul');
        $status = $request->input('status');
        $id_admin = Auth::guard('web')->id();

        $prosedur = DB::table('prosedur')->where('id', $id)->first();

        if ($request->hasFile('files')) {
            $file = $request->file('files');
            if ($file->getSize() > 5999999) {
                return response()->json(['status' => false, 'msg' => 'File Melebihi 10Mb atau tipe File tidak sesuai']);
            }

            if ($prosedur && file_exists(public_path('upload/' . $prosedur->file))) {
                @unlink(public_path('upload/' . $prosedur->file));
            }

            $new_name = "Prosedur-" . $id . "-" . $id_admin . "-" . date("YmdHis") . "." . $file->getClientOriginalExtension();
            $file->move(public_path('upload'), $new_name);

            DB::table('prosedur')->where('id', $id)->update(['file' => $new_name]);
        }

        $data = [
            'judul'    => $judul,
            'status'   => $status,
            'datetime' => now()
        ];

        DB::table('prosedur')->where('id', $id)->update($data);

        return response()->json(['status' => true]);
    }
}
