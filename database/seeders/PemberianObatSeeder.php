<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PemberianObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::table('pemberian_obats')->insert([
                [
                    'no_pendaftaran' => 1,
                    'id_obat' => 1,
                    'waktu_pemberian' => Carbon::now()->subDays(15),
                    'dosis' => '500 mg',
                    'keterangan' => 'Dosis pertama diberikan',
                ],
                [
                    'no_pendaftaran' => 2,
                    'id_obat' => 2,
                    'waktu_pemberian' => Carbon::now()->subDays(10),
                    'dosis' => '250 mg',
                    'keterangan' => 'Dosis kedua diberikan',
                ],
                [
                    'no_pendaftaran' => 3,
                    'id_obat' => 3,
                    'waktu_pemberian' => Carbon::now()->subDays(7),
                    'dosis' => '750 mg',
                    'keterangan' => 'Dosis pertama ulang',
                ],
                [
                    'no_pendaftaran' => 4,
                    'id_obat' => 1,
                    'waktu_pemberian' => Carbon::now()->subDays(5),
                    'dosis' => '500 mg',
                    'keterangan' => 'Dosis ketiga diberikan',
                ],
                [
                    'no_pendaftaran' => 5,
                    'id_obat' => 2,
                    'waktu_pemberian' => Carbon::now()->subDays(3),
                    'dosis' => '250 mg',
                    'keterangan' => 'Dosis kedua ulang',
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('Seeder gagal: ' . $e->getMessage());
        }
    }
}
