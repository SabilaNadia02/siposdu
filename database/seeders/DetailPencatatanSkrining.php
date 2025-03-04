<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailPencatatanSkrining extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('detail_pencatatan_skrinings')->insert([
            [
                'id_pencatatan_skrining' => 1,
                'id_pertanyaan_skrining' => 1,
                'hasil_skrining' => 1,
            ],
            [
                'id_pencatatan_skrining' => 1,
                'id_pertanyaan_skrining' => 2,
                'hasil_skrining' => 2,
            ],
            [
                'id_pencatatan_skrining' => 2,
                'id_pertanyaan_skrining' => 3,
                'hasil_skrining' => 1,
            ],
            [
                'id_pencatatan_skrining' => 2,
                'id_pertanyaan_skrining' => 4,
                'hasil_skrining' => 2,
            ],
            [
                'id_pencatatan_skrining' => 3,
                'id_pertanyaan_skrining' => 5,
                'hasil_skrining' => 1,
            ],
        ]);
    }
}
