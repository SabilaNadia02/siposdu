<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PertanyaanSkriningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua id dari data_skrinings dan data_pertanyaans
        $skriningIds = DB::table('data_skrinings')->pluck('id');
        $pertanyaanIds = DB::table('data_pertanyaans')->pluck('id');

        // Inisialisasi array untuk data yang akan diinsert
        $data = [];

        // Loop untuk mengisi tabel dengan pasangan id_skrining dan id_pertanyaan
        foreach ($skriningIds as $skriningId) {
            foreach ($pertanyaanIds as $pertanyaanId) {
                $data[] = [
                    'id_skrining' => $skriningId,
                    'id_pertanyaan' => $pertanyaanId,
                ];
            }
        }

        // Insert data ke dalam tabel pertanyaan_skrinings
        DB::table('pertanyaan_skrinings')->insert($data);
    }
}
