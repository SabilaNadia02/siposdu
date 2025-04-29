<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DataImunisasi extends Model
{
    use HasFactory;
    // protected $table = 'dt_imunisasi';
    protected $table = 'data_imunisasis';

    protected $fillable = [
        'nama',
        'dari_umur',
        'sampai_umur',
        'keterangan',
    ];

    public function pemberianImunisasi(): HasMany
    {
        return $this->hasMany(PemberianImunisasi::class);
    }
}
