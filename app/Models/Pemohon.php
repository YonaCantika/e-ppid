<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pemohon extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pemohon';
    protected $primaryKey = 'id_pemohon';

    protected $fillable = [
        'id_jenis',
        'id_identitas',
        'nomor_identitas',
        'nama',
        'npwp',
        'pekerjaan',
        'alamat',
        'notelp',
        'nofax',
        'email',
        'password',
        'ktp',
        'akta',
        'status',
        'kode_unik',
        'lastLogin'
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'lastLogin' => 'datetime',
        ];
    }
}
