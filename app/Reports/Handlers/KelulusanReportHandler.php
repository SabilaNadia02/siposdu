<?php

namespace App\Reports\Handlers;

use App\Models\PencatatanAwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KelulusanReportHandler extends BaseReportHandler
{
    public function handle(Request $request)
    {
        $query = PencatatanAwal::with(['pendaftaran.posyandus'])
            ->where('status_balita', PencatatanAwal::STATUS_LULUS)
            ->whereBetween('created_at', [$request->start_date, $request->end_date])
            ->whereHas('pendaftaran', function ($q) {
                $q->where('jenis_sasaran', 2); // Hanya balita
            });

        if ($request->posyandu_id && $request->posyandu_id != 'semua') {
            $query->whereHas('pendaftaran', function ($q) use ($request) {
                $q->where('data_posyandu_id', $request->posyandu_id);
            });
        }

        $data = $query->orderBy('created_at')->get();
        [$start, $end] = $this->formatDates($request->start_date, $request->end_date);

        // Logging untuk debugging
        Log::info('Laporan Kelulusan - Data Count: ' . $data->count());

        return [
            'view' => 'laporan.kelulusan_pdf',
            'viewData' => $this->getCommonViewData($request, $data, 'Laporan Kelulusan Balita'),
            'filename' => "Laporan_Kelulusan_Balita_{$start}_sd_{$end}.pdf"
        ];
    }
}
