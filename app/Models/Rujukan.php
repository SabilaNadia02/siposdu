<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rujukan extends Model
{
    protected $fillable = [
        'no_pendaftaran',
        'jenis_rujukan',
        'waktu_rujukan',
        'keterangan',
    ];

    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class);
    }
}
