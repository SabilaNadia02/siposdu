<?php

namespace Database\Seeders;

use App\Models\PencatatanAwal;
use App\Models\PencatatanKunjungan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PencatatanKunjunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tanggalLahir = Carbon::create(2023, 2, 15);
        $tanggalSekarang = Carbon::now();

        $bulan = 0;
        while ($tanggalLahir->copy()->addMonths($bulan)->lte($tanggalSekarang)) {
            $waktuPencatatan = $tanggalLahir->copy()->addMonths($bulan)->startOfDay();

            PencatatanKunjungan::create([
                'id_pencatatan_awal' => 1,
                'waktu_pencatatan' => $waktuPencatatan,
                'berat_badan' => 3.0 + ($bulan * 0.5), // naik 0.5 kg tiap bulan
                'panjang_badan' => 50 + ($bulan * 1.5), // naik 1.5 cm tiap bulan
                'lingkar_kepala' => 35 + ($bulan * 0.2), // naik 0.2 cm tiap bulan
                'lingkar_lengan' => 11 + ($bulan * 0.3),
                'keluhan' => $bulan % 6 === 0 ? 'Pemeriksaan rutin' : null,
                'edukasi' => $bulan < 6 ? 'Pentingnya ASI eksklusif' : 'MP-ASI dan gizi seimbang',
                'asi_eksklusif' => null,
                'mp_asi' => null,
                'mt_pangan_pemulihan' => null,
                'catatan_kesehatan' => $bulan % 3 === 0 ? 'Dalam kondisi baik' : null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $bulan++;
        }
    }
}
