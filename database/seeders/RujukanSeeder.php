<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class RujukanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::table('rujukans')->insert([
                [
                    'no_pendaftaran' => 1,
                    'jenis_rujukan' => 1,
                    'waktu_rujukan' => Carbon::now()->subDays(10),
                    'keterangan' => 'Rujukan ke Puskesmas',
                ],
                [
                    'no_pendaftaran' => 2,
                    'jenis_rujukan' => 2,
                    'waktu_rujukan' => Carbon::now()->subDays(8),
                    'keterangan' => 'Rujukan ke Rumah Sakit',
                ],
                [
                    'no_pendaftaran' => 3,
                    'jenis_rujukan' => 1,
                    'waktu_rujukan' => Carbon::now()->subDays(6),
                    'keterangan' => 'Rujukan ulang ke Puskesmas',
                ],
                [
                    'no_pendaftaran' => 4,
                    'jenis_rujukan' => 3,
                    'waktu_rujukan' => Carbon::now()->subDays(4),
                    'keterangan' => 'Rujukan ke Spesialis',
                ],
                [
                    'no_pendaftaran' => 5,
                    'jenis_rujukan' => 2,
                    'waktu_rujukan' => Carbon::now()->subDays(2),
                    'keterangan' => 'Rujukan ulang ke Rumah Sakit',
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('Seeder gagal: ' . $e->getMessage());
        }
    }
}
