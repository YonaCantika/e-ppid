<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMenuPermission extends Model
{
    protected $table    = 'user_menu_permissions';
    protected $fillable = ['user_id', 'user_type', 'menu_key'];
}
