<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class PencatatanAwalSeeder extends Seeder
{
    public function run(): void
    {
        if (!Schema::hasTable('pencatatan_awals')) {
            return;
        }

        $data = [
            [
                'no_pendaftaran' => 1,
                'hpht' => Carbon::now()->subMonths(6)->format('Y-m-d'),
                'htp' => Carbon::now()->subMonths(6)->addDays(280)->format('Y-m-d'),
                'usia_kehamilan' => Carbon::now()->subMonths(6)->diffInWeeks(now()),
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
                'no_pendaftaran' => 2,
                'hpht' => Carbon::now()->subMonths(5)->format('Y-m-d'),
                'htp' => Carbon::now()->subMonths(5)->addDays(280)->format('Y-m-d'),
                'usia_kehamilan' => Carbon::now()->subMonths(5)->diffInWeeks(now()),
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
                'no_pendaftaran' => 3,
                'hpht' => Carbon::now()->subMonths(4)->format('Y-m-d'),
                'htp' => Carbon::now()->subMonths(4)->addDays(280)->format('Y-m-d'),
                'usia_kehamilan' => Carbon::now()->subMonths(4)->diffInWeeks(now()),
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
                'no_pendaftaran' => 4,
                'hpht' => Carbon::now()->subMonths(3)->format('Y-m-d'),
                'htp' => Carbon::now()->subMonths(3)->addDays(280)->format('Y-m-d'),
                'usia_kehamilan' => Carbon::now()->subMonths(3)->diffInWeeks(now()),
                'nama_suami' => 'Rahmat Hidayat',
                'hamil_ke' => 2,
                'jarak_anak' => 2,
                'tinggi_badan' => 162.5,
                'nama_ibu' => 'Fitri Ayu',
                'nama_ayah' => 'Dani Ramadhan',
                'berat_badan_lahir' => 3.1,
                'panjang_badan_lahir' => 48.0,
                'status_balita' => 1,
                'riwayat_keluarga' => 'Ibu memiliki riwayat asma.',
                'riwayat_diri_sendiri' => 'Pernah mengalami preeklamsia.',
                'perilaku_berisiko' => 'Sering konsumsi makanan cepat saji.',
            ],
            [
                'no_pendaftaran' => 1,
                'hpht' => Carbon::now()->subMonths(2)->format('Y-m-d'),
                'htp' => Carbon::now()->subMonths(2)->addDays(280)->format('Y-m-d'),
                'usia_kehamilan' => Carbon::now()->subMonths(2)->diffInWeeks(now()),
                'nama_suami' => 'Hendra Wijaya',
                'hamil_ke' => 4,
                'jarak_anak' => 5,
                'tinggi_badan' => 157.8,
                'nama_ibu' => 'Lina Sari',
                'nama_ayah' => 'Samsul Bahri',
                'berat_badan_lahir' => 2.9,
                'panjang_badan_lahir' => 46.5,
                'status_balita' => 2,
                'riwayat_keluarga' => 'Kakek dari pihak ibu memiliki hipertensi.',
                'riwayat_diri_sendiri' => 'Memiliki riwayat migrain.',
                'perilaku_berisiko' => 'Kurang konsumsi sayur dan buah.',
            ],
        ];

        DB::table('pencatatan_awals')->insert($data);
    }
}
