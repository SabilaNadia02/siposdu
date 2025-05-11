<?php

namespace App\Reports\Handlers;

use App\Models\PencatatanAwal;
use Illuminate\Http\Request;

class BalitaStuntingReportHandler extends BaseReportHandler
{
    public function handle(Request $request)
    {
        $query = PencatatanAwal::with([
                'pendaftaran.posyandus', 
                'pencatatanKunjungan' => function($q) use ($request) {
                    $q->where('mt_pangan_pemulihan', 1) // Status stunting
                      ->whereBetween('waktu_pencatatan', [$request->start_date, $request->end_date])
                      ->orderBy('waktu_pencatatan', 'desc');
                }
            ])
            ->whereHas('pencatatanKunjungan', function($q) use ($request) {
                $q->where('mt_pangan_pemulihan', 1)
                  ->whereBetween('waktu_pencatatan', [$request->start_date, $request->end_date]);
            })
            ->whereHas('pendaftaran', function($q) {
                $q->where('jenis_sasaran', 2); // Hanya balita
            });

        if ($request->posyandu_id && $request->posyandu_id != 'semua') {
            $query->whereHas('pendaftaran', function($q) use ($request) {
                $q->where('data_posyandu_id', $request->posyandu_id);
            });
        }

        $data = $query->orderBy('created_at')->get();
        [$start, $end] = $this->formatDates($request->start_date, $request->end_date);

        return [
            'view' => 'laporan.balita_stunting_pdf',
            'viewData' => $this->getCommonViewData($request, $data, 'Laporan Balita Stunting'),
            'filename' => "Laporan_Balita_Stunting_{$start}_sd_{$end}.pdf"
        ];
    }
}
