<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataVaksinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('data_vaksins')->insert([
            [
                'nama' => 'BCG',
                'keterangan' => 'Melindungi dari tuberkulosis.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'DPT',
                'keterangan' => 'Mencegah difteri, pertusis, dan tetanus.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Polio',
                'keterangan' => 'Melindungi dari virus polio.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Hepatitis B',
                'keterangan' => 'Mencegah infeksi virus hepatitis B.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Campak',
                'keterangan' => 'Melindungi dari penyakit campak.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
