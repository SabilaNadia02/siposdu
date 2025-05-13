<?php

namespace App\Reports\Handlers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PendaftaranReportHandler extends BaseReportHandler
{
    public function handle(Request $request)
    {
        // Tambahkan logging untuk debugging
        Log::debug('Pendaftaran Report Parameters:', [
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'posyandu_id' => $request->posyandu_id,
            'jenis_sasaran' => $request->jenis_sasaran
        ]);

        $query = Pendaftaran::with(['posyandus'])
            ->whereDate('created_at', '>=', $request->start_date)
            ->whereDate('created_at', '<=', $request->end_date);

        $query = $this->applyCommonFilters($query, $request);

        // Log SQL query sebelum eksekusi
        Log::debug('Pendaftaran Report SQL:', ['sql' => $query->toSql()]);

        $data = $query->orderBy('created_at')->get();

        // Log hasil query
        Log::debug('Pendaftaran Report Results:', [
            'count' => $data->count(),
            'first_item' => $data->first() ? $data->first()->toArray() : null
        ]);

        [$start, $end] = $this->formatDates($request->start_date, $request->end_date);

        return [
            'view' => 'laporan.pendaftaran_pdf',
            'viewData' => $this->getCommonViewData($request, $data, 'Laporan Pendaftaran'),
            'filename' => "Laporan_Pendaftaran_{$start}_sd_{$end}.pdf"
        ];
    }
}
