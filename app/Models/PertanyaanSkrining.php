<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PertanyaanSkrining extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'id_skrining',
        'id_pertanyaan',
    ];

    public function dataSkrining(): BelongsTo
    {
        return $this->belongsTo(DataSkrining::class, 'id_skrining');
    }
    public function dataPertanyaan(): BelongsTo
    {
        return $this->belongsTo(DataPertanyaan::class, 'id_pertanyaan');
    }
    public function detailPencatatanSkrining(): HasMany
    {
        return $this->hasMany(DetailPencatatanSkrining::class);
    }
}
