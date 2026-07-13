<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TbApiWa extends Model
{
    protected $table = 'tb_api_wa';
    protected $fillable = [
        'api_wa',
        'link',
    ];
}
