<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PertanyaanSkriningSeeder extends Seeder
{
    /**
     * Jalankan Seeder.
     */
    public function run(): void
    {
        // Data dummy yang ingin dimasukkan secara manual
        $data = [
            ['id_skrining' => 1, 'id_pertanyaan' => 1],
            ['id_skrining' => 1, 'id_pertanyaan' => 2],
            ['id_skrining' => 1, 'id_pertanyaan' => 3],
            ['id_skrining' => 1, 'id_pertanyaan' => 4],
            ['id_skrining' => 2, 'id_pertanyaan' => 5],
            ['id_skrining' => 2, 'id_pertanyaan' => 6],
            ['id_skrining' => 2, 'id_pertanyaan' => 7],
            ['id_skrining' => 2, 'id_pertanyaan' => 8],
            ['id_skrining' => 2, 'id_pertanyaan' => 9],
            ['id_skrining' => 2, 'id_pertanyaan' => 10],
            ['id_skrining' => 2, 'id_pertanyaan' => 11],
        ];

        // Insert data manual ke tabel pertanyaan_skrinings
        DB::table('pertanyaan_skrinings')->insert($data);
    }
}
