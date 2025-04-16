<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PemberianVitamin extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'no_pendaftaran',
        'id_vitamin',
        'waktu_pemberian',
        'dosis',
        'keterangan',
    ];

    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class, 'no_pendaftaran');
    }
    public function vitamin(): BelongsTo
    {
        return $this->belongsTo(DataVitamin::class, 'id_vitamin');
    }
}
