<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PencatatanAwal extends Model
{
    protected $fillable = [
        'no_pendaftaran',
        'jenis_sasaran',
        'nama_posyandu',
        'waktu_pencatatan',
    ];

    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class);
    }
    public function posyandu(): BelongsTo
    {
        return $this->belongsTo(DataPosyandu::class);
    }
    public function detailPencatatanAwal(): HasMany
    {
        return $this->hasMany(DetailPencatatanAwal::class);
    }
    public function pencatatanKunjungan(): HasMany
    {
        return $this->hasMany(PencatatanKunjungan::class);
    }
}
