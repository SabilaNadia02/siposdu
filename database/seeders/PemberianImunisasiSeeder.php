<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PemberianImunisasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::table('pemberian_imunisasis')->insert([
                [
                    'no_pendaftaran' => 1,
                    'id_imunisasi' => 1,
                    'waktu_pemberian' => Carbon::now()->subDays(10),
                    'keterangan' => 'Dosis pertama diberikan',
                ],
                [
                    'no_pendaftaran' => 2,
                    'id_imunisasi' => 2,
                    'waktu_pemberian' => Carbon::now()->subDays(7),
                    'keterangan' => 'Dosis kedua diberikan',
                ],
                [
                    'no_pendaftaran' => 3,
                    'id_imunisasi' => 1,
                    'waktu_pemberian' => Carbon::now()->subDays(5),
                    'keterangan' => 'Dosis pertama ulang',
                ],
                [
                    'no_pendaftaran' => 4,
                    'id_imunisasi' => 3,
                    'waktu_pemberian' => Carbon::now()->subDays(3),
                    'keterangan' => 'Dosis ketiga diberikan',
                ],
                [
                    'no_pendaftaran' => 1,
                    'id_imunisasi' => 2,
                    'waktu_pemberian' => Carbon::now()->subDays(1),
                    'keterangan' => 'Dosis kedua ulang',
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('Seeder gagal: ' . $e->getMessage());
        }
    }
}
