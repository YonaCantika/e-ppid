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

}
