<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pendaftaran;
use Carbon\Carbon;

class PendaftaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pendaftaran::insert([
            [
                'nik' => '3201234567890001',
                'nama' => 'Budi Santoso',
                'jenis_kelamin' => 1,
                'status_perkawinan' => 2,
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => Carbon::parse('1990-05-15'),
                'pendidikan' => 6,
                'pekerjaan' => 'Dosen',
                'alamat' => 'Jl. Merdeka No. 123, Bandung',
                'no_hp' => '081234567890',
                'no_jkn' => '1234567890123',
            ],
            [
                'nik' => '3201234567890002',
                'nama' => 'Siti Aisyah',
                'jenis_kelamin' => 2,
                'status_perkawinan' => 1,
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => Carbon::parse('1995-08-22'),
                'pendidikan' => 4,
                'pekerjaan' => 'Guru',
                'alamat' => 'Jl. Sudirman No. 45, Jakarta',
                'no_hp' => '081298765432',
                'no_jkn' => '9876543210987',
            ],
            [
                'nik' => '3201234567890003',
                'nama' => 'Ahmad Fauzi',
                'jenis_kelamin' => 1,
                'status_perkawinan' => 1,
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => Carbon::parse('1988-12-10'),
                'pendidikan' => 5,
                'pekerjaan' => 'Pengusaha',
                'alamat' => 'Jl. Diponegoro No. 10, Surabaya',
                'no_hp' => '081322334455',
                'no_jkn' => '1122334455667',
            ],
            [
                'nik' => '3201234567890004',
                'nama' => 'Dewi Lestari',
                'jenis_kelamin' => 2,
                'status_perkawinan' => 2,
                'tempat_lahir' => 'Yogyakarta',
                'tanggal_lahir' => Carbon::parse('1992-07-30'),
                'pendidikan' => 6,
                'pekerjaan' => 'Dokter',
                'alamat' => 'Jl. Malioboro No. 7, Yogyakarta',
                'no_hp' => '081455667788',
                'no_jkn' => '2233445566778',
            ],
            [
                'nik' => '3201234567890005',
                'nama' => 'Rizky Hidayat',
                'jenis_kelamin' => 1,
                'status_perkawinan' => 1,
                'tempat_lahir' => 'Medan',
                'tanggal_lahir' => Carbon::parse('1997-04-18'),
                'pendidikan' => 3,
                'pekerjaan' => 'Mahasiswa',
                'alamat' => 'Jl. Gatot Subroto No. 99, Medan',
                'no_hp' => '081566778899',
                'no_jkn' => '3344556677889',
            ],
            [
                'nik' => '3201234567890006',
                'nama' => 'Fitri Nuraini',
                'jenis_kelamin' => 2,
                'status_perkawinan' => 2,
                'tempat_lahir' => 'Semarang',
                'tanggal_lahir' => Carbon::parse('1985-11-05'),
                'pendidikan' => 2,
                'pekerjaan' => 'Wiraswasta',
                'alamat' => 'Jl. Pandanaran No. 88, Semarang',
                'no_hp' => '081677889900',
                'no_jkn' => '4455667788990',
            ],
            [
                'nik' => '3201234567890007',
                'nama' => 'Bayu Pratama',
                'jenis_kelamin' => 1,
                'status_perkawinan' => 1,
                'tempat_lahir' => 'Malang',
                'tanggal_lahir' => Carbon::parse('1993-06-25'),
                'pendidikan' => 4,
                'pekerjaan' => 'Pegawai Negeri',
                'alamat' => 'Jl. Ijen No. 22, Malang',
                'no_hp' => '081788990011',
                'no_jkn' => '5566778899001',
            ],
            [
                'nik' => '3201234567890008',
                'nama' => 'Rina Kusuma',
                'jenis_kelamin' => 2,
                'status_perkawinan' => 2,
                'tempat_lahir' => 'Palembang',
                'tanggal_lahir' => Carbon::parse('1990-09-14'),
                'pendidikan' => 5,
                'pekerjaan' => 'Apoteker',
                'alamat' => 'Jl. Angkatan 45 No. 33, Palembang',
                'no_hp' => '081899001122',
                'no_jkn' => '6677889900112',
            ],
            [
                'nik' => '3201234567890009',
                'nama' => 'Eko Saputra',
                'jenis_kelamin' => 1,
                'status_perkawinan' => 1,
                'tempat_lahir' => 'Makassar',
                'tanggal_lahir' => Carbon::parse('1987-02-28'),
                'pendidikan' => 3,
                'pekerjaan' => 'Teknisi',
                'alamat' => 'Jl. Pettarani No. 77, Makassar',
                'no_hp' => '081900112233',
                'no_jkn' => '7788990011223',
            ],
            [
                'nik' => '3201234567890010',
                'nama' => 'Indah Permatasari',
                'jenis_kelamin' => 2,
                'status_perkawinan' => 2,
                'tempat_lahir' => 'Denpasar',
                'tanggal_lahir' => Carbon::parse('1994-12-01'),
                'pendidikan' => 6,
                'pekerjaan' => 'Designer',
                'alamat' => 'Jl. Dipta No. 5, Denpasar',
                'no_hp' => '082001122334',
                'no_jkn' => '8899001122334',
            ],
        ]);
    }
}