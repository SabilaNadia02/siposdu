<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PencatatanAwal;

class PencatatanAwalSeeder extends Seeder
{
    public function run()
    {
        PencatatanAwal::insert([
            [
                'no_pendaftaran'   => 1,
                'jenis_sasaran'    => 1,
                'nama_posyandu'    => 1,
                'waktu_pencatatan' => now(),
            ],
            [
                'no_pendaftaran'   => 2,
                'jenis_sasaran'    => 2,
                'nama_posyandu'    => 2,
                'waktu_pencatatan' => now(),
            ],
            [
                'no_pendaftaran'   => 3,
                'jenis_sasaran'    => 3,
                'nama_posyandu'    => 3,
                'waktu_pencatatan' => now(),
            ],
            [
                'no_pendaftaran'   => 4,
                'jenis_sasaran'    => 1,
                'nama_posyandu'    => 4,
                'waktu_pencatatan' => now(),
            ],
            [
                'no_pendaftaran'   => 5,
                'jenis_sasaran'    => 2,
                'nama_posyandu'    => 5,
                'waktu_pencatatan' => now(),
            ],
        ]);
    }
}
