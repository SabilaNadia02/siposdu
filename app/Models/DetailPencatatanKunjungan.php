<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPencatatanKunjungan extends Model
{
    protected $fillable = [
        'id_pencatatan_kunjungan',
        'berat_badan',
        'panjang_badan',
        'tinggi_badan',
        'lingkar_lengan',
        'lingkar_kepala',
        'lingkar_perut',
        'usia_kehamilan',
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
}
