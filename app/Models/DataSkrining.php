<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DataSkrining extends Model
{
    protected $fillable = [
        'nama',
        'keterangan',
    ];

    public function pertanyaanSkrining(): HasMany
    {
        return $this->hasMany(PertanyaanSkrining::class);
    }
    public function pencatatanSkrining(): HasMany
    {
        return $this->hasMany(PencatatanSkrining::class);
    }
}
