<?php

namespace App\Reports\Handlers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranReportHandler extends BaseReportHandler
{
    public function handle(Request $request)
    {
        $query = Pendaftaran::with(['posyandus'])
            ->whereBetween('created_at', [$request->start_date, $request->end_date]);

        $query = $this->applyCommonFilters($query, $request);
        $data = $query->orderBy('created_at')->get();

        [$start, $end] = $this->formatDates($request->start_date, $request->end_date);

        return [
            'view' => 'laporan.pendaftaran_pdf',
            'viewData' => $this->getCommonViewData($request, $data, 'Laporan Pendaftaran'),
            'filename' => "Laporan_Pendaftaran_{$start}_sd_{$end}.pdf"
        ];
    }
}
