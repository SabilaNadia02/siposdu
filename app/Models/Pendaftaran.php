<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'nama',
        'jenis_kelamin',
        'status_perkawinan',
        'tempat_lahir',
        'tanggal_lahir',
        'pendidikan',
        'pekerjaan',
        'alamat',
        'no_hp',
        'no_jkn',
    ];

    public function pencatatanAwal(): HasMany
    {
        return $this->hasMany(PencatatanAwal::class);
    }
    public function pencatatanSkrining(): HasMany
    {
        return $this->hasMany(PencatatanSkrining::class);
    }
    public function pemberianImunisasi(): HasMany
    {
        return $this->hasMany(PemberianImunisasi::class);
    }
    public function pemberianVitamin(): HasMany
    {
        return $this->hasMany(PemberianVitamin::class);
    }
    public function pemberianObat(): HasMany
    {
        return $this->hasMany(PemberianObat::class);
    }
    public function pemberianVaksin(): HasMany
    {
        return $this->hasMany(PemberianVaksin::class);
    }
    public function rujukan(): HasMany
    {
        return $this->hasMany(Rujukan::class);
    }
}
