<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DataVaksin extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'keterangan',
    ];

    public function pemberianVaksin(): HasMany
    {
        return $this->hasMany(PemberianVaksin::class);
    }
}
