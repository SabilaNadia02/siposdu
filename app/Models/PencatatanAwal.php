<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PencatatanAwal extends Model
{
    const STATUS_BALITA = 1;
    const STATUS_LULUS = 2;

    protected $fillable = [
        'no_pendaftaran',

        // Data Ibu Hamil
        'hpht',
        'htp',
        'nama_suami',
        'hamil_ke',
        'jarak_anak',
        'tinggi_badan',
        'usia_kehamilan',

        // Data Balita
        'nama_ibu',
        'nama_ayah',
        'berat_badan_lahir',
        'panjang_badan_lahir',
        'status_balita', // data yang digunakan, default == 1, LULUS == 2

        // Data Lansia
        'riwayat_keluarga',
        'riwayat_diri_sendiri',
        'perilaku_berisiko',
    ];

    protected $casts = [
        'riwayat_keluarga' => 'array',
        'riwayat_diri_sendiri' => 'array',
        'perilaku_berisiko' => 'array',
    ];

    // Di model PencatatanAwal.php
    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class, 'no_pendaftaran', 'id');
    }

    public function pencatatanKunjungan(): HasMany
    {
        return $this->hasMany(PencatatanKunjungan::class, 'id_pencatatan_awal');
    }

    // Scope untuk balita aktif
    public function scopeAktif($query)
    {
        return $query->where(function ($q) {
            $q->where('status_balita', self::STATUS_BALITA)
                ->orWhereNull('status_balita');
        });
    }

    // Scope untuk balita lulus
    public function scopeLulus($query)
    {
        return $query->where('status_balita', self::STATUS_LULUS);
    }

    public function scopeTidakKunjung($query, $startDate, $endDate, $jenisSasaran = null)
    {
        return $query->whereDoesntHave('pencatatanKunjungan', function ($q) use ($startDate, $endDate) {
            $q->whereBetween('waktu_pencatatan', [$startDate, $endDate]);
        })->whereHas('pendaftaran', function ($q) use ($jenisSasaran) {
            if ($jenisSasaran) {
                $q->where('jenis_sasaran', $jenisSasaran);
            }
        });
    }

    public function getAgeInDays()
    {
        if (!$this->pendaftaran || !$this->pendaftaran->tanggal_lahir) {
            return 0;
        }

        $birthDate = new \DateTime($this->pendaftaran->tanggal_lahir);
        $now = new \DateTime();
        $interval = $now->diff($birthDate);

        return $interval->days;
    }

    // Check if balita is eligible for graduation
    public function isEligibleForGraduation()
    {
        if (!$this->pendaftaran || !$this->pendaftaran->tanggal_lahir) {
            return false;
        }

        $birthDate = new \DateTime($this->pendaftaran->tanggal_lahir);
        $now = new \DateTime();
        $interval = $now->diff($birthDate);

        return $interval->y >= 5;
    }

    public function getAgeInMonths()
    {
        if (!$this->pendaftaran || !$this->pendaftaran->tanggal_lahir) {
            return 0;
        }

        $birthDate = new \DateTime($this->pendaftaran->tanggal_lahir);
        $now = new \DateTime();
        $interval = $now->diff($birthDate);

        return ($interval->y * 12) + $interval->m;
    }

    // Get age string
    public function getAgeString()
    {
        if (!$this->pendaftaran || !$this->pendaftaran->tanggal_lahir) {
            return 'Tanggal lahir tidak tersedia';
        }

        $birthDate = new \DateTime($this->pendaftaran->tanggal_lahir);
        $now = new \DateTime();
        $interval = $now->diff($birthDate);

        $result = '';
        if ($interval->y > 0) {
            $result .= $interval->y . ' Tahun ';
        }
        if ($interval->m > 0) {
            $result .= $interval->m . ' Bulan ';
        }
        $result .= $interval->d . ' Hari';

        return $result;
    }

    public function scopeStunting($query)
    {
        return $query->whereHas('pencatatanKunjungan', function ($q) {
            $q->where('mt_pangan_pemulihan', 1); // Asumsi 1 = stunting
        });
    }

    // Method untuk mengecek status stunting terbaru
    public function getStatusStuntingAttribute()
    {
        $latestKunjungan = $this->pencatatanKunjungan()
            ->latest('waktu_pencatatan')
            ->first();

        return $latestKunjungan ? ($latestKunjungan->mt_pangan_pemulihan == 1 ? 'Stunting' : 'Normal') : 'Belum Ada Data';
    }

    public function calculateStuntingStatus($tinggiBadan, $usiaBulan, $jenisKelamin)
    {
        // Implementasi lookup tabel WHO untuk TB/U
        $medianTbu = $this->getWhoMedianTbu($usiaBulan, $jenisKelamin);
        $sdTbu = $this->getWhoSdTbu($usiaBulan, $jenisKelamin);

        if ($medianTbu === null || $sdTbu === null) {
            return 'Data WHO tidak tersedia';
        }

        $zScore = ($tinggiBadan - $medianTbu) / $sdTbu;

        if ($zScore < -3) {
            return 'Severely Stunted';
        } elseif ($zScore < -2) {
            return 'Stunted';
        } else {
            return 'Normal';
        }
    }

    public function calculateWastingStatus($beratBadan, $tinggiBadan, $jenisKelamin)
    {
        // Implementasi lookup tabel WHO untuk BB/TB
        $medianBbtb = $this->getWhoMedianBbtb($tinggiBadan, $jenisKelamin);
        $sdBbtb = $this->getWhoSdBbtb($tinggiBadan, $jenisKelamin);

        if ($medianBbtb === null || $sdBbtb === null) {
            return 'Data WHO tidak tersedia';
        }

        $zScore = ($beratBadan - $medianBbtb) / $sdBbtb;

        if ($zScore < -3) {
            return 'Severely Wasted';
        } elseif ($zScore < -2) {
            return 'Wasted';
        } else {
            return 'Normal';
        }
    }

    protected function getWhoMedianTbu($usiaBulan, $jenisKelamin)
    {
        // Data median TB/U berdasarkan WHO untuk usia 0-60 bulan
        $data = [
            0 => [1 => 49.1, 2 => 49.9],
            1 => [1 => 53.7, 2 => 54.7],
            2 => [1 => 57.1, 2 => 58.4],
            3 => [1 => 59.8, 2 => 61.4],
            4 => [1 => 62.1, 2 => 63.9],
            5 => [1 => 64.0, 2 => 65.9],
            6 => [1 => 65.7, 2 => 67.6],
            7 => [1 => 67.3, 2 => 69.2],
            8 => [1 => 68.7, 2 => 70.6],
            9 => [1 => 70.1, 2 => 72.0],
            10 => [1 => 71.5, 2 => 73.3],
            11 => [1 => 72.8, 2 => 74.5],
            12 => [1 => 74.0, 2 => 75.7],
            13 => [1 => 75.1, 2 => 76.9],
            14 => [1 => 76.3, 2 => 78.0],
            15 => [1 => 77.5, 2 => 79.2],
            16 => [1 => 78.6, 2 => 80.2],
            17 => [1 => 79.7, 2 => 81.3],
            18 => [1 => 80.7, 2 => 82.3],
            19 => [1 => 81.7, 2 => 83.2],
            20 => [1 => 82.7, 2 => 84.2],
            21 => [1 => 83.7, 2 => 85.1],
            22 => [1 => 84.6, 2 => 86.0],
            23 => [1 => 85.5, 2 => 86.9],
            24 => [1 => 85.7, 2 => 87.8],
            25 => [1 => 86.6, 2 => 88.7],
            26 => [1 => 87.4, 2 => 89.6],
            27 => [1 => 88.3, 2 => 90.4],
            28 => [1 => 89.1, 2 => 91.2],
            29 => [1 => 89.9, 2 => 92.0],
            30 => [1 => 90.7, 2 => 92.7],
            31 => [1 => 91.4, 2 => 93.4],
            32 => [1 => 92.2, 2 => 94.1],
            33 => [1 => 92.9, 2 => 94.8],
            34 => [1 => 93.6, 2 => 95.4],
            35 => [1 => 94.3, 2 => 96.1],
            36 => [1 => 95.0, 2 => 96.7],
            37 => [1 => 95.6, 2 => 97.4],
            38 => [1 => 96.3, 2 => 98.0],
            39 => [1 => 96.9, 2 => 98.6],
            40 => [1 => 97.5, 2 => 99.2],
            41 => [1 => 98.1, 2 => 99.8],
            42 => [1 => 98.7, 2 => 100.4],
            43 => [1 => 99.3, 2 => 101.0],
            44 => [1 => 99.9, 2 => 101.5],
            45 => [1 => 100.4, 2 => 102.1],
            46 => [1 => 101.0, 2 => 102.6],
            47 => [1 => 101.5, 2 => 103.2],
            48 => [1 => 102.0, 2 => 103.7],
            49 => [1 => 102.6, 2 => 104.2],
            50 => [1 => 103.1, 2 => 104.7],
            51 => [1 => 103.6, 2 => 105.2],
            52 => [1 => 104.1, 2 => 105.7],
            53 => [1 => 104.6, 2 => 106.2],
            54 => [1 => 105.1, 2 => 106.7],
            55 => [1 => 105.6, 2 => 107.2],
            56 => [1 => 106.1, 2 => 107.6],
            57 => [1 => 106.5, 2 => 108.1],
            58 => [1 => 107.0, 2 => 108.5],
            59 => [1 => 107.5, 2 => 109.0],
            60 => [1 => 108.0, 2 => 109.4],
        ];

        return $data[$usiaBulan][$jenisKelamin] ?? null;
    }


    protected function getWhoSdTbu($usiaBulan, $jenisKelamin)
    {
        // SD (standar deviasi) TB/U WHO untuk usia 0–60 bulan
        $data = [
            0 => [1 => 1.9, 2 => 1.9],
            1 => [1 => 2.0, 2 => 2.0],
            2 => [1 => 2.1, 2 => 2.1],
            3 => [1 => 2.1, 2 => 2.1],
            4 => [1 => 2.2, 2 => 2.2],
            5 => [1 => 2.2, 2 => 2.2],
            6 => [1 => 2.2, 2 => 2.3],
            7 => [1 => 2.3, 2 => 2.3],
            8 => [1 => 2.3, 2 => 2.3],
            9 => [1 => 2.3, 2 => 2.3],
            10 => [1 => 2.3, 2 => 2.3],
            11 => [1 => 2.4, 2 => 2.4],
            12 => [1 => 2.4, 2 => 2.4],
            13 => [1 => 2.4, 2 => 2.4],
            14 => [1 => 2.4, 2 => 2.4],
            15 => [1 => 2.5, 2 => 2.5],
            16 => [1 => 2.5, 2 => 2.5],
            17 => [1 => 2.5, 2 => 2.5],
            18 => [1 => 2.5, 2 => 2.5],
            19 => [1 => 2.5, 2 => 2.6],
            20 => [1 => 2.6, 2 => 2.6],
            21 => [1 => 2.6, 2 => 2.6],
            22 => [1 => 2.6, 2 => 2.6],
            23 => [1 => 2.6, 2 => 2.6],
            24 => [1 => 2.6, 2 => 2.6],
            25 => [1 => 2.6, 2 => 2.6],
            26 => [1 => 2.6, 2 => 2.6],
            27 => [1 => 2.6, 2 => 2.6],
            28 => [1 => 2.6, 2 => 2.6],
            29 => [1 => 2.6, 2 => 2.6],
            30 => [1 => 2.6, 2 => 2.6],
            31 => [1 => 2.6, 2 => 2.6],
            32 => [1 => 2.6, 2 => 2.6],
            33 => [1 => 2.6, 2 => 2.6],
            34 => [1 => 2.6, 2 => 2.6],
            35 => [1 => 2.6, 2 => 2.6],
            36 => [1 => 2.6, 2 => 2.6],
            37 => [1 => 2.6, 2 => 2.6],
            38 => [1 => 2.6, 2 => 2.6],
            39 => [1 => 2.6, 2 => 2.6],
            40 => [1 => 2.6, 2 => 2.6],
            41 => [1 => 2.6, 2 => 2.6],
            42 => [1 => 2.6, 2 => 2.6],
            43 => [1 => 2.6, 2 => 2.6],
            44 => [1 => 2.6, 2 => 2.6],
            45 => [1 => 2.6, 2 => 2.6],
            46 => [1 => 2.6, 2 => 2.6],
            47 => [1 => 2.6, 2 => 2.6],
            48 => [1 => 2.6, 2 => 2.6],
            49 => [1 => 2.6, 2 => 2.6],
            50 => [1 => 2.6, 2 => 2.6],
            51 => [1 => 2.6, 2 => 2.6],
            52 => [1 => 2.6, 2 => 2.6],
            53 => [1 => 2.6, 2 => 2.6],
            54 => [1 => 2.6, 2 => 2.6],
            55 => [1 => 2.6, 2 => 2.6],
            56 => [1 => 2.6, 2 => 2.6],
            57 => [1 => 2.6, 2 => 2.6],
            58 => [1 => 2.6, 2 => 2.6],
            59 => [1 => 2.6, 2 => 2.6],
            60 => [1 => 2.6, 2 => 2.6],
        ];

        return $data[$usiaBulan][$jenisKelamin] ?? null;
    }

    protected function getWhoMedianBbtb($tinggiBadan, $jenisKelamin)
    {
        // WHO Median BB/TB untuk panjang/tinggi badan 45–110 cm
        // 1 = perempuan, 2 = laki-laki
        $data = [
            45 => [1 => 2.4, 2 => 2.5],
            46 => [1 => 2.5, 2 => 2.6],
            47 => [1 => 2.6, 2 => 2.7],
            48 => [1 => 2.7, 2 => 2.8],
            49 => [1 => 2.8, 2 => 2.9],
            50 => [1 => 2.9, 2 => 3.0],
            51 => [1 => 3.0, 2 => 3.1],
            52 => [1 => 3.1, 2 => 3.2],
            53 => [1 => 3.2, 2 => 3.3],
            54 => [1 => 3.3, 2 => 3.4],
            55 => [1 => 3.4, 2 => 3.5],
            56 => [1 => 3.5, 2 => 3.6],
            57 => [1 => 3.6, 2 => 3.7],
            58 => [1 => 3.7, 2 => 3.8],
            59 => [1 => 3.8, 2 => 3.9],
            60 => [1 => 3.9, 2 => 4.0],
            61 => [1 => 4.0, 2 => 4.1],
            62 => [1 => 4.1, 2 => 4.2],
            63 => [1 => 4.2, 2 => 4.3],
            64 => [1 => 4.3, 2 => 4.4],
            65 => [1 => 4.4, 2 => 4.5],
            66 => [1 => 4.5, 2 => 4.6],
            67 => [1 => 4.6, 2 => 4.7],
            68 => [1 => 4.7, 2 => 4.8],
            69 => [1 => 4.8, 2 => 4.9],
            70 => [1 => 4.9, 2 => 5.0],
            71 => [1 => 5.0, 2 => 5.1],
            72 => [1 => 5.1, 2 => 5.2],
            73 => [1 => 5.2, 2 => 5.3],
            74 => [1 => 5.3, 2 => 5.4],
            75 => [1 => 5.4, 2 => 5.5],
            76 => [1 => 5.5, 2 => 5.6],
            77 => [1 => 5.6, 2 => 5.7],
            78 => [1 => 5.7, 2 => 5.8],
            79 => [1 => 5.8, 2 => 5.9],
            80 => [1 => 5.9, 2 => 6.0],
            81 => [1 => 6.0, 2 => 6.1],
            82 => [1 => 6.1, 2 => 6.2],
            83 => [1 => 6.2, 2 => 6.3],
            84 => [1 => 6.3, 2 => 6.4],
            85 => [1 => 6.4, 2 => 6.5],
            86 => [1 => 6.5, 2 => 6.6],
            87 => [1 => 6.6, 2 => 6.7],
            88 => [1 => 6.7, 2 => 6.8],
            89 => [1 => 6.8, 2 => 6.9],
            90 => [1 => 6.9, 2 => 7.0],
            91 => [1 => 7.0, 2 => 7.1],
            92 => [1 => 7.1, 2 => 7.2],
            93 => [1 => 7.2, 2 => 7.3],
            94 => [1 => 7.3, 2 => 7.4],
            95 => [1 => 7.4, 2 => 7.5],
            96 => [1 => 7.5, 2 => 7.6],
            97 => [1 => 7.6, 2 => 7.7],
            98 => [1 => 7.7, 2 => 7.8],
            99 => [1 => 7.8, 2 => 7.9],
            100 => [1 => 7.9, 2 => 8.0],
            101 => [1 => 8.0, 2 => 8.1],
            102 => [1 => 8.1, 2 => 8.2],
            103 => [1 => 8.2, 2 => 8.3],
            104 => [1 => 8.3, 2 => 8.4],
            105 => [1 => 8.4, 2 => 8.5],
            106 => [1 => 8.5, 2 => 8.6],
            107 => [1 => 8.6, 2 => 8.7],
            108 => [1 => 8.7, 2 => 8.8],
            109 => [1 => 8.8, 2 => 8.9],
            110 => [1 => 8.9, 2 => 9.0],
        ];

        return $data[$tinggiBadan][$jenisKelamin] ?? null;
    }

    protected function getWhoSdBbtb($tinggiBadan, $jenisKelamin)
    {
        // WHO Standar Deviasi BB/TB untuk panjang/tinggi badan 45–110 cm
        // 1 = perempuan, 2 = laki-laki
        $data = [
            45 => [1 => 0.15, 2 => 0.15],
            46 => [1 => 0.16, 2 => 0.16],
            47 => [1 => 0.17, 2 => 0.17],
            48 => [1 => 0.18, 2 => 0.18],
            49 => [1 => 0.19, 2 => 0.19],
            50 => [1 => 0.20, 2 => 0.20],
            51 => [1 => 0.21, 2 => 0.21],
            52 => [1 => 0.22, 2 => 0.22],
            53 => [1 => 0.23, 2 => 0.23],
            54 => [1 => 0.24, 2 => 0.24],
            55 => [1 => 0.25, 2 => 0.25],
            56 => [1 => 0.26, 2 => 0.26],
            57 => [1 => 0.27, 2 => 0.27],
            58 => [1 => 0.28, 2 => 0.28],
            59 => [1 => 0.29, 2 => 0.29],
            60 => [1 => 0.30, 2 => 0.30],
            61 => [1 => 0.31, 2 => 0.31],
            62 => [1 => 0.32, 2 => 0.32],
            63 => [1 => 0.33, 2 => 0.33],
            64 => [1 => 0.34, 2 => 0.34],
            65 => [1 => 0.35, 2 => 0.35],
            66 => [1 => 0.36, 2 => 0.36],
            67 => [1 => 0.37, 2 => 0.37],
            68 => [1 => 0.38, 2 => 0.38],
            69 => [1 => 0.39, 2 => 0.39],
            70 => [1 => 0.40, 2 => 0.40],
            71 => [1 => 0.41, 2 => 0.41],
            72 => [1 => 0.42, 2 => 0.42],
            73 => [1 => 0.43, 2 => 0.43],
            74 => [1 => 0.44, 2 => 0.44],
            75 => [1 => 0.45, 2 => 0.45],
            76 => [1 => 0.46, 2 => 0.46],
            77 => [1 => 0.47, 2 => 0.47],
            78 => [1 => 0.48, 2 => 0.48],
            79 => [1 => 0.49, 2 => 0.49],
            80 => [1 => 0.50, 2 => 0.50],
            81 => [1 => 0.85, 2 => 0.87],
            82 => [1 => 0.88, 2 => 0.89],
            83 => [1 => 0.90, 2 => 0.91],
            84 => [1 => 0.92, 2 => 0.93],
            85 => [1 => 0.94, 2 => 0.95],
            86 => [1 => 0.96, 2 => 0.97],
            87 => [1 => 0.98, 2 => 0.99],
            88 => [1 => 1.00, 2 => 1.01],
            89 => [1 => 1.02, 2 => 1.03],
            90 => [1 => 1.04, 2 => 1.05],
            91 => [1 => 1.06, 2 => 1.07],
            92 => [1 => 1.08, 2 => 1.09],
            93 => [1 => 1.10, 2 => 1.11],
            94 => [1 => 1.12, 2 => 1.13],
            95 => [1 => 1.14, 2 => 1.15],
            96 => [1 => 1.16, 2 => 1.17],
            97 => [1 => 1.18, 2 => 1.19],
            98 => [1 => 1.20, 2 => 1.21],
            99 => [1 => 1.22, 2 => 1.23],
            100 => [1 => 1.24, 2 => 1.25],
            101 => [1 => 1.26, 2 => 1.27],
            102 => [1 => 1.28, 2 => 1.29],
            103 => [1 => 1.30, 2 => 1.31],
            104 => [1 => 1.32, 2 => 1.33],
            105 => [1 => 1.34, 2 => 1.35],
            106 => [1 => 1.36, 2 => 1.37],
            107 => [1 => 1.38, 2 => 1.39],
            108 => [1 => 1.40, 2 => 1.41],
            109 => [1 => 1.42, 2 => 1.43],
            110 => [1 => 1.44, 2 => 1.45],
        ];

        return $data[$tinggiBadan][$jenisKelamin] ?? null;
    }
}
