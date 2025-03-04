<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PemberianVitaminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::table('pemberian_vitamins')->insert([
                [
                    'no_pendaftaran' => 1,
                    'id_vitamin' => 1,
                    'waktu_pemberian' => Carbon::now()->subDays(12),
                    'dosis' => '1 ml',
                    'keterangan' => 'Dosis pertama diberikan',
                ],
                [
                    'no_pendaftaran' => 2,
                    'id_vitamin' => 2,
                    'waktu_pemberian' => Carbon::now()->subDays(9),
                    'dosis' => '2 ml',
                    'keterangan' => 'Dosis kedua diberikan',
                ],
                [
                    'no_pendaftaran' => 3,
                    'id_vitamin' => 1,
                    'waktu_pemberian' => Carbon::now()->subDays(6),
                    'dosis' => '1.5 ml',
                    'keterangan' => 'Dosis pertama ulang',
                ],
                [
                    'no_pendaftaran' => 4,
                    'id_vitamin' => 3,
                    'waktu_pemberian' => Carbon::now()->subDays(4),
                    'dosis' => '2.5 ml',
                    'keterangan' => 'Dosis ketiga diberikan',
                ],
                [
                    'no_pendaftaran' => 5,
                    'id_vitamin' => 2,
                    'waktu_pemberian' => Carbon::now()->subDays(2),
                    'dosis' => '2 ml',
                    'keterangan' => 'Dosis kedua ulang',
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('Seeder gagal: ' . $e->getMessage());
        }
    }
}
