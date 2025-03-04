<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\PencatatanAwal;

class DetailPencatatanAwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!Schema::hasTable('detail_pencatatan_awals')) {
            return;
        }

        // Ambil beberapa ID dari tabel pencatatan_awals untuk relasi
        $pencatatanAwalIds = PencatatanAwal::pluck('id')->toArray();

        // Pastikan ada data di tabel pencatatan_awals sebelum melakukan seed
        if (empty($pencatatanAwalIds)) {
            return;
        }

        DB::table('detail_pencatatan_awals')->insert([
            [
                'id_pencatatan_awal' => $pencatatanAwalIds[array_rand($pencatatanAwalIds)],
                'hpht' => now()->subMonths(6),
                'htp' => now()->addMonths(3),
                'nama_suami' => 'Budi Santoso',
                'hamil_ke' => 2,
                'jarak_anak' => 3,
                'tinggi_badan' => 160.5,
                'nama_ibu' => 'Siti Aminah',
                'nama_ayah' => 'Ahmad Firdaus',
                'berat_badan_lahir' => 3.2,
                'panjang_badan_lahir' => 48.5,
                'status_balita' => 1,
                'riwayat_keluarga' => 'Tidak ada riwayat penyakit genetik.',
                'riwayat_diri_sendiri' => 'Sehat tanpa komplikasi.',
                'perilaku_berisiko' => 'Tidak merokok, tidak mengonsumsi alkohol.',
            ],
            [
                'id_pencatatan_awal' => $pencatatanAwalIds[array_rand($pencatatanAwalIds)],
                'hpht' => now()->subMonths(5),
                'htp' => now()->addMonths(4),
                'nama_suami' => 'Joko Widodo',
                'hamil_ke' => 3,
                'jarak_anak' => 4,
                'tinggi_badan' => 158.0,
                'nama_ibu' => 'Dewi Sartika',
                'nama_ayah' => 'Rudi Hartono',
                'berat_badan_lahir' => 3.5,
                'panjang_badan_lahir' => 49.0,
                'status_balita' => 2,
                'riwayat_keluarga' => 'Ayah memiliki riwayat diabetes.',
                'riwayat_diri_sendiri' => 'Memiliki riwayat anemia ringan.',
                'perilaku_berisiko' => 'Sering kurang tidur.',
            ],
            [
                'id_pencatatan_awal' => $pencatatanAwalIds[array_rand($pencatatanAwalIds)],
                'hpht' => now()->subMonths(4),
                'htp' => now()->addMonths(5),
                'nama_suami' => 'Andi Saputra',
                'hamil_ke' => 1,
                'jarak_anak' => 0,
                'tinggi_badan' => 165.2,
                'nama_ibu' => 'Rina Kusuma',
                'nama_ayah' => 'Fajar Setiawan',
                'berat_badan_lahir' => 3.0,
                'panjang_badan_lahir' => 47.8,
                'status_balita' => 1,
                'riwayat_keluarga' => 'Riwayat tekanan darah tinggi.',
                'riwayat_diri_sendiri' => 'Tidak ada keluhan.',
                'perilaku_berisiko' => 'Kurang olahraga.',
            ],
            [
                'id_pencatatan_awal' => $pencatatanAwalIds[array_rand($pencatatanAwalIds)],
                'hpht' => now()->subMonths(7),
                'htp' => now()->addMonths(2),
                'nama_suami' => 'Rahmat Hidayat',
                'hamil_ke' => 4,
                'jarak_anak' => 5,
                'tinggi_badan' => 162.3,
                'nama_ibu' => 'Maya Sari',
                'nama_ayah' => 'Imam Mahdi',
                'berat_badan_lahir' => 3.4,
                'panjang_badan_lahir' => 50.0,
                'status_balita' => 1,
                'riwayat_keluarga' => 'Riwayat alergi makanan.',
                'riwayat_diri_sendiri' => 'Sehat.',
                'perilaku_berisiko' => 'Sering begadang.',
            ],
            [
                'id_pencatatan_awal' => $pencatatanAwalIds[array_rand($pencatatanAwalIds)],
                'hpht' => now()->subMonths(8),
                'htp' => now()->addMonth(),
                'nama_suami' => 'Eko Prasetyo',
                'hamil_ke' => 2,
                'jarak_anak' => 2,
                'tinggi_badan' => 159.5,
                'nama_ibu' => 'Fitri Handayani',
                'nama_ayah' => 'Darmawan',
                'berat_badan_lahir' => 3.1,
                'panjang_badan_lahir' => 48.0,
                'status_balita' => 2,
                'riwayat_keluarga' => 'Tidak ada riwayat penyakit serius.',
                'riwayat_diri_sendiri' => 'Mengalami mual berlebihan di trimester pertama.',
                'perilaku_berisiko' => 'Kurang minum air putih.',
            ]
        ]);
    }
}
