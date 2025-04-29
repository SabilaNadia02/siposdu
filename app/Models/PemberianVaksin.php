<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PemberianVaksin extends Model
{
    protected $table = 'pemberian_vaksins';

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
    public function vaksin(): BelongsTo
    {
        return $this->belongsTo(DataVaksin::class);
    }
}
