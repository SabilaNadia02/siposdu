<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PemberianObat extends Model
{
    protected $table = 'pemberian_obats';

    public $timestamps = false;

    protected $fillable = [
        'no_pendaftaran',
        'waktu_pemberian',
        'data',
        'keterangan',
    ];

    protected $casts = [
        'waktu_pemberian' => 'date',
        'data' => 'array', 
    ];    

    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class, 'no_pendaftaran');
    }
    public function obat(): BelongsTo
    {
        return $this->belongsTo(DataObat::class);
    }
}
