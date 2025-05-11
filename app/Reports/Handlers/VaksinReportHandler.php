<?php

namespace App\Reports\Handlers;

use App\Models\DataVaksin;
use App\Models\PemberianVaksin;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class VaksinReportHandler extends BaseReportHandler
{
    public function handle(Request $request)
    {
        // Query utama dengan join ke pendaftaran
        $query = PemberianVaksin::with(['pendaftaran.posyandus'])
            ->join('pendaftarans', 'pemberian_vaksins.no_pendaftaran', '=', 'pendaftarans.id')
            ->select('pemberian_vaksins.*')
            ->whereBetween('pemberian_vaksins.waktu_pemberian', [$request->start_date, $request->end_date]);

        // Apply filters melalui relasi pendaftaran
        if ($request->posyandu_id && $request->posyandu_id != 'semua') {
            $query->where('pendaftarans.data_posyandu_id', $request->posyandu_id);
        }

        if ($request->jenis_sasaran && $request->jenis_sasaran != 'semua') {
            $query->where('pendaftarans.jenis_sasaran', $request->jenis_sasaran);
        }

        $data = $query->orderBy('pemberian_vaksins.waktu_pemberian')->get();
        $vaksins = DataVaksin::pluck('nama', 'id')->toArray();

        [$start, $end] = $this->formatDates($request->start_date, $request->end_date);

        $viewData = array_merge($this->getCommonViewData($request, $data, 'Laporan Pemberian Vaksin'), [
            'vaksins' => $vaksins
        ]);

        return [
            'view' => 'laporan.vaksin_pdf',
            'viewData' => $viewData,
            'filename' => "Laporan_Vaksin_{$start}_sd_{$end}.pdf"
        ];
    }
}
