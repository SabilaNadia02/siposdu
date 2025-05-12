<?php

namespace App\Reports\Handlers;

use App\Models\PencatatanAwal;
use Illuminate\Http\Request;

class BalitaWastingReportHandler extends BaseReportHandler
{
    public function handle(Request $request)
    {
        $query = PencatatanAwal::with([
            'pendaftaran.posyandus',
            'pencatatanKunjungan' => function ($q) use ($request) {
                $q->whereBetween('waktu_pencatatan', [$request->start_date, $request->end_date])
                    ->orderBy('waktu_pencatatan', 'desc');
            }
        ])
            ->whereHas('pendaftaran', function ($q) {
                $q->where('jenis_sasaran', 2); // Hanya balita
            });

        if ($request->posyandu_id && $request->posyandu_id != 'semua') {
            $query->whereHas('pendaftaran', function ($q) use ($request) {
                $q->where('data_posyandu_id', $request->posyandu_id);
            });
        }

        $data = $query->orderBy('created_at')->get();

        // Hitung status wasting untuk setiap data
        foreach ($data as $item) {
            $latestKunjungan = $item->pencatatanKunjungan->first();
            if ($latestKunjungan) {
                $item->wasting_status = $item->calculateWastingStatus(
                    $latestKunjungan->berat_badan,
                    $latestKunjungan->panjang_badan,
                    $item->pendaftaran->jenis_kelamin
                );
            }
        }

        // Filter hanya yang wasting
        $data = $data->filter(function ($item) {
            return isset($item->wasting_status) &&
                in_array($item->wasting_status, ['Wasted', 'Severely Wasted']);
        });

        [$start, $end] = $this->formatDates($request->start_date, $request->end_date);

        return [
            'view' => 'laporan.balita_wasting_pdf',
            'viewData' => $this->getCommonViewData($request, $data, 'Laporan Balita Wasting'),
            'filename' => "Laporan_Balita_Wasting_{$start}_sd_{$end}.pdf"
        ];
    }
}
