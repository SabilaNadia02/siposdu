<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('data_obats')->insert([
            [
                'nama' => 'Paracetamol',
                'keterangan' => 'Digunakan untuk mengurangi demam dan nyeri ringan hingga sedang.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Amoxicillin',
                'keterangan' => 'Antibiotik yang digunakan untuk mengobati berbagai infeksi bakteri.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Ibuprofen',
                'keterangan' => 'Obat antiinflamasi nonsteroid untuk mengurangi nyeri dan peradangan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Cetirizine',
                'keterangan' => 'Antihistamin yang digunakan untuk meredakan alergi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Ranitidine',
                'keterangan' => 'Digunakan untuk mengurangi produksi asam lambung.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
