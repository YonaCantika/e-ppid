<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regulasi extends Model
{
    protected $table = 'regulasi';
    protected $primaryKey = 'regulasi_id';
    protected $fillable = [
        'aturan',
        'keterangan',
        'tipe_file',
        'file',
        'status',
    ];
}
