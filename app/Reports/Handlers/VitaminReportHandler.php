<?php

namespace App\Reports\Handlers;

use App\Models\DataVitamin;
use App\Models\PemberianVitamin;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class VitaminReportHandler extends BaseReportHandler
{
    public function handle(Request $request)
    {
        // Query utama dengan join ke pendaftaran
        $query = PemberianVitamin::with(['pendaftaran.posyandus'])
            ->join('pendaftarans', 'pemberian_vitamins.no_pendaftaran', '=', 'pendaftarans.id')
            ->select('pemberian_vitamins.*')
            ->whereBetween('pemberian_vitamins.waktu_pemberian', [$request->start_date, $request->end_date]);

        // Apply filters melalui relasi pendaftaran
        if ($request->posyandu_id && $request->posyandu_id != 'semua') {
            $query->where('pendaftarans.data_posyandu_id', $request->posyandu_id);
        }

        if ($request->jenis_sasaran && $request->jenis_sasaran != 'semua') {
            $query->where('pendaftarans.jenis_sasaran', $request->jenis_sasaran);
        }

        $data = $query->orderBy('pemberian_vitamins.waktu_pemberian')->get();
        $vitamins = DataVitamin::pluck('nama', 'id')->toArray();

        [$start, $end] = $this->formatDates($request->start_date, $request->end_date);

        $viewData = array_merge($this->getCommonViewData($request, $data, 'Laporan Pemberian Vitamin'), [
            'vitamins' => $vitamins
        ]);

        return [
            'view' => 'laporan.vitamin_pdf',
            'viewData' => $viewData,
            'filename' => "Laporan_Vitamin_{$start}_sd_{$end}.pdf"
        ];
    }
}
