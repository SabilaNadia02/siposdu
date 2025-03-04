<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PemberianImunisasi extends Model
{
    protected $fillable = [
        'no_pendaftaran',
        'id_imunisasi',
        'waktu_pemberian',
        'keterangan',
    ];

    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class);
    }
    public function imunisasi(): BelongsTo
    {
        return $this->belongsTo(DataImunisasi::class);
    }
}
