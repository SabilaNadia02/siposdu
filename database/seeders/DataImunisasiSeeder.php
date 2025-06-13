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
            ['nama' => 'Hepatitis B', 'dari_umur' => 0, 'sampai_umur' => 0, 'keterangan' => 'Mencegah hepatitis B'],
            ['nama' => 'BCG', 'dari_umur' => 0, 'sampai_umur' => 24, 'keterangan' => 'Mencegah penyakit tuberkulosis'],
            ['nama' => 'Polio Tetes 1', 'dari_umur' => 0, 'sampai_umur' => 24, 'keterangan' => 'Mencegah penyakit polio'],
            ['nama' => 'DPT-HB-Hib 1', 'dari_umur' => 2, 'sampai_umur' => 24, 'keterangan' => 'Mencegah difteri, pertusis, tetanus, hepatitis B, dan Hib'],
            ['nama' => 'Polio Tetes 2', 'dari_umur' => 2, 'sampai_umur' => 24, 'keterangan' => 'Mencegah penyakit polio'],
            ['nama' => 'Rotavirus (RV)1*', 'dari_umur' => 2, 'sampai_umur' => 24, 'keterangan' => 'Mencegah infeksi rotavirus'],
            ['nama' => 'PCV 1', 'dari_umur' => 2, 'sampai_umur' => 24, 'keterangan' => 'Mencegah pneumonia dan meningitis'],
            ['nama' => 'DPT-HB-Hib 2', 'dari_umur' => 3, 'sampai_umur' => 24, 'keterangan' => 'Mencegah difteri, pertusis, tetanus, hepatitis B, dan Hib'],
            ['nama' => 'Polio Tetes 3', 'dari_umur' => 3, 'sampai_umur' => 24, 'keterangan' => 'Mencegah penyakit polio'],
            ['nama' => 'Rotavirus (RV)2*', 'dari_umur' => 3, 'sampai_umur' => 24, 'keterangan' => 'Mencegah infeksi rotavirus'],
            ['nama' => 'PCV 2', 'dari_umur' => 3, 'sampai_umur' => 24, 'keterangan' => 'Mencegah pneumonia dan meningitis'],
            ['nama' => 'DPT-HB-Hib 3', 'dari_umur' => 4, 'sampai_umur' => 24, 'keterangan' => 'Mencegah difteri, pertusis, tetanus, hepatitis B, dan Hib'],
            ['nama' => 'Polio Tetes 4', 'dari_umur' => 4, 'sampai_umur' => 24, 'keterangan' => 'Mencegah penyakit polio'],
            ['nama' => 'Polio Suntik (IPV) 1', 'dari_umur' => 4, 'sampai_umur' => 24, 'keterangan' => 'Mencegah penyakit polio'],
            ['nama' => 'Rotavirus (RV)3*', 'dari_umur' => 4, 'sampai_umur' => 24, 'keterangan' => 'Mencegah infeksi rotavirus'],
            ['nama' => 'Campak Rubella (MR)', 'dari_umur' => 9, 'sampai_umur' => 24, 'keterangan' => 'Mencegah campak dan rubella'],
            ['nama' => 'Polio Suntik (IPV) 2*', 'dari_umur' => 9, 'sampai_umur' => 24, 'keterangan' => 'Mencegah penyakit polio'],
            ['nama' => 'Japanese Encephalitis (JE)', 'dari_umur' => 12, 'sampai_umur' => 24, 'keterangan' => 'Mencegah ensefalitis Jepang'],
            ['nama' => 'PCV 3', 'dari_umur' => 12, 'sampai_umur' => 24, 'keterangan' => 'Mencegah pneumonia dan meningitis'],
            ['nama' => 'DPT-HB-Hib Lanjutan', 'dari_umur' => 18, 'sampai_umur' => 24, 'keterangan' => 'Dosis lanjutan untuk DPT-HB-Hib'],
            ['nama' => 'Campak-Rubella (MR) Lanjutan', 'dari_umur' => 18, 'sampai_umur' => 24, 'keterangan' => 'Dosis lanjutan untuk campak dan rubella'],
        ];

        foreach ($data as $item) {
            DataImunisasi::create($item);
        }
    }
}
