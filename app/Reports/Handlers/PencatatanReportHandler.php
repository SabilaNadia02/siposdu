<?php

namespace App\Reports\Handlers;

use App\Models\PencatatanAwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PencatatanReportHandler extends BaseReportHandler
{
    public function handle(Request $request)
    {
        try {
            // Log request untuk debugging
            Log::info('Generating Pencatatan Report', [
                'request' => $request->all(),
                'filters' => [
                    'posyandu_id' => $request->posyandu_id,
                    'jenis_sasaran' => $request->jenis_sasaran,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date
                ]
            ]);

            $query = PencatatanAwal::with(['pendaftaran', 'pendaftaran.posyandus'])
                ->whereHas('pendaftaran', function ($q) use ($request) {
                    // Fix: Changed 'pendaftaran.created_at' to 'pendaftarans.created_at'
                    $q->whereBetween('pendaftarans.created_at', [
                        $request->start_date . ' 00:00:00',
                        $request->end_date . ' 23:59:59'
                    ]);

                    // Filter jenis sasaran
                    if ($request->filled('jenis_sasaran') && $request->jenis_sasaran != 'semua') {
                        $q->where('jenis_sasaran', $request->jenis_sasaran);
                    }
                });

            // Filter posyandu
            if ($request->filled('posyandu_id') && $request->posyandu_id != 'semua') {
                $query->whereHas('pendaftaran.posyandus', function ($q) use ($request) {
                    $q->where('data_posyandu_id', $request->posyandu_id);
                });
            }

            $data = $query->orderBy('created_at')->get();

            // Log hasil query
            Log::info('Pencatatan Report Data', [
                'count' => $data->count(),
                'first_item' => $data->first() ? $data->first()->toArray() : null
            ]);

            [$start, $end] = $this->formatDates($request->start_date, $request->end_date);

            return [
                'view' => 'laporan.pencatatan_pdf',
                'viewData' => $this->getCommonViewData($request, $data, 'Laporan Pencatatan Awal') + [
                    'request' => $request 
                ],
                'filename' => "Laporan_Pencatatan_Awal_{$start}_sd_{$end}.pdf"
            ];

        } catch (\Exception $e) {
            Log::error('Error generating Pencatatan Report: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            throw $e;
        }
    }
}
