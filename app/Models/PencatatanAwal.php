<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PencatatanAwal extends Model
{
    protected $fillable = [
        'no_pendaftaran',
        'hpht',
        'htp',
        'nama_suami',
        'hamil_ke',
        'jarak_anak',
        'tinggi_badan',
        'usia_kehamilan',
        'nama_ibu',
        'nama_ayah',
        'berat_badan_lahir',
        'panjang_badan_lahir',
        'status_balita',
        'riwayat_keluarga',
        'riwayat_diri_sendiri',
        'perilaku_berisiko',
    ];

    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class, 'no_pendaftaran');
    }
    public function pencatatanKunjungan(): HasMany
    {
        return $this->hasMany(PencatatanKunjungan::class, 'id_pencatatan_awal');
    }
}
