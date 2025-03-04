<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPencatatanAwal extends Model
{
    protected $fillable = [
        'id_pencatatan_awal',
        'hpht',
        'htp',
        'nama_suami',
        'hamil_ke',
        'jarak_anak',
        'tinggi_badan',
        'nama_ibu',
        'nama_ayah',
        'berat_badan_lahir',
        'panjang_badan_lahir',
        'status_balita',
        'riwayat_keluarga',
        'riwayat_diri_sendiri',
        'perilaku_berisiko',
    ];

    public function pencatatanAwal(): BelongsTo
    {
        return $this->belongsTo(PencatatanAwal::class, 'id_pencatatan_awal');
    }
}
