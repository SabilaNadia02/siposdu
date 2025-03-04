<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataPertanyaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('data_pertanyaans')->insert([
            // Pertanyaan untuk Skrining TBC
            ['nama_pertanyaan' => 'Apakah Anda mengalami batuk terus-menerus selama lebih dari dua minggu?'],
            ['nama_pertanyaan' => 'Apakah Anda mengalami demam lebih dari 2 minggu?'],
            ['nama_pertanyaan' => 'Apakah berat badan Anda naik atau turun dalam 2 bulan berturut-turut?'],
            ['nama_pertanyaan' => 'Apakah ada riwayat kontak erat dengan pasien TBC?'],
            
            // Pertanyaan untuk Skrining PPOK
            ['nama_pertanyaan' => 'Jenis Kelamin'],
            ['nama_pertanyaan' => 'Usia'],
            ['nama_pertanyaan' => 'Merokok?'],
            ['nama_pertanyaan' => 'Apakah pernah merasa nafas pendek ketika berjalan lebih cepat pada jalan yang datar atau jalan yang sedikit menanjak?'],
            ['nama_pertanyaan' => 'Apakah mempunyai dahak yang berasal dari paru atau kesulitan mengeluarkan dahak pada saat sedang tidak menderita flu?'],
            ['nama_pertanyaan' => 'Apakah biasanya batuk pada saat sedang tidak menderita flu?'],
            ['nama_pertanyaan' => 'Apakah Dokter atau Tenaga Kesehatan lainnya pernah meminta untuk melakukan pemeriksaan spirometri/peakflow meter (meniup ke dalam suatu alat)?'],
        ]);
    }
}
