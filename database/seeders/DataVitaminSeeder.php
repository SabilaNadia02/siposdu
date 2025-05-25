<?php

namespace Database\Seeders;

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
                'nama' => 'Vitamin A1',
                'keterangan' => 'Membantu kesehatan mata dan sistem kekebalan tubuh balita (pemberian pertama).',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Vitamin A2',
                'keterangan' => 'Menunjang perkembangan penglihatan dan daya tahan tubuh balita (pemberian kedua).',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Vitamin A3',
                'keterangan' => 'Mendukung pertumbuhan sel dan menjaga kesehatan mata balita (pemberian ketiga).',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Vitamin A4',
                'keterangan' => 'Memperkuat imunitas dan mengurangi risiko infeksi pada balita (pemberian keempat).',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Vitamin A5',
                'keterangan' => 'Meningkatkan daya tahan tubuh dan kesehatan kulit balita (pemberian kelima).',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Vitamin A6',
                'keterangan' => 'Mendukung kesehatan jaringan tubuh dan fungsi penglihatan balita (pemberian keenam).',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Vitamin A7',
                'keterangan' => 'Membantu pemulihan dari infeksi dan menjaga kesehatan mata balita (pemberian ketujuh).',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Vitamin A8',
                'keterangan' => 'Menjaga keseimbangan nutrisi penting untuk balita (pemberian kedelapan).',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Vitamin A9',
                'keterangan' => 'Melengkapi kebutuhan vitamin A balita untuk tumbuh kembang optimal (pemberian kesembilan).',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
