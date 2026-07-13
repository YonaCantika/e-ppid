<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Menampilkan halaman Dasbor Admin (My Task).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.template_admin.gabungan', [
            'content'      => 'admin.mytask.index_mytask',
            'judul_header' => 'MY TASK'
        ]);
    }

    /**
     * Menampilkan halaman antarmuka grid DataTables untuk Daftar Permohonan.
     *
     * @return \Illuminate\View\View
     */
    public function view_permohonan()
    {
        return view('admin.template_admin.gabungan', [
            'content'      => 'admin.permohonan.index_permohonan',
            'judul_header' => 'DAFTAR PERMOHONAN',
        ]);
    }

    /**
     * Menampilkan halaman antarmuka grid DataTables untuk Daftar Akun Pemohon.
     *
     * @return \Illuminate\View\View
     */
    public function view_pemohon()
    {
        return view('admin.template_admin.gabungan', [
            'content'      => 'admin.list_pemohon.index_akun',
            'judul_header' => 'DAFTAR PEMOHON',
        ]);
    }

    /**
     * Mengambil dan memformat data permohonan ke bentuk JSON untuk Server-Side Processing DataTables.
     * Melakukan filter berdasarkan tahun (periode) dan status permohonan.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listdatapemohon(Request $request)
    {
        $status = $request->input('status');
        $periode = $request->input('periode');
        
        $query = DB::table('informasi_permohonan as a')
            ->select('a.*', 'b.nama', 'b.email')
            ->join('pemohon as b', 'a.id_pemohon', '=', 'b.id_pemohon')
            ->whereYear('a.created_at', $periode);

        if ($status) {
            $query->where('a.status', $status);
        }

        $results = $query->get();

        $data = array();
        $i = 1;
        foreach ($results as $hasil) {
            $row = array();
            if ($hasil->tipe_permohonan == 'Lain-Lain') {
                $tipe_permohonan = $hasil->tipe_permohonan . ' : ' . $hasil->tipe_lainnya;
            } else {
                $tipe_permohonan = $hasil->tipe_permohonan;
            }
            $row[] = $i;
            $row[] = $tipe_permohonan;
            $row[] = $hasil->isi_permohonan;
            $row[] = $hasil->nama;
            $row[] = $hasil->email;
            $row[] = $hasil->created_at;
            
            switch ($hasil->status) {
                case 'OPEN':
                    $row[] = 'BELUM DITANGGAPI';
                    break;
                case 'APPROVE':
                    $row[] = 'SUDAH DITANGGAPI';
                    break;
                case 'APPROVE_HALF':
                    $row[] = 'DITANGGAPI SEBAGIAN';
                    break;
                case 'REJECT':
                    $row[] = 'DITOLAK';
                    break;
                default:
                    $row[] = '-';
                    break;
            }

            $row[] = $hasil->id;
            $data[] = $row;
            $i++;
        }
        return response()->json(["data" => $data]);
    }

    /**
     * Mengambil rekapitulasi daftar akun pemohon ke dalam format JSON.
     * Termasuk melakukan kalkulasi agregat (GROUP BY) untuk menghitung total pengajuan per akun.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listakunpemohon(Request $request)
    {
        $periode = $request->input('periode');

        $query = DB::table('pemohon as a')
            ->select(
                'a.*',
                DB::raw('COUNT(b.id) as total_pengajuan'),
                DB::raw("COUNT(CASE WHEN b.status = 'OPEN' THEN 0 END) AS blm_ditanggapi"),
                DB::raw("COUNT(CASE WHEN b.status != 'OPEN' THEN 0 END) AS sdh_ditanggapi")
            )
            ->leftJoin('informasi_permohonan as b', 'a.id_pemohon', '=', 'b.id_pemohon');

        if ($periode != '') {
            $query->whereYear('a.created_at', $periode);
        }

        $results = $query->groupBy(
            'a.id_pemohon', 'a.id_jenis', 'a.id_identitas', 'a.nomor_identitas', 'a.nama',
            'a.npwp', 'a.email', 'a.pekerjaan', 'a.alamat', 'a.notelp', 'a.nofax',
            'a.password', 'a.ktp', 'a.akta', 'a.status', 'a.kode_unik', 'a.lastLogin', 'a.created_at', 'a.updated_at'
        )->get();

        $data = array();
        $i = 1;
        foreach ($results as $hasil) {
            $row = array();
            $row[] = $i;
            $row[] = $hasil->nama;
            $row[] = $hasil->email;
            $row[] = $hasil->notelp;
            $row[] = $hasil->pekerjaan;
            $row[] = $hasil->alamat;
            $row[] = $hasil->nofax;
            $row[] = $hasil->total_pengajuan;
            $row[] = $hasil->blm_ditanggapi;
            $row[] = $hasil->sdh_ditanggapi;

            $row[] = $hasil->id_pemohon;
            $data[] = $row;
            $i++;
        }
        return response()->json(["data" => $data]);
    }

    public function form_editView_permohonan(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');
        $header = $request->input('header');

        $data_permohonan = DB::table('informasi_permohonan')->where('id', $id)->first();

        return view('admin.permohonan.modal_editView_permohonan', [
            'data_permohonan' => $data_permohonan,
            'status'          => $status,
            'header'          => $header,
        ]);
    }

    public function chart_donat_status()
    {
        $all_data = array();
        $query_x = DB::table('informasi_permohonan')
            ->select(DB::raw('count(id) as jumlah'), 'status')
            ->groupBy('status')
            ->get();

        foreach ($query_x as $x) {
            switch ($x->status) {
                case 'OPEN':
                    $st = 'BELUM DITANGGAPI';
                    break;
                case 'APPROVE':
                    $st = 'SUDAH DITANGGAPI';
                    break;
                case 'APPROVE_HALF':
                    $st = 'DITANGGAPI SEBAGIAN';
                    break;
                case 'REJECT':
                    $st = 'DITOLAK';
                    break;
                default:
                    $st = '-';
                    break;
            }
            $arr1 = array();
            $arr1['y'] = $x->jumlah * 1;
            $arr1['name'] = $st . " : " . $x->jumlah;
            array_push($all_data, $arr1);
        }

        return response()->json($all_data, 200, [], JSON_NUMERIC_CHECK);
    }

    public function chart_pie_tipe()
    {
        $all_data = array();
        $query_x = DB::table('informasi_permohonan')
            ->select(DB::raw('count(id) as jumlah'), 'tipe_permohonan')
            ->groupBy('tipe_permohonan')
            ->get();

        foreach ($query_x as $x) {
            $arr1 = array();
            $arr1['y'] = $x->jumlah * 1;
            $arr1['name'] = $x->tipe_permohonan . " : " . $x->jumlah;
            array_push($all_data, $arr1);
        }

        return response()->json($all_data, 200, [], JSON_NUMERIC_CHECK);
    }

    public function tanggapan(Request $request)
    {
        $isi_tanggapan = $request->input('isi_tanggapan');
        $id = $request->input('id_informasi_permohonan');
        $id_admin = Auth::guard('web')->id();
        $status = $request->input('status');

        if ($request->hasFile('files')) {
            $file = $request->file('files');
            if ($file->getSize() > 5999999) {
                return response()->json(['status' => false, 'msg' => 'File Melebihi 10Mb atau tipe File tidak sesuai']);
            }

            $new_name = "Tanggapan-" . $id . "-" . $id_admin . "-" . date("YmdHis") . "." . $file->getClientOriginalExtension();
            // Pindahkan file ke public/file agar path lama CI3 tetap jalan (./file/)
            $file->move(public_path('file'), $new_name);

            DB::table('informasi_permohonan')->where('id', $id)->update([
                'upload_file' => $new_name
            ]);
        }

        $data = [
            'text_file'    => $isi_tanggapan,
            'updated_at'   => now(),
            'id_admin'     => $id_admin,
            'status'       => $status
        ];

        $affected = DB::table('informasi_permohonan')->where('id', $id)->update($data);

        if ($affected) {
            // Notifikasi WA / API WhatsApp dimatikan sementara untuk testing
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false, 'msg' => 'gagal simpan']);
        }
    }

    public function view_menu()
    {
        return view('admin.template_admin.gabungan', [
            'content'      => 'admin.settings.menu.index_menu',
            'judul_header' => 'DAFTAR MENU',
        ]);
    }

    public function menu_menu($id)
    {
        $query = DB::table('menu')->where('id', $id)->first();
        if (!$query) abort(404);

        switch ($id) {
            case '1':
                $content = 'admin.settings.profil.index_profil';
                break;
            case '2':
                $content = 'admin.settings.regulasi.index_regulasi';
                break;
            case '3':
                $content = 'admin.settings.maklumat.index_maklumat';
                break;
            case '7':
            case '9':
                $content = 'admin.settings.informasi_publik.index_informasi';
                break;
            case '11':
            case '12':
                $content = 'admin.settings.prosedur.index_prosedur';
                break;
            default:
                $content = '';
                break;
        }

        return view('admin.template_admin.gabungan', [
            'id'           => $id,
            'content'      => $content,
            'judul_header' => $query->judul,
        ]);
    }

    public function listmenu()
    {
        $results = DB::select("SELECT b.id, menu.judul as parent, b.judul as nama, b.urut, b.status_link 
                               FROM menu 
                               JOIN (SELECT * FROM menu) as b ON menu.id = b.id_menu");

        $data = [];
        $i = 1;
        foreach ($results as $hasil) {
            $row = [];
            $row[] = $i;
            $row[] = $hasil->nama;
            $row[] = $hasil->parent;
            $row[] = $hasil->urut;
            if ($hasil->status_link == 'unactive') {
                $row[] = '<p style="color:red">' . $hasil->status_link . '<p>';
            } else {
                $row[] = $hasil->status_link;
            }
            $row[] = $hasil->id;
            $data[] = $row;
            $i++;
        }
        return response()->json(["data" => $data]);
    }

    public function getModalAddMenu()
    {
        $list_parent = DB::table('menu')->where('status_link', 'active')->where('sub_menu', 0)->get();
        return view('admin.settings.menu.modal_addmenu', ['list_parent' => $list_parent]);
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
        
        $data_menu = DB::selectOne("SELECT b.*, a.judul as parent 
                                    FROM menu a 
                                    JOIN (SELECT * FROM menu) b ON a.id = b.id_menu 
                                    WHERE b.id = ?", [$id]);

        $list_parent = DB::table('menu')->where('status_link', 'active')->where('sub_menu', 0)->get();

        return view('admin.settings.menu.modal_editmenu', [
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
        return view('admin.settings.informasi_publik.modal_addinformasi', [
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

        return view('admin.settings.informasi_publik.modal_editinformasi', [
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
        return view('admin.settings.regulasi.modal_addregulasi', [
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

        return view('admin.settings.regulasi.modal_editregulasi', [
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

        return view('admin.settings.maklumat.modal_editmaklumat', [
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

        return view('admin.settings.profil.modal_editprofil', [
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

        return view('admin.settings.prosedur.modal_editprosedur', [
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
