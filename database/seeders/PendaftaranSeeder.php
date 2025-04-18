<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pendaftaran;
use App\Models\DataPosyandu;
use Carbon\Carbon;

class PendaftaranSeeder extends Seeder
{
    public function run()
    {
        $posyandus = DataPosyandu::pluck('id')->toArray();

        Pendaftaran::insert([
            [
                'nik' => '3201234567890001',
                'nama' => 'Ani Setiawati',
                'jenis_kelamin' => 2,
                'status_perkawinan' => 1,
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => Carbon::parse('1990-05-15'),
                'pendidikan' => 6,
                'pekerjaan' => 1, // Tidak Bekerja
                'alamat' => 'Jl. Merdeka No. 10, Bandung',
                'no_hp' => '081234567890',
                'no_jkn' => '1234567890123',
                'jenis_sasaran' => 1,
                'data_posyandu_id' => $posyandus[array_rand($posyandus)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '3201234567890002',
                'nama' => 'Dewi Kurniasih',
                'jenis_kelamin' => 2,
                'status_perkawinan' => 1,
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => Carbon::parse('1985-09-12'),
                'pendidikan' => 5,
                'pekerjaan' => 2, // PNS
                'alamat' => 'Jl. Sudirman No. 21, Jakarta',
                'no_hp' => '081298765432',
                'no_jkn' => '9876543210987',
                'jenis_sasaran' => 1,
                'data_posyandu_id' => $posyandus[array_rand($posyandus)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '3201234567890003',
                'nama' => 'Ahmad Ramadhan',
                'jenis_kelamin' => 1,
                'status_perkawinan' => 1,
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => Carbon::parse('2019-04-25'),
                'pendidikan' => 1,
                'pekerjaan' => 1, // Tidak Bekerja
                'alamat' => 'Jl. Diponegoro No. 8, Surabaya',
                'no_hp' => '081122334455',
                'no_jkn' => '1122334455667',
                'jenis_sasaran' => 2,
                'data_posyandu_id' => $posyandus[array_rand($posyandus)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '3201234567890004',
                'nama' => 'Siti Nurhaliza',
                'jenis_kelamin' => 2,
                'status_perkawinan' => 1,
                'tempat_lahir' => 'Yogyakarta',
                'tanggal_lahir' => Carbon::parse('2020-07-30'),
                'pendidikan' => 1,
                'pekerjaan' => 1, // Tidak Bekerja
                'alamat' => 'Jl. Malioboro No. 7, Yogyakarta',
                'no_hp' => '0813344556677',
                'no_jkn' => '2233445566778',
                'jenis_sasaran' => 1,
                'data_posyandu_id' => $posyandus[array_rand($posyandus)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '3201234567890005',
                'nama' => 'Rizki Saputra',
                'jenis_kelamin' => 1,
                'status_perkawinan' => 1,
                'tempat_lahir' => 'Medan',
                'tanggal_lahir' => Carbon::parse('2000-02-15'),
                'pendidikan' => 4,
                'pekerjaan' => 1, // Tidak Bekerja (Pelajar)
                'alamat' => 'Jl. Gatot Subroto No. 99, Medan',
                'no_hp' => '081566778899',
                'no_jkn' => '3344556677889',
                'jenis_sasaran' => 3,
                'data_posyandu_id' => $posyandus[array_rand($posyandus)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '3201234567890006',
                'nama' => 'Nining Sari',
                'jenis_kelamin' => 2,
                'status_perkawinan' => 2,
                'tempat_lahir' => 'Semarang',
                'tanggal_lahir' => Carbon::parse('1980-10-20'),
                'pendidikan' => 3,
                'pekerjaan' => 5, // Wirausaha
                'alamat' => 'Jl. Pahlawan No. 15, Semarang',
                'no_hp' => '081677889900',
                'no_jkn' => '4455667788990',
                'jenis_sasaran' => 1,
                'data_posyandu_id' => $posyandus[array_rand($posyandus)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '3201234567890007',
                'nama' => 'Fauzan Hakim',
                'jenis_kelamin' => 1,
                'status_perkawinan' => 2,
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => Carbon::parse('1995-12-05'),
                'pendidikan' => 5,
                'pekerjaan' => 4, // Swasta
                'alamat' => 'Jl. Asia Afrika No. 1, Bandung',
                'no_hp' => '081788990011',
                'no_jkn' => '5566778899001',
                'jenis_sasaran' => 3,
                'data_posyandu_id' => $posyandus[array_rand($posyandus)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '3201234567890008',
                'nama' => 'Lina Mariani',
                'jenis_kelamin' => 2,
                'status_perkawinan' => 2,
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => Carbon::parse('1982-06-18'),
                'pendidikan' => 4,
                'pekerjaan' => 2, // PNS
                'alamat' => 'Jl. MH Thamrin No. 8, Jakarta',
                'no_hp' => '081899001122',
                'no_jkn' => '6677889900112',
                'jenis_sasaran' => 3,
                'data_posyandu_id' => $posyandus[array_rand($posyandus)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '3201234567890009',
                'nama' => 'Yudi Pratama',
                'jenis_kelamin' => 1,
                'status_perkawinan' => 1,
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => Carbon::parse('2021-03-01'),
                'pendidikan' => 1,
                'pekerjaan' => 1, // Tidak Bekerja
                'alamat' => 'Jl. Ahmad Yani No. 50, Surabaya',
                'no_hp' => '081999112233',
                'no_jkn' => '7788990011223',
                'jenis_sasaran' => 2,
                'data_posyandu_id' => $posyandus[array_rand($posyandus)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '3201234567890010',
                'nama' => 'Mutiara Dewi',
                'jenis_kelamin' => 2,
                'status_perkawinan' => 1,
                'tempat_lahir' => 'Yogyakarta',
                'tanggal_lahir' => Carbon::parse('2018-11-23'),
                'pendidikan' => 1,
                'pekerjaan' => 1, // Tidak Bekerja
                'alamat' => 'Jl. Kaliurang No. 12, Yogyakarta',
                'no_hp' => '081555667788',
                'no_jkn' => '8899001122334',
                'jenis_sasaran' => 2,
                'data_posyandu_id' => $posyandus[array_rand($posyandus)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
