<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DataPosyandu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'alamat',
    ];

    public function pencatatanAwal(): HasMany
    {
        return $this->hasMany(PencatatanAwal::class);
    }
}
