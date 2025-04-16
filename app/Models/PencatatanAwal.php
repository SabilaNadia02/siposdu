<?php

// app/Models/PencatatanAwal.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PencatatanAwal extends Model
{
    const STATUS_BALITA = 1;
    const STATUS_LULUS = 2;
    
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

    protected $casts = [
        'riwayat_keluarga' => 'array',
        'riwayat_diri_sendiri' => 'array',
        'perilaku_berisiko' => 'array',
    ];

    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class, 'no_pendaftaran', 'id');
    }
    
    public function pencatatanKunjungan(): HasMany
    {
        return $this->hasMany(PencatatanKunjungan::class, 'id_pencatatan_awal');
    }
    
    // Scope untuk balita aktif
    public function scopeAktif($query)
    {
        return $query->where('status_balita', self::STATUS_BALITA);
    }
    
    // Scope untuk balita lulus
    public function scopeLulus($query)
    {
        return $query->where('status_balita', self::STATUS_LULUS);
    }
    
    // Check if balita is eligible for graduation
    public function isEligibleForGraduation()
    {
        if (!$this->pendaftaran || !$this->pendaftaran->tanggal_lahir) {
            return false;
        }
        
        $birthDate = new \DateTime($this->pendaftaran->tanggal_lahir);
        $now = new \DateTime();
        $interval = $now->diff($birthDate);
        
        return $interval->y >= 5;
    }
    
    // Get age string
    public function getAgeString()
    {
        if (!$this->pendaftaran || !$this->pendaftaran->tanggal_lahir) {
            return 'Tanggal lahir tidak tersedia';
        }
        
        $birthDate = new \DateTime($this->pendaftaran->tanggal_lahir);
        $now = new \DateTime();
        $interval = $now->diff($birthDate);
        
        return $interval->y . ' Tahun ' . $interval->m . ' Bulan ' . $interval->d . ' Hari';
    }
}
