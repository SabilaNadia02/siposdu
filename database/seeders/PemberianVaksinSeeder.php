<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PemberianVaksinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::table('pemberian_vaksins')->insert([
                [
                    'no_pendaftaran' => 1,
                    'id_vaksin' => 1,
                    'waktu_pemberian' => Carbon::now()->subDays(20),
                    'dosis' => '0.5 ml',
                    'keterangan' => 'Dosis pertama diberikan',
                ],
                [
                    'no_pendaftaran' => 2,
                    'id_vaksin' => 2,
                    'waktu_pemberian' => Carbon::now()->subDays(15),
                    'dosis' => '1 ml',
                    'keterangan' => 'Dosis kedua diberikan',
                ],
                [
                    'no_pendaftaran' => 3,
                    'id_vaksin' => 3,
                    'waktu_pemberian' => Carbon::now()->subDays(10),
                    'dosis' => '0.5 ml',
                    'keterangan' => 'Dosis pertama ulang',
                ],
                [
                    'no_pendaftaran' => 4,
                    'id_vaksin' => 1,
                    'waktu_pemberian' => Carbon::now()->subDays(5),
                    'dosis' => '0.7 ml',
                    'keterangan' => 'Dosis ketiga diberikan',
                ],
                [
                    'no_pendaftaran' => 5,
                    'id_vaksin' => 2,
                    'waktu_pemberian' => Carbon::now()->subDays(3),
                    'dosis' => '1 ml',
                    'keterangan' => 'Dosis kedua ulang',
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('Seeder gagal: ' . $e->getMessage());
        }
    }
}
