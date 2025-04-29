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
    public function vitamin(): BelongsTo
    {
        return $this->belongsTo(DataVitamin::class, 'id_vitamin');
    }
}
