<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pendaftaran extends Model
{
    use HasFactory;

    const PEKERJAAN_TIDAK_BEKERJA = 1;
    const PEKERJAAN_PNS = 2;
    const PEKERJAAN_TNI_POLRI = 3;
    const PEKERJAAN_SWASTA = 4;
    const PEKERJAAN_WIRAUSAHA = 5;
    const PEKERJAAN_PETANI = 6;
    const PEKERJAAN_LAINNYA = 7;

    public static $pekerjaanOptions = [
        self::PEKERJAAN_TIDAK_BEKERJA => 'Tidak Bekerja',
        self::PEKERJAAN_PNS => 'PNS',
        self::PEKERJAAN_TNI_POLRI => 'TNI/Polri',
        self::PEKERJAAN_SWASTA => 'Swasta',
        self::PEKERJAAN_WIRAUSAHA => 'Wirausaha',
        self::PEKERJAAN_PETANI => 'Petani',
        self::PEKERJAAN_LAINNYA => 'Lainnya',
    ];

    protected $table = 'pendaftarans';
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
        'jenis_sasaran',
        'data_posyandu_id',
    ];

    public function getPekerjaanTextAttribute()
    {
        return self::$pekerjaanOptions[$this->pekerjaan] ?? 'Tidak Diketahui';
    }

    public function PencatatanAwal(): HasMany
    {
        return $this->hasMany(PencatatanAwal::class, 'no_pendaftaran', 'id');
    }
    public function posyandus(): BelongsTo
    {
        return $this->belongsTo(DataPosyandu::class, 'data_posyandu_id');
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
