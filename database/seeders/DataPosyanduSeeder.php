<?php

namespace Database\Seeders;

use App\Models\DataPosyandu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataPosyanduSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Posyandu Anggrek',
                'alamat' => 'Dusun Brenjuk, Desa Jambean, Kecamatan Kras, Kabupaten Kediri',
            ],
            [
                'nama' => 'Posyandu Kenanga',
                'alamat' => 'Dusun Ngrombeh, Desa Jambean, Kecamatan Kras, Kabupaten Kediri',
            ],
            [
                'nama' => 'Posyandu Matahari',
                'alamat' => 'Dusun Jambean, Desa Jambean, Kecamatan Kras, Kabupaten Kediri',
            ],
            [
                'nama' => 'Posyandu Mawar',
                'alamat' => 'Dusun Pucung, Desa Jambean, Kecamatan Kras, Kabupaten Kediri',
            ],
            [
                'nama' => 'Posyandu Melati',
                'alamat' => 'Dusun Jambean, Desa Jambean, Kecamatan Kras, Kabupaten Kediri',
            ],
        ];

        foreach ($data as $item) {
            DataPosyandu::create($item);
        }
    }
}
