<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPencatatanSkrining extends Model
{
    protected $fillable = [
        'id_pencatatan_skrining',
        'id_pertanyaan_skrining',
        'hasil_skrining',
    ];

    public function pencatatanSkrining(): BelongsTo
    {
        return $this->belongsTo(PencatatanSkrining::class);
    }
    public function pertanyaanSkrining(): BelongsTo
    {
        return $this->belongsTo(PertanyaanSkrining::class);
    }
}
