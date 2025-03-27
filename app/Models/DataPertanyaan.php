<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DataPertanyaan extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'nama_pertanyaan',
    ];

    public function pertanyaanSkrining(): HasMany
    {
        return $this->hasMany(PertanyaanSkrining::class);
    }
}
