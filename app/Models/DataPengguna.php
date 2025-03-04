<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPengguna extends Model
{
    protected $fillable = [
        'nama',
        'email',
        'peran',
    ];
}
