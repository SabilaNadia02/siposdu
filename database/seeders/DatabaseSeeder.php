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
        // Menjalankan seeder pengguna
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Menjalankan seeder lainnya
        $this->call([
            DataImunisasiSeeder::class, 
            DataVitaminSeeder::class,
            DataObatSeeder::class,
            DataVaksinSeeder::class,
            DataPosyanduSeeder::class,
            PendaftaranSeeder::class,
            PencatatanAwalSeeder::class,
            DetailPencatatanAwalSeeder::class,
            PencatatanKunjunganSeeder::class,
            DetailPencatatanKunjunganSeeder::class,
            DataSkriningSeeder::class,
            DataPertanyaanSeeder::class,
            PertanyaanSkriningSeeder::class,
            PencatatanSkriningSeeder::class,
            DetailPencatatanSkrining::class,
            PemberianImunisasiSeeder::class,
            PemberianVitaminSeeder::class,
            PemberianObatSeeder::class,
            PemberianVaksinSeeder::class,
            RujukanSeeder::class,
            DataPenggunaSeeder::class,
        ]);
    }
}
