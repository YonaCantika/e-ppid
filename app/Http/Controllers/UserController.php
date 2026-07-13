<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Menampilkan halaman dasbor / My Task untuk pemohon.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('user.template_user.gabungan', [
            'judul_header' => 'My Task',
            'content' => 'user.mytask.index_mytask' // Asumsi ada view ini
        ]);
    }

    /**
     * Menampilkan halaman daftar permohonan milik pengguna (pemohon) saat ini.
     *
     * @return \Illuminate\View\View
     */
    public function view_permohonan()
    {
        return view('user.template_user.gabungan', [
            'judul_header' => 'Create Permohonan',
            'content' => 'user.permohonan.index_permohonan'
        ]);
    }

    /**
     * Menyediakan data JSON untuk dirender oleh jQuery DataTables di halaman daftar permohonan pemohon.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function listdatapemohon()
    {
        $id_pemohon = Auth::guard('pemohon')->id();
        $query = DB::select("SELECT * from informasi_permohonan WHERE id_pemohon = ?", [$id_pemohon]);

        $data = array();
        $i=1;
        foreach ($query as $hasil) {
            $row = array();
            if ($hasil->tipe_permohonan == 'Lain-Lain') {
                $tipe_permohonan = $hasil->tipe_permohonan.' : '.$hasil->tipe_lainnya;
            } else{
                $tipe_permohonan = $hasil->tipe_permohonan;
            }
            $row[] = $i;
            $row[] = $tipe_permohonan;
            $row[] = $hasil->isi_permohonan;
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
     * Memuat tampilan modal HTML untuk form tambah permohonan baru via AJAX.
     *
     * @return \Illuminate\View\View
     */
    public function getModalAddPermohonan()
    {
        return view('user.permohonan.modal_add_permohonan');
    }

    /**
     * Menghapus data permohonan dari database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete_permohonan(Request $request)
    {
        $id = $request->input('id');
        $deleted = DB::table('informasi_permohonan')->where('id', $id)->delete();
        if ($deleted) {
            return response()->json(['status' => true]);   
        } else {
            return response()->json(['status' => false]);
        }
    }

    /**
     * Memasukkan data pengajuan permohonan baru dari pemohon ke database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add_permohonan(Request $request)
    {
        $data = [
            'id_pemohon'      => Auth::guard('pemohon')->id(),
            'tipe_permohonan' => $request->input('tipe_permohonan'),
            'tipe_lainnya'    => $request->input('lain-lain'),
            'isi_permohonan'  => $request->input('isi_permohonan'),
            'created_at'      => now(),
            'status'          => 'OPEN'
        ];
        
        $inserted = DB::table('informasi_permohonan')->insert($data);
        if ($inserted) {
            return response()->json(['status' => true]);   
        } else {
            return response()->json(['status' => false, 'msg' => 'gagal simpan']);
        }
    }

    /**
     * Memuat form HTML untuk melihat detail atau mengedit permohonan melalui AJAX (Modal).
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function form_editView_permohonan(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');
        $header = $request->input('header');
        
        $data_permohonan = DB::table('informasi_permohonan')->where('id', $id)->first();
        
        return view('user.permohonan.modal_editView_permohonan', [
            'data_permohonan' => $data_permohonan,
            'status'          => $status,
            'header'          => $header,
        ]);
    }

    /**
     * Memperbarui data pengajuan permohonan (jika belum ditanggapi secara final).
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit_permohonan(Request $request)
    {
        $id = $request->input('id_informasi_permohonan');
        $data = [
            'tipe_permohonan' => $request->input('tipe_permohonan'),
            'tipe_lainnya'    => $request->input('lain-lain'),
            'isi_permohonan'  => $request->input('isi_permohonan'),
            'created_at'      => now(),
            'status'          => 'OPEN'
        ];
        
        $updated = DB::table('informasi_permohonan')->where('id', $id)->update($data);
        if ($updated) {
            return response()->json(['status' => true]);   
        } else {
            return response()->json(['status' => false, 'msg' => 'gagal simpan']);
        }
    }
}
