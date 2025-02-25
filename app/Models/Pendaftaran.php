<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        /**
         * @param jenis_kelamin This parameter shows the jenis_kelamin of the pendaftar/peserta posyandu
         *          1 -> laki-laki
         *          2 -> perempuan
         *
         * @param status_perkawinan This parameter shows the status_perkawinan of the pendaftar/peserta posyandu
         *          1 -> tidak menikah
         *          2 -> menikah
         *
         * @param pendidikan This parameter shows the pendidikan of the pendaftar/peserta posyandu
         *          1 -> tidak sekolah
         *          2 -> sd
         *          3 -> smp
         *          4 -> smu
         *          5 -> akademi
         *          6 -> perguruan tinggi
         */

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
}
