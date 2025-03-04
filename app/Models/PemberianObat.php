<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PemberianObat extends Model
{
    protected $fillable = [
        'no_pendaftaran',
        'id_obat',
        'waktu_pemberian',
        'dosis',
        'keterangan',
    ];

    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class);
    }
    public function obat(): BelongsTo
    {
        return $this->belongsTo(DataObat::class);
    }
}
