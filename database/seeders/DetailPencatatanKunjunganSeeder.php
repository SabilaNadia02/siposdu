<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\PencatatanKunjungan;

class DetailPencatatanKunjunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!Schema::hasTable('detail_pencatatan_kunjungans')) {
            return;
        }

        // Pastikan ada data di tabel pencatatan_kunjungans terlebih dahulu
        $kunjunganIds = PencatatanKunjungan::pluck('id')->toArray();

        if (empty($kunjunganIds)) {
            return;
        }

        DB::table('detail_pencatatan_kunjungans')->insert([
            [
                'id_pencatatan_kunjungan' => $kunjunganIds[array_rand($kunjunganIds)],
                'berat_badan' => 3.2,
                'panjang_badan' => 50.5,
                'tinggi_badan' => 51.0,
                'lingkar_lengan' => 10.5,
                'lingkar_kepala' => 34.0,
                'lingkar_perut' => 30.5,
                'usia_kehamilan' => null,
                'mt_bumil_kek' => null,
                'asi_eksklusif' => 1,
                'mp_asi' => 2,
                'mt_pangan_pemulihan' => 1,
                'catatan_kesehatan' => 'Sehat, pertumbuhan normal',
                'tes_mata_kanan' => 1,
                'tes_mata_kiri' => 1,
                'tes_telinga_kanan' => 1,
                'tes_telinga_kiri' => 1,
                'tekanan_darah_sistolik' => null,
                'tekanan_darah_diastolik' => null,
                'gula_darah' => null,
                'kolestrol' => null,
                'keluhan' => null,
                'edukasi' => 'Pentingnya imunisasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pencatatan_kunjungan' => $kunjunganIds[array_rand($kunjunganIds)],
                'berat_badan' => 2.9,
                'panjang_badan' => 48.0,
                'tinggi_badan' => 49.0,
                'lingkar_lengan' => 9.8,
                'lingkar_kepala' => 33.5,
                'lingkar_perut' => 29.8,
                'usia_kehamilan' => null,
                'mt_bumil_kek' => null,
                'asi_eksklusif' => 2,
                'mp_asi' => 1,
                'mt_pangan_pemulihan' => 2,
                'catatan_kesehatan' => 'Sedikit kurang berat badan',
                'tes_mata_kanan' => 1,
                'tes_mata_kiri' => 1,
                'tes_telinga_kanan' => 1,
                'tes_telinga_kiri' => 1,
                'tekanan_darah_sistolik' => null,
                'tekanan_darah_diastolik' => null,
                'gula_darah' => null,
                'kolestrol' => null,
                'keluhan' => 'Sering rewel',
                'edukasi' => 'Meningkatkan asupan gizi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pencatatan_kunjungan' => $kunjunganIds[array_rand($kunjunganIds)],
                'berat_badan' => 3.5,
                'panjang_badan' => 52.0,
                'tinggi_badan' => 52.5,
                'lingkar_lengan' => 11.0,
                'lingkar_kepala' => 34.5,
                'lingkar_perut' => 31.0,
                'usia_kehamilan' => null,
                'mt_bumil_kek' => null,
                'asi_eksklusif' => 1,
                'mp_asi' => 1,
                'mt_pangan_pemulihan' => 1,
                'catatan_kesehatan' => 'Pertumbuhan baik',
                'tes_mata_kanan' => 1,
                'tes_mata_kiri' => 1,
                'tes_telinga_kanan' => 1,
                'tes_telinga_kiri' => 1,
                'tekanan_darah_sistolik' => null,
                'tekanan_darah_diastolik' => null,
                'gula_darah' => null,
                'kolestrol' => null,
                'keluhan' => null,
                'edukasi' => 'Lanjutkan pemberian ASI eksklusif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pencatatan_kunjungan' => $kunjunganIds[array_rand($kunjunganIds)],
                'berat_badan' => 3.1,
                'panjang_badan' => 49.5,
                'tinggi_badan' => 50.0,
                'lingkar_lengan' => 10.2,
                'lingkar_kepala' => 34.2,
                'lingkar_perut' => 30.2,
                'usia_kehamilan' => null,
                'mt_bumil_kek' => null,
                'asi_eksklusif' => 2,
                'mp_asi' => 2,
                'mt_pangan_pemulihan' => 2,
                'catatan_kesehatan' => 'Dalam pemantauan dokter',
                'tes_mata_kanan' => 1,
                'tes_mata_kiri' => 1,
                'tes_telinga_kanan' => 1,
                'tes_telinga_kiri' => 1,
                'tekanan_darah_sistolik' => null,
                'tekanan_darah_diastolik' => null,
                'gula_darah' => null,
                'kolestrol' => null,
                'keluhan' => 'Pernapasan berbunyi',
                'edukasi' => 'Konsultasi lebih lanjut ke dokter',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
