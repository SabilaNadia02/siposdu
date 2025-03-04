<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DataPenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::table('data_penggunas')->insert([
                [
                    'nama' => 'Admin Posyandu',
                    'email' => 'admin@posyandu.com',
                    'peran' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'nama' => 'Bidan Dewi',
                    'email' => 'bidan.dewi@posyandu.com',
                    'peran' => 2,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'nama' => 'Kader Siti',
                    'email' => 'kader.siti@posyandu.com',
                    'peran' => 3,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'nama' => 'Kader Budi',
                    'email' => 'kader.budi@posyandu.com',
                    'peran' => 3,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'nama' => 'Bidan Rina',
                    'email' => 'bidan.rina@posyandu.com',
                    'peran' => 2,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('Seeder gagal: ' . $e->getMessage());
        }
    }
}
