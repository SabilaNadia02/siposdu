<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PencatatanSkrining extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'id_skrining',
        'no_pendaftaran',
        'waktu_skrining',
    ];

    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class, 'no_pendaftaran', 'id');
    }
    public function dataSkrining(): BelongsTo
    {
        return $this->belongsTo(DataSkrining::class, 'id_skrining');
    }
    public function detailPencatatanSkrining(): HasMany
    {
        return $this->hasMany(DetailPencatatanSkrining::class, 'id_pencatatan_skrining');
    }
}
