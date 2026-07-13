<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    protected $table = 'kontak';
    protected $fillable = [
        'alamat',
        'alamat_produksi',
        'telp',
        'fax',
        'email',
        'fb',
        'google',
        'twitter',
        'instagram',
    ];
}
