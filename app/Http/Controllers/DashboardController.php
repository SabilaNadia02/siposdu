<?php

namespace App\Http\Controllers;

use App\Models\DataPosyandu;
use App\Models\PencatatanKunjungan;
use App\Models\Pendaftaran;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Data statistik dasar
        $data = [
            'stats' => [
                'total_pendaftaran' => Pendaftaran::count(),
                'total_balita' => Pendaftaran::where('jenis_sasaran', '2')->count(),
                'total_ibu_hamil' => Pendaftaran::where('jenis_sasaran', '1')->count(),
                'total_lansia' => Pendaftaran::where('jenis_sasaran', '3')->count(),
            ],
        ];

        // Gabungkan dengan data chart
        $data = array_merge($data, $this->prepareChartData());

        // Tambahkan data distribusi posyandu per jenis
        $data['posyanduData'] = [
            'ibu_hamil' => $this->getPosyanduDistribution('1'),
            'balita' => $this->getPosyanduDistribution('2'),
            'lansia' => $this->getPosyanduDistribution('3'),
            'all' => $this->getAllPosyanduDistribution()
        ];

        return view('dashboard.index', $data);
    }

    private function getAllPosyanduDistribution()
    {
        $posyandus = DataPosyandu::withCount(['pendaftaran'])
            ->orderBy('pendaftaran_count', 'desc')
            ->get();

        // Warna tetap untuk posyandu (maksimal 5 posyandu)
        $fixedColors = ['#FF0000', '#FFA500', '#008000', '#0000FF', '#800080'];

        return [
            'labels' => $posyandus->pluck('nama')->toArray(),
            'values' => $posyandus->pluck('pendaftaran_count')->toArray(),
            'colors' => array_slice($fixedColors, 0, count($posyandus))
        ];
    }

    private function getPosyanduDistribution($jenis_sasaran)
    {
        $posyandus = DataPosyandu::withCount([
            'pendaftaran' => function ($query) use ($jenis_sasaran) {
                $query->where('jenis_sasaran', $jenis_sasaran);
            }
        ])
            ->orderBy('pendaftaran_count', 'desc')
            ->get();

        // Warna tetap untuk posyandu (maksimal 5 posyandu)
        $fixedColors = ['#FF0000', '#FFA500', '#008000', '#0000FF', '#800080'];

        return [
            'labels' => $posyandus->pluck('nama')->toArray(),
            'values' => $posyandus->pluck('pendaftaran_count')->toArray(),
            'colors' => array_slice($fixedColors, 0, count($posyandus))
        ];
    }

    private function generateChartColors($count)
    {
        $colors = [];
        for ($i = 0; $i < $count; $i++) {
            $colors[] = '#' . substr(md5(rand()), 0, 6); // Generate random colors
        }
        return $colors;
    }

    private function getJenisSasaran($jenis)
    {
        return match ($jenis) {
            '1' => 'Ibu Hamil',
            '2' => 'Balita',
            '3' => 'Lansia',
            default => 'Tidak Diketahui',
        };
    }

    private function prepareChartData()
    {
        // Data untuk chart kunjungan bulanan per jenis
        $kunjunganBulanan = [
            '1' => $this->getMonthlyVisitsByType('1'),
            '2' => $this->getMonthlyVisitsByType('2'),
            '3' => $this->getMonthlyVisitsByType('3')
        ];

        // Data untuk chart distribusi pasien
        $pasienData = [
            'Balita' => Pendaftaran::where('jenis_sasaran', '2')->count(),
            'Ibu Hamil' => Pendaftaran::where('jenis_sasaran', '1')->count(),
            'Lansia' => Pendaftaran::where('jenis_sasaran', '3')->count(),
        ];

        return [
            'kunjunganData' => $kunjunganBulanan,
            'pasienData' => $pasienData,
            'pasienLabels' => array_keys($pasienData),
            'pasienValues' => array_values($pasienData),
        ];
    }

    private function getMonthlyVisitsByType($jenis_sasaran)
    {
        $monthlyData = PencatatanKunjungan::selectRaw('MONTH(waktu_pencatatan) as bulan, COUNT(*) as total')
            ->whereYear('waktu_pencatatan', date('Y'))
            ->whereHas('pencatatanAwal.pendaftaran', function ($query) use ($jenis_sasaran) {
                $query->where('jenis_sasaran', $jenis_sasaran);
            })
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        return $this->fillMonthlyData($monthlyData);
    }

    private function fillMonthlyData($monthlyData)
    {
        $filledData = [];
        for ($i = 1; $i <= 12; $i++) {
            $filledData[] = $monthlyData[$i] ?? 0;
        }
        return $filledData;
    }
}
