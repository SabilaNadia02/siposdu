<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class DataPengguna extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nama',
        'email',
        'password',
        'role', // 1 = admin, 2 = bidan_perawat, 3 = kader
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => 'integer',
    ];
}
