<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    protected $table = 'informasi';
    protected $primaryKey = 'informasi_id';
    protected $fillable = [
        'kategori_id',
        'menu_id',
        'judul',
        'tipe',
        'link',
        'status',
    ];
}
