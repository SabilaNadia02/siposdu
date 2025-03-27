<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DataSkrining extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'nama_skrining',
        'keterangan',
    ];

    public function pertanyaanSkrining(): HasMany
    {
        return $this->hasMany(PertanyaanSkrining::class, 'id_pertanyaan');
    }
    public function pencatatanSkrining(): HasMany
    {
        return $this->hasMany(PencatatanSkrining::class, 'id_skrining');
    }
}
