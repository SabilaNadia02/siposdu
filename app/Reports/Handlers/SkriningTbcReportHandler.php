<?php

namespace App\Reports\Handlers;

use App\Models\PencatatanSkrining;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SkriningTbcReportHandler extends BaseReportHandler
{
    public function handle(Request $request)
    {
        // Query utama untuk skrining TBC
        $query = PencatatanSkrining::with([
            'pendaftaran.posyandus',
            'dataSkrining',
            'detailPencatatanSkrining.pertanyaanSkrining'
        ])
            ->whereHas('dataSkrining', function ($q) {
                $q->where('id_skrining', 1); // Spesifik untuk TBC
            })
            ->whereBetween('waktu_skrining', [
                Carbon::parse($request->start_date)->startOfDay(),
                Carbon::parse($request->end_date)->endOfDay()
            ]);

        // Filter spesifik untuk posyandu
        if ($request->posyandu_id && $request->posyandu_id !== 'semua') {
            $query->whereHas('pendaftaran', function ($q) use ($request) {
                $q->where('data_posyandu_id', $request->posyandu_id);
            });
        }

        // Filter spesifik untuk jenis sasaran
        if ($request->jenis_sasaran && $request->jenis_sasaran !== 'semua') {
            $query->whereHas('pendaftaran', function ($q) use ($request) {
                $q->where('jenis_sasaran', $request->jenis_sasaran);
            });
        }

        $data = $query->orderBy('waktu_skrining')->get();

        return [
            'view' => 'laporan.skrining_tbc_pdf',
            'viewData' => [
                'data' => $data,
                'title' => 'Laporan Skrining TBC',
                'startDate' => $request->start_date,
                'endDate' => $request->end_date,
                'posyanduFilter' => $request->posyandu_id == 'semua'
                    ? 'Semua Posyandu'
                    : (\App\Models\DataPosyandu::find($request->posyandu_id)->nama ?? 'Semua Posyandu'),
                'jenisSasaranFilter' => $request->jenis_sasaran == 'semua'
                    ? 'Semua Jenis Sasaran'
                    : ($this->jenisSasaranOptions[$request->jenis_sasaran] ?? 'Semua Jenis Sasaran'),
                'jenisSasaranOptions' => $this->jenisSasaranOptions,
            ],
            'filename' => "Laporan_Skrining_TBC_" .
                Carbon::parse($request->start_date)->format('d-m-Y') . "_sd_" .
                Carbon::parse($request->end_date)->format('d-m-Y') . ".pdf"
        ];
    }
}
