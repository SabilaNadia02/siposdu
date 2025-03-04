<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PemberianVaksin extends Model
{
    protected $fillable = [
        'no_pendaftaran',
        'id_vaksin',
        'waktu_pemberian',
        'dosis',
        'keterangan',
    ];

    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class);
    }
    public function vaksin(): BelongsTo
    {
        return $this->belongsTo(DataVaksin::class);
    }
}
