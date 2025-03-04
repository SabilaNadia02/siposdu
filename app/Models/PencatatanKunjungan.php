<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PencatatanKunjungan extends Model
{
    protected $fillable = [
        'id_pencatatan_awal',
        'waktu_kunjungan',
    ];

    public function pencatatanAwal(): BelongsTo
    {
        return $this->belongsTo(PencatatanAwal::class);
    }
}
