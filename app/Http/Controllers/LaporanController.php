<?php

namespace App\Http\Controllers;

use App\Models\DataImunisasi;
use App\Models\DataObat;
use App\Models\DataPosyandu;
use App\Models\DataVaksin;
use App\Models\DataVitamin;
use App\Models\PemberianImunisasi;
use App\Models\PemberianObat;
use App\Models\PemberianVaksin;
use App\Models\PemberianVitamin;
use App\Models\PencatatanAwal;
use App\Models\PencatatanKunjungan;
use App\Models\PencatatanSkrining;
use App\Models\Pendaftaran;
use App\Models\Rujukan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LaporanController extends Controller
{
    public function index()
    {
        $posyandus = DataPosyandu::all();
        $jenisSasaranOptions = [
            1 => 'Ibu Hamil',
            2 => 'Balita',
            3 => 'Usia Produktif dan Lansia'
        ];

        return view('laporan.index', compact('posyandus', 'jenisSasaranOptions'));
    }

    public function generatePDF(Request $request)
    {
        // dd($request)->all();

        Log::info('Generate PDF Request:', $request->all());

        $request->validate([
            'jenis' => 'required|in:pendaftaran,pencatatan,kunjungan,imunisasi,vitamin,obat,vaksin,skrining,kelulusan,skrining_tbc,skrining_ppok,rujukan',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'posyandu_id' => 'nullable',
            'jenis_sasaran' => 'nullable'
        ]);

        try {
            $jenis = $request->jenis;
            $startDate = $request->start_date;
            $endDate = date('Y-m-d', strtotime($request->end_date . ' +1 day'));
            $posyanduId = $request->posyandu_id;
            $jenisSasaran = $request->jenis_sasaran;

            $data = [];
            $title = '';
            $view = '';
            $viewData = [];
            $jenisSasaranOptions = [
                1 => 'Ibu Hamil',
                2 => 'Balita',
                3 => 'Usia Produktif dan Lansia'
            ];

            switch ($jenis) {
                case 'pendaftaran':
                    $query = Pendaftaran::with(['posyandus'])
                        ->whereBetween('created_at', [$startDate, $endDate]);

                    if ($posyanduId && $posyanduId != 'semua') {
                        $query->where('data_posyandu_id', $posyanduId);
                    }

                    if ($jenisSasaran && $jenisSasaran != 'semua') {
                        $query->where('jenis_sasaran', $jenisSasaran);
                    }

                    $data = $query->orderBy('created_at')->get();
                    $title = 'Laporan Pendaftaran';
                    $view = 'laporan.pendaftaran_pdf';
                    break;

                case 'pencatatan':
                    $query = PencatatanAwal::with(['pendaftaran.posyandus'])
                        ->whereBetween('created_at', [$startDate, $endDate]);

                    if ($posyanduId && $posyanduId != 'semua') {
                        $query->whereHas('pendaftaran', function ($q) use ($posyanduId) {
                            $q->where('data_posyandu_id', $posyanduId);
                        });
                    }

                    if ($jenisSasaran && $jenisSasaran != 'semua') {
                        $query->whereHas('pendaftaran', function ($q) use ($jenisSasaran) {
                            $q->where('jenis_sasaran', $jenisSasaran);
                        });
                    }

                    $data = $query->orderBy('created_at')->get();
                    $title = 'Laporan Pencatatan Awal';
                    $view = 'laporan.pencatatanAwal_pdf';
                    break;

                case 'kunjungan':
                    $query = PencatatanKunjungan::with(['pencatatanAwal.pendaftaran.posyandus'])
                        ->whereBetween('waktu_pencatatan', [$startDate, $endDate]);

                    if ($posyanduId && $posyanduId != 'semua') {
                        $query->whereHas('pencatatanAwal.pendaftaran', function ($q) use ($posyanduId) {
                            $q->where('data_posyandu_id', $posyanduId);
                        });
                    }

                    if ($jenisSasaran && $jenisSasaran != 'semua') {
                        $query->whereHas('pencatatanAwal.pendaftaran', function ($q) use ($jenisSasaran) {
                            $q->where('jenis_sasaran', $jenisSasaran);
                        });
                    }

                    $data = $query->orderBy('waktu_pencatatan')->get();
                    $title = 'Laporan Kunjungan';
                    $view = 'laporan.kunjungan_pdf';
                    break;

                case 'imunisasi':
                    // Untuk laporan imunisasi, set jenis sasaran otomatis ke Balita (2)
                    $jenisSasaran = 2; // Override dengan nilai balita

                    $query = PemberianImunisasi::with(['pendaftaran', 'imunisasi'])
                        ->whereBetween('waktu_pemberian', [$startDate, $endDate]);

                    if ($posyanduId && $posyanduId != 'semua') {
                        $query->whereHas('pendaftaran', function ($q) use ($posyanduId) {
                            $q->where('data_posyandu_id', $posyanduId);
                        });
                    }

                    // Selalu filter untuk balita saja
                    $query->whereHas('pendaftaran', function ($q) {
                        $q->where('jenis_sasaran', 2); // Hanya balita
                    });

                    $data = $query->orderBy('waktu_pemberian')->get();
                    $title = 'Laporan Pemberian Imunisasi';
                    $view = 'laporan.imunisasi_pdf';
                    break;

                case 'vitamin':
                    // Biarkan jenis sasaran sesuai input user (tidak dioverride)
                    $query = PemberianVitamin::with(['pendaftaran', 'pendaftaran.posyandus'])
                        ->whereBetween('waktu_pemberian', [$startDate, $endDate]);

                    if ($posyanduId && $posyanduId != 'semua') {
                        $query->whereHas('pendaftaran', function ($q) use ($posyanduId) {
                            $q->where('data_posyandu_id', $posyanduId);
                        });
                    }

                    if ($jenisSasaran && $jenisSasaran != 'semua') {
                        $query->whereHas('pendaftaran', function ($q) use ($jenisSasaran) {
                            $q->where('jenis_sasaran', $jenisSasaran);
                        });
                    }

                    $data = $query->orderBy('waktu_pemberian')->get();
                    $vitamins = DataVitamin::pluck('nama', 'id')->toArray();
                    $title = 'Laporan Pemberian Vitamin';
                    $view = 'laporan.vitamin_pdf';
                    $viewData = [
                        'data' => $data,
                        'vitamins' => $vitamins,
                        'jenisSasaranOptions' => $jenisSasaranOptions,
                    ];
                    break;

                case 'obat':
                    $query = PemberianObat::with(['pendaftaran', 'obat'])
                        ->whereBetween('waktu_pemberian', [$startDate, $endDate]);

                    if ($posyanduId && $posyanduId != 'semua') {
                        $query->whereHas('pendaftaran', function ($q) use ($posyanduId) {
                            $q->where('data_posyandu_id', $posyanduId);
                        });
                    }

                    if ($jenisSasaran && $jenisSasaran != 'semua') {
                        $query->whereHas('pendaftaran', function ($q) use ($jenisSasaran) {
                            $q->where('jenis_sasaran', $jenisSasaran);
                        });
                    }

                    $data = $query->orderBy('waktu_pemberian')->get();
                    $obats = DataObat::pluck('nama', 'id')->toArray();
                    $title = 'Laporan Pemberian Obat';
                    $view = 'laporan.obat_pdf';
                    $viewData = [
                        'data' => $data,
                        'obats' => $obats,
                        'jenisSasaranOptions' => $jenisSasaranOptions,
                    ];
                    break;

                case 'vaksin':
                    $query = PemberianVaksin::with(['pendaftaran', 'vaksin'])
                        ->whereBetween('waktu_pemberian', [$startDate, $endDate]);

                    if ($posyanduId && $posyanduId != 'semua') {
                        $query->whereHas('pendaftaran', function ($q) use ($posyanduId) {
                            $q->where('data_posyandu_id', $posyanduId);
                        });
                    }

                    if ($jenisSasaran && $jenisSasaran != 'semua') {
                        $query->whereHas('pendaftaran', function ($q) use ($jenisSasaran) {
                            $q->where('jenis_sasaran', $jenisSasaran);
                        });
                    }

                    $data = $query->orderBy('waktu_pemberian')->get();
                    $vaksins = DataVaksin::pluck('nama', 'id')->toArray();
                    $title = 'Laporan Pemberian Vaksin';
                    $view = 'laporan.vaksin_pdf';
                    $viewData = [
                        'data' => $data,
                        'vaksins' => $vaksins,
                        'jenisSasaranOptions' => $jenisSasaranOptions,
                    ];
                    break;

                case 'kelulusan':
                    // Hanya untuk balita
                    $jenisSasaran = 2;

                    $query = PencatatanAwal::with(['pendaftaran.posyandus'])
                        ->where('status_balita', PencatatanAwal::STATUS_LULUS) // Status lulus
                        ->whereBetween('created_at', [$startDate, $endDate]);

                    if ($posyanduId && $posyanduId != 'semua') {
                        $query->whereHas('pendaftaran', function ($q) use ($posyanduId) {
                            $q->where('data_posyandu_id', $posyanduId);
                        });
                    }

                    // Filter untuk balita saja
                    $query->whereHas('pendaftaran', function ($q) {
                        $q->where('jenis_sasaran', 2);
                    });

                    $data = $query->orderBy('created_at')->get();
                    $title = 'Laporan Kelulusan Balita';
                    $view = 'laporan.kelulusan_pdf';

                    // Logging untuk debugging
                    \Log::info('Laporan Kelulusan - Data Count: ' . $data->count());
                    \Log::info('Query: ' . $query->toSql());
                    \Log::info('Parameters: ', $query->getBindings());
                    break;

                case 'skrining_tbc':
                    $query = PencatatanSkrining::with(['pendaftaran', 'dataSkrining', 'detailPencatatanSkrining.pertanyaanSkrining'])
                        ->whereHas('dataSkrining', function ($q) {
                            $q->where('jenis_skrining', 'TBC'); // Filter hanya skrining TBC
                        })
                        ->whereBetween('waktu_skrining', [$startDate, $endDate]);

                    if ($posyanduId && $posyanduId != 'semua') {
                        $query->whereHas('pendaftaran', function ($q) use ($posyanduId) {
                            $q->where('data_posyandu_id', $posyanduId);
                        });
                    }

                    if ($jenisSasaran && $jenisSasaran != 'semua') {
                        $query->whereHas('pendaftaran', function ($q) use ($jenisSasaran) {
                            $q->where('jenis_sasaran', $jenisSasaran);
                        });
                    }

                    $data = $query->orderBy('waktu_skrining')->get();
                    $title = 'Laporan Skrining TBC';
                    $view = 'laporan.skrining_tbc_pdf';
                    break;

                case 'skrining_ppok':
                    $query = PencatatanSkrining::with(['pendaftaran', 'dataSkrining', 'detailPencatatanSkrining.pertanyaanSkrining'])
                        ->whereHas('dataSkrining', function ($q) {
                            $q->where('jenis_skrining', 'PPOK'); // Filter hanya skrining PPOK
                        })
                        ->whereBetween('waktu_skrining', [$startDate, $endDate]);

                    if ($posyanduId && $posyanduId != 'semua') {
                        $query->whereHas('pendaftaran', function ($q) use ($posyanduId) {
                            $q->where('data_posyandu_id', $posyanduId);
                        });
                    }

                    if ($jenisSasaran && $jenisSasaran != 'semua') {
                        $query->whereHas('pendaftaran', function ($q) use ($jenisSasaran) {
                            $q->where('jenis_sasaran', $jenisSasaran);
                        });
                    }

                    $data = $query->orderBy('waktu_skrining')->get();
                    $title = 'Laporan Skrining PPOK';
                    $view = 'laporan.skrining_ppok_pdf';
                    break;

                case 'rujukan':
                    $query = Rujukan::with(['pendaftaran'])
                        ->whereBetween('waktu_rujukan', [$startDate, $endDate]);

                    if ($posyanduId && $posyanduId != 'semua') {
                        $query->whereHas('pendaftaran', function ($q) use ($posyanduId) {
                            $q->where('data_posyandu_id', $posyanduId);
                        });
                    }

                    if ($jenisSasaran && $jenisSasaran != 'semua') {
                        $query->whereHas('pendaftaran', function ($q) use ($jenisSasaran) {
                            $q->where('jenis_sasaran', $jenisSasaran);
                        });
                    }

                    $data = $query->orderBy('waktu_rujukan')->get();
                    $title = 'Laporan Rujukan';
                    $view = 'laporan.rujukan_pdf';
                    break;

                default:
                    return redirect()->back()->with('error', 'Jenis laporan tidak valid');
            }

            $start = date('d-m-Y', strtotime($startDate));
            $end = date('d-m-Y', strtotime($endDate . ' -1 day'));

            $viewData = array_merge($viewData, [
                'data' => $data,
                'title' => $title,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'posyanduFilter' => $posyanduId == 'semua' ? 'Semua Posyandu' : DataPosyandu::find($posyanduId)->nama ?? 'Semua Posyandu',
                'jenisSasaranFilter' => $jenisSasaran == 'semua' ? 'Semua Jenis Sasaran' : ($jenisSasaranOptions[$jenisSasaran] ?? 'Semua Jenis Sasaran'),
                'jenisSasaranOptions' => $jenisSasaranOptions,
            ]);

            // dd($data);

            // return view($view, $viewData);

            $pdf = Pdf::loadView($view, $viewData)
                ->setPaper('a4', 'landscape');

            // if ($data->count() === 0) {
            //     \Log::info("Laporan {$title} - Tidak ada data ditemukan");
            // }

            return $pdf->download("Laporan_{$title}_{$start}_sd_{$end}.pdf");

        } catch (\Exception $e) {
            Log::error("Laporan PDF Gagal [{$request->jenis}]: " . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'Gagal menghasilkan laporan: ' . $e->getMessage());
        } catch (\Throwable $t) {
            Log::critical("Throwable Error saat Generate PDF [{$request->jenis}]: " . $t->getMessage(), ['trace' => $t->getTraceAsString()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan fatal: ' . $t->getMessage());
        }
    }
}