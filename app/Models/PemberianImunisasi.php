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

    protected $dates = ['waktu_pemberian'];

    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class, 'no_pendaftaran');
    }

    public function imunisasi(): BelongsTo
    {
        return $this->belongsTo(DataImunisasi::class, 'id_imunisasi');
    }
}
