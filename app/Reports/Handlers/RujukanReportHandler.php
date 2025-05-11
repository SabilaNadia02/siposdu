<?php

namespace App\Reports\Handlers;

use App\Models\Rujukan;
use Illuminate\Http\Request;

class RujukanReportHandler extends BaseReportHandler
{
    public function handle(Request $request)
    {
        // Query utama untuk rujukan
        $query = Rujukan::with(['pendaftaran.posyandus'])
            ->whereBetween('waktu_rujukan', [
                $request->start_date,
                $request->end_date
            ]);

        // Filter berdasarkan posyandu
        if ($request->posyandu_id && $request->posyandu_id != 'semua') {
            $query->whereHas('pendaftaran', function ($q) use ($request) {
                $q->where('data_posyandu_id', $request->posyandu_id);
            });
        }

        // Filter berdasarkan jenis sasaran
        if ($request->jenis_sasaran && $request->jenis_sasaran != 'semua') {
            $query->whereHas('pendaftaran', function ($q) use ($request) {
                $q->where('jenis_sasaran', $request->jenis_sasaran);
            });
        }

        $data = $query->orderBy('waktu_rujukan')->get();

        return [
            'view' => 'laporan.rujukan_pdf',
            'viewData' => $this->getCommonViewData($request, $data, 'Laporan Rujukan'),
            'filename' => "Laporan_Rujukan_" .
                date('d-m-Y', strtotime($request->start_date)) . "_sd_" .
                date('d-m-Y', strtotime($request->end_date)) . ".pdf"
        ];
    }
}
