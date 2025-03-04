<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PencatatanSkrining extends Model
{
    protected $fillable = [
        'id_skrining',
        'no_pendaftaran',
        'waktu_skrining',
    ];

    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class);
    }
    public function dataSkrining(): BelongsTo
    {
        return $this->belongsTo(DataSkrining::class);
    }
    public function detailPencatatanSkrining(): HasMany
    {
        return $this->hasMany(DetailPencatatanSkrining::class);
    }
}
