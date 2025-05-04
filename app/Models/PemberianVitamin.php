<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PemberianVitamin extends Model
{
    protected $table = 'pemberian_vitamins';

    public $timestamps = false;

    protected $fillable = [
        'no_pendaftaran',
        'waktu_pemberian',
        'data', // Menyimpan array JSON berisi multiple vitamin
        'keterangan',
    ];

    protected $casts = [
        'data' => 'array',
        'waktu_pemberian' => 'datetime'
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'no_pendaftaran');
    }

    // Accessor untuk memudahkan akses
    public function getVitaminListAttribute()
    {
        return collect($this->data)->map(function ($item) {
            return [
                'id_vitamin' => $item['id_vitamin'],
                'dosis' => $item['dosis'] ?? null
            ];
        });
    }
}
