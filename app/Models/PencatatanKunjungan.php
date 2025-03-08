<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PencatatanKunjungan extends Model
{
    protected $fillable = [
        'id_pencatatan_awal',
        'waktu_kunjungan',
    ];

    public function pencatatanAwal(): BelongsTo
    {
        return $this->belongsTo(PencatatanAwal::class, 'id_pencatatan_awal');
    }
    public function detailPencatatanKunjungan(): HasMany
    {
        return $this->hasMany(DetailPencatatanKunjungan::class, 'id_pencatatan_kunjungan');
    }
}
