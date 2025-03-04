<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DataObat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'keterangan',
    ];

    public function pemberianObat(): HasMany
    {
        return $this->hasMany(PemberianObat::class);
    }
}
