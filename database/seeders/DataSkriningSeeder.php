<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataSkriningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('data_skrinings')->insert([
            ['nama_skrining' => 'Skrining TBC', 'keterangan' => 'Menilai risiko dan gejala TBC pada balita'],
            ['nama_skrining' => 'Skrining PPOK', 'keterangan' => 'Menilai kemungkinan Penyakit Paru Obstruktif Kronis (PPOK)'],
        ]);
    }
}
