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
            ->whereDate('updated_at', '>=', $request->start_date)
            ->whereDate('updated_at', '<=', $request->end_date)
            ->whereHas('pendaftaran', function ($q) {
                $q->where('jenis_sasaran', 2); // Hanya balita
            });

        // Apply Posyandu filter if specified
        if ($request->posyandu_id && $request->posyandu_id != 'semua') {
            $query->whereHas('pendaftaran', function ($q) use ($request) {
                $q->where('data_posyandu_id', $request->posyandu_id);
            });
        }

        // Tambahkan logging untuk debugging
        Log::debug('Kelulusan Report Query:', [
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'posyandu_id' => $request->posyandu_id,
            'sql' => $query->toSql()
        ]);

        $data = $query->orderBy('updated_at')->get();

        // Log hasil query
        Log::debug('Kelulusan Report Results:', [
            'count' => $data->count(),
            'first_item' => $data->first() ? $data->first()->toArray() : null
        ]);

        [$start, $end] = $this->formatDates($request->start_date, $request->end_date);

        return [
            'view' => 'laporan.kelulusan_pdf',
            'viewData' => $this->getCommonViewData($request, $data, 'Laporan Kelulusan Balita'),
            'filename' => "Laporan_Kelulusan_Balita_{$start}_sd_{$end}.pdf"
        ];
    }
}
