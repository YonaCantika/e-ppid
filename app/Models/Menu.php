<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $fillable = [
        'judul',
        'judul_en',
        'slug',
        'id_menu',
        'urut',
        'sub_menu',
        'status',
        'static',
        'link',
        'status_link',
    ];
}
