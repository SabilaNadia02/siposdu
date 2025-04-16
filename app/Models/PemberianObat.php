<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PemberianObat extends Model
{
    protected $table = 'pemberian_obats';
    protected $fillable = [
        'no_pendaftaran',
        'id_obat',
        'waktu_pemberian',
        'dosis',
        'keterangan',
    ];

    protected $casts = [
        'waktu_pemberian' => 'datetime',
    ];    

    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class, 'no_pendaftaran');
    }

    public function obat(): BelongsTo
    {
        return $this->belongsTo(DataObat::class, 'id_obat');
    }
}
