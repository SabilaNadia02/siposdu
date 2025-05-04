<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PencatatanKunjungan extends Model
{
    protected $fillable = [
        // Semua Jenis Sasaran
        'id_pencatatan_awal',
        'waktu_pencatatan',
        'berat_badan',
        'keluhan',
        'edukasi',
        'created_at',
        'updated_at',

        // Ibu Hamil - Usia Produktif dan Lansia
        'tekanan_darah_sistolik',
        'tekanan_darah_diastolik',

        // Ibu Hamil
        'lingkar_lengan',
        'mt_bumil_kek',
        'kelas_ibu_hamil',

        // Balita
        'panjang_badan',
        'tinggi_badan',
        'lingkar_kepala',
        'asi_eksklusif',
        'mp_asi',
        'mt_pangan_pemulihan',
        'catatan_kesehatan',

        // Usia Produktif dan Lansia
        'lingkar_perut',
        'tes_mata_kanan',
        'tes_mata_kiri',
        'tes_telinga_kanan',
        'tes_telinga_kiri',
        'gula_darah',
        'kolestrol',
    ];

    protected $casts = [
        'waktu_pencatatan' => 'date',
    ];

    public function pencatatanAwal(): BelongsTo
    {
        return $this->belongsTo(PencatatanAwal::class, 'id_pencatatan_awal');
    }

    // Jika perlu akses langsung ke Pendaftaran
    public function pendaftaran()
    {
        return $this->hasOneThrough(
            Pendaftaran::class,
            PencatatanAwal::class,
            'id', // Foreign key on PencatatanAwal table
            'id', // Foreign key on Pendaftaran table
            'id_pencatatan_awal', // Local key on PencatatanKunjungan table
            'no_pendaftaran' // Local key on PencatatanAwal table
        );
    }
}
