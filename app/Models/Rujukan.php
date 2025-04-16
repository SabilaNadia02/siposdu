<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rujukan extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'no_pendaftaran',
        'jenis_rujukan',
        'waktu_rujukan',
        'keterangan',
    ];

    protected $casts = [
        'waktu_rujukan' => 'datetime',
    ];    

    public const JENIS_RUJUKAN = [
        1 => 'Pustu',
        2 => 'Puskesmas',
        3 => 'Rumah Sakit'
    ];

    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class, 'no_pendaftaran');
    }

    public function getJenisRujukanTextAttribute()
    {
        return self::JENIS_RUJUKAN[$this->jenis_rujukan] ?? 'Tidak Diketahui';
    }
}
