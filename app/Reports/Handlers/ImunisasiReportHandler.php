<?php

namespace App\Reports\Handlers;

use App\Models\PemberianImunisasi;
use Illuminate\Http\Request;

class ImunisasiReportHandler extends BaseReportHandler
{
    public function handle(Request $request)
    {
        $query = PemberianImunisasi::with(['pendaftaran', 'imunisasi'])
            ->whereBetween('waktu_pemberian', [$request->start_date, $request->end_date])
            ->whereHas('pendaftaran', function ($q) {
                $q->where('jenis_sasaran', 2); // Hanya balita
            });

        if ($request->posyandu_id && $request->posyandu_id != 'semua') {
            $query->whereHas('pendaftaran', function ($q) use ($request) {
                $q->where('data_posyandu_id', $request->posyandu_id);
            });
        }

        $data = $query->orderBy('waktu_pemberian')->get();
        [$start, $end] = $this->formatDates($request->start_date, $request->end_date);

        return [
            'view' => 'laporan.imunisasi_pdf',
            'viewData' => $this->getCommonViewData($request, $data, 'Laporan Pemberian Imunisasi'),
            'filename' => "Laporan_Imunisasi_{$start}_sd_{$end}.pdf"
        ];
    }
}
