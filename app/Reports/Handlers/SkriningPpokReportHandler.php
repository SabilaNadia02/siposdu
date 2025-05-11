<?php

namespace App\Reports\Handlers;

use App\Models\PencatatanSkrining;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SkriningPpokReportHandler extends BaseReportHandler
{
    public function handle(Request $request)
    {
        // Query utama untuk skrining PPOK
        $query = PencatatanSkrining::with([
            'pendaftaran.posyandus',
            'dataSkrining',
            'detailPencatatanSkrining.pertanyaanSkrining'
        ])
            ->whereHas('dataSkrining', function ($q) {
                $q->where('id_skrining', 2); // Spesifik untuk PPOK
            })
            ->whereHas('pendaftaran', function ($q) {
                $q->where('jenis_sasaran', 3); // Hanya untuk jenis sasaran 3 (Usia Produktif dan Lansia)
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

        // Hapus filter jenis sasaran karena sudah di-hardcode ke 3
        $data = $query->orderBy('waktu_skrining')->get();

        return [
            'view' => 'laporan.skrining_ppok_pdf',
            'viewData' => [
                'data' => $data,
                'title' => 'Laporan Skrining PPOK (Usia Produktif dan Lansia)',
                'startDate' => $request->start_date,
                'endDate' => $request->end_date,
                'posyanduFilter' => $request->posyandu_id == 'semua'
                    ? 'Semua Posyandu'
                    : (\App\Models\DataPosyandu::find($request->posyandu_id)->nama ?? 'Semua Posyandu'),
                'jenisSasaranFilter' => 'Usia Produktif dan Lansia', // Hardcode karena hanya untuk jenis ini
                'jenisSasaranOptions' => $this->jenisSasaranOptions,
            ],
            'filename' => "Laporan_Skrining_PPOK_Usia_Produktif_Lansia_" .
                Carbon::parse($request->start_date)->format('d-m-Y') . "_sd_" .
                Carbon::parse($request->end_date)->format('d-m-Y') . ".pdf"
        ];
    }
}
