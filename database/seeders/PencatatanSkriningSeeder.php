<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

class PencatatanSkriningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan tabel tidak kosong sebelum melakukan insert
        Schema::disableForeignKeyConstraints();
        DB::table('pencatatan_skrinings')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('pencatatan_skrinings')->insert([
            [
                'id_skrining' => 1,
                'no_pendaftaran' => 1,
                'waktu_skrining' => Carbon::now()->subDays(10)->toDateString(),
            ],
            [
                'id_skrining' => 1,
                'no_pendaftaran' => 2,
                'waktu_skrining' => Carbon::now()->subDays(7)->toDateString(),
            ],
            [
                'id_skrining' => 2,
                'no_pendaftaran' => 1,
                'waktu_skrining' => Carbon::now()->subDays(5)->toDateString(),
            ],
            [
                'id_skrining' => 2,
                'no_pendaftaran' => 3,
                'waktu_skrining' => Carbon::now()->subDays(3)->toDateString(),
            ],
            [
                'id_skrining' => 2,
                'no_pendaftaran' => 4,
                'waktu_skrining' => Carbon::now()->toDateString(),
            ],
        ]);
    }
}
