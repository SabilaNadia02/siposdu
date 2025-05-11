<?php

namespace App\Reports\Handlers;

use App\Models\PencatatanKunjungan;
use Illuminate\Http\Request;

class KunjunganReportHandler extends BaseReportHandler
{
    public function handle(Request $request)
    {
        $query = PencatatanKunjungan::with(['pencatatanAwal.pendaftaran.posyandus'])
            ->whereBetween('waktu_pencatatan', [$request->start_date, $request->end_date]);

        if ($request->posyandu_id && $request->posyandu_id != 'semua') {
            $query->whereHas('pencatatanAwal.pendaftaran', function ($q) use ($request) {
                $q->where('data_posyandu_id', $request->posyandu_id);
            });
        }

        if ($request->jenis_sasaran && $request->jenis_sasaran != 'semua') {
            $query->whereHas('pencatatanAwal.pendaftaran', function ($q) use ($request) {
                $q->where('jenis_sasaran', $request->jenis_sasaran);
            });
        }

        $data = $query->orderBy('waktu_pencatatan')->get();
        [$start, $end] = $this->formatDates($request->start_date, $request->end_date);

        return [
            'view' => 'laporan.kunjungan_pdf',
            'viewData' => $this->getCommonViewData($request, $data, 'Laporan Kunjungan'),
            'filename' => "Laporan_Kunjungan_{$start}_sd_{$end}.pdf"
        ];
    }
}
