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
                    $q->whereBetween('waktu_pencatatan', [$request->start_date, $request->end_date])
                      ->orderBy('waktu_pencatatan', 'desc');
                }
            ])
            ->whereHas('pendaftaran', function($q) {
                $q->where('jenis_sasaran', 2); // Hanya balita
            });

        if ($request->posyandu_id && $request->posyandu_id != 'semua') {
            $query->whereHas('pendaftaran', function($q) use ($request) {
                $q->where('data_posyandu_id', $request->posyandu_id);
            });
        }

        $data = $query->orderBy('created_at')->get();
        
        // Hitung status stunting untuk setiap data
        foreach ($data as $item) {
            $latestKunjungan = $item->pencatatanKunjungan->first();
            if ($latestKunjungan && $item->pendaftaran->tanggal_lahir) {
                $usiaBulan = $item->getAgeInMonths();
                $item->stunting_status = $item->calculateStuntingStatus(
                    $latestKunjungan->panjang_badan,
                    $usiaBulan,
                    $item->pendaftaran->jenis_kelamin
                );
            }
        }

        // Filter hanya yang stunting
        $data = $data->filter(function($item) {
            return isset($item->stunting_status) && 
                   in_array($item->stunting_status, ['Stunted', 'Severely Stunted']);
        });

        [$start, $end] = $this->formatDates($request->start_date, $request->end_date);

        return [
            'view' => 'laporan.balita_stunting_pdf',
            'viewData' => $this->getCommonViewData($request, $data, 'Laporan Balita Stunting'),
            'filename' => "Laporan_Balita_Stunting_{$start}_sd_{$end}.pdf"
        ];
    }
}
