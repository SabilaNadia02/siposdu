<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataImunisasi;

class DataImunisasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'BCG',
                'dari_umur' => 0,
                'sampai_umur' => 1,
                'keterangan' => 'Mencegah penyakit tuberkulosis',
            ],
            [
                'nama' => 'Hepatitis B',
                'dari_umur' => 0,
                'sampai_umur' => 1,
                'keterangan' => 'Mencegah hepatitis B',
            ],
            [
                'nama' => 'Polio',
                'dari_umur' => 0,
                'sampai_umur' => 5,
                'keterangan' => 'Mencegah penyakit polio',
            ],
            [
                'nama' => 'DPT-HB-Hib',
                'dari_umur' => 2,
                'sampai_umur' => 24,
                'keterangan' => 'Mencegah difteri, pertusis, tetanus, hepatitis B, dan Hib',
            ],
            [
                'nama' => 'Campak',
                'dari_umur' => 9,
                'sampai_umur' => 15,
                'keterangan' => 'Mencegah penyakit campak',
            ],
        ];

        foreach ($data as $item) {
            DataImunisasi::create($item);
        }
    }
}
