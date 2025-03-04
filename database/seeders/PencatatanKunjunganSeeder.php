<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\PencatatanAwal;

class PencatatanKunjunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!Schema::hasTable('pencatatan_kunjungans')) {
            return;
        }

        // Pastikan ada data di tabel pencatatan_awal terlebih dahulu
        $pencatatanAwalIds = PencatatanAwal::pluck('id')->toArray();

        if (empty($pencatatanAwalIds)) {
            return;
        }

        DB::table('pencatatan_kunjungans')->insert([
            [
                'id_pencatatan_awal' => $pencatatanAwalIds[array_rand($pencatatanAwalIds)],
                'waktu_pencatatan' => now()->subDays(10),
            ],
            [
                'id_pencatatan_awal' => $pencatatanAwalIds[array_rand($pencatatanAwalIds)],
                'waktu_pencatatan' => now()->subDays(20),
            ],
            [
                'id_pencatatan_awal' => $pencatatanAwalIds[array_rand($pencatatanAwalIds)],
                'waktu_pencatatan' => now()->subDays(30),
            ],
            [
                'id_pencatatan_awal' => $pencatatanAwalIds[array_rand($pencatatanAwalIds)],
                'waktu_pencatatan' => now()->subDays(40),
            ],
            [
                'id_pencatatan_awal' => $pencatatanAwalIds[array_rand($pencatatanAwalIds)],
                'waktu_pencatatan' => now()->subDays(50),
            ],
        ]);
    }
}
