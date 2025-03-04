<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataVitaminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('data_vitamins')->insert([
            [
                'nama' => 'Vitamin A',
                'keterangan' => 'Membantu menjaga kesehatan mata dan sistem kekebalan tubuh.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Vitamin B1',
                'keterangan' => 'Membantu metabolisme energi dan fungsi saraf.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Vitamin B6',
                'keterangan' => 'Mendukung metabolisme protein dan produksi neurotransmitter.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Vitamin C',
                'keterangan' => 'Berperan sebagai antioksidan dan meningkatkan daya tahan tubuh.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Vitamin D',
                'keterangan' => 'Membantu penyerapan kalsium dan kesehatan tulang.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
