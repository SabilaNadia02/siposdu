<?php

namespace App\Reports\Handlers;

use App\Models\DataObat;
use App\Models\PemberianObat;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class ObatReportHandler extends BaseReportHandler
{
    public function handle(Request $request)
    {
        // Query utama dengan join ke pendaftaran
        $query = PemberianObat::with(['pendaftaran.posyandus'])
            ->join('pendaftarans', 'pemberian_obats.no_pendaftaran', '=', 'pendaftarans.id')
            ->select('pemberian_obats.*')
            ->whereBetween('pemberian_obats.waktu_pemberian', [$request->start_date, $request->end_date]);

        // Apply filters melalui relasi pendaftaran
        if ($request->posyandu_id && $request->posyandu_id != 'semua') {
            $query->where('pendaftarans.data_posyandu_id', $request->posyandu_id);
        }

        if ($request->jenis_sasaran && $request->jenis_sasaran != 'semua') {
            $query->where('pendaftarans.jenis_sasaran', $request->jenis_sasaran);
        }

        $data = $query->orderBy('pemberian_obats.waktu_pemberian')->get();
        $obats = DataObat::pluck('nama', 'id')->toArray();

        [$start, $end] = $this->formatDates($request->start_date, $request->end_date);

        $viewData = array_merge($this->getCommonViewData($request, $data, 'Laporan Pemberian Obat'), [
            'obats' => $obats
        ]);

        return [
            'view' => 'laporan.obat_pdf',
            'viewData' => $viewData,
            'filename' => "Laporan_Obat_{$start}_sd_{$end}.pdf"
        ];
    }
}
