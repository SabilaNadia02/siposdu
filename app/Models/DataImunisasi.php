<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataImunisasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'dari_umur',
        'sampai_umur',
        'keterangan',
    ];
}
