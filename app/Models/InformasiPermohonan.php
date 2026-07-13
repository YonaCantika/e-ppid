<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiPermohonan extends Model
{
    protected $table = 'informasi_permohonan';
    protected $fillable = [
        'id_pemohon',
        'tipe_permohonan',
        'tipe_lainnya',
        'isi_permohonan',
        'status',
        'upload_file',
        'text_file',
        'id_admin',
    ];
}
