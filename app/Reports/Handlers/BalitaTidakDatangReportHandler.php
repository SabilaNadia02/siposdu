<?php

namespace App\Reports\Handlers;

use App\Models\PencatatanAwal;
use Illuminate\Http\Request;

class BalitaTidakDatangReportHandler extends BaseReportHandler
{
    public function handle(Request $request)
    {
        // Query untuk mendapatkan balita aktif yang tidak memiliki catatan kunjungan dalam periode tertentu
        $query = PencatatanAwal::with(['pendaftaran.posyandus'])
            ->aktif() // Hanya balita dengan status_balita = 1 (aktif)
            ->tidakKunjung($request->start_date, $request->end_date) // Tidak ada kunjungan dalam periode
            ->whereHas('pendaftaran', function ($q) {
                $q->where('jenis_sasaran', 2); // Hanya untuk balita
            });

        // Filter berdasarkan posyandu
        if ($request->posyandu_id && $request->posyandu_id != 'semua') {
            $query->whereHas('pendaftaran', function ($q) use ($request) {
                $q->where('data_posyandu_id', $request->posyandu_id);
            });
        }

        $data = $query->orderBy('created_at')->get();

        [$start, $end] = $this->formatDates($request->start_date, $request->end_date);

        return [
            'view' => 'laporan.balita_tidak_datang_pdf',
            'viewData' => $this->getCommonViewData($request, $data, 'Laporan Balita Tidak Kunjung'),
            'filename' => "Laporan_Balita_Tidak_Kunjung_{$start}_sd_{$end}.pdf"
        ];
    }
}