<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DataImunisasiSeeder::class,
            DataVitaminSeeder::class,
            // DataObatSeeder::class,
            // DataVaksinSeeder::class,
            DataPosyanduSeeder::class,
            DataSkriningSeeder::class,
            DataPertanyaanSeeder::class,
            PertanyaanSkriningSeeder::class,
            AdminUserSeeder::class,
            // PendaftaranSeeder::class,
            // PencatatanAwalSeeder::class,
            // PencatatanKunjunganSeeder::class,
            // PencatatanSkriningSeeder::class,
            // DetailPencatatanSkrining::class,
            // PemberianImunisasiSeeder::class,
            // PemberianVitaminSeeder::class,
            // PemberianObatSeeder::class,
            // PemberianVaksinSeeder::class,
            // RujukanSeeder::class,
            // DataPenggunaSeeder::class,
        ]);
    }
}
