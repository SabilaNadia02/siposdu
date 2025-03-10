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
        'berat_badan',
        'panjang_badan',
        'tinggi_badan',
        'lingkar_lengan',
        'lingkar_kepala',
        'lingkar_perut',
        'mt_bumil_kek',
        'kelas_ibu_hamil',
        'asi_eksklusif',
        'mp_asi',
        'mt_pangan_pemulihan',
        'tes_mata_kanan',
        'tes_mata_kiri',
        'tes_telinga_kanan',
        'tes_telinga_kiri',
        'tekanan_darah_sistolik',
        'tekanan_darah_diastolik',
        'catatan_kesehatan',
        'gula_darah',
        'kolestrol',
        'keluhan',
        'edukasi',
    ];

    public function pencatatanAwal(): BelongsTo
    {
        return $this->belongsTo(PencatatanAwal::class, 'id_pencatatan_awal');
    }
}
