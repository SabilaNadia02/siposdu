<?php

namespace App\Reports\Handlers;

use App\Models\PencatatanAwal;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use DateTime;

class BalitaTidakDatangReportHandler extends BaseReportHandler
{
    public function handle(Request $request)
    {
        $jenisSasaran = $request->jenis_sasaran ?? '2';

        $query = PencatatanAwal::with(['pendaftaran.posyandus'])
            ->aktif()
            ->tidakKunjung($request->start_date, $request->end_date, $jenisSasaran != 'semua' ? $jenisSasaran : null);

        if ($request->posyandu_id && $request->posyandu_id != 'semua') {
            $query->whereHas('pendaftaran', function ($q) use ($request) {
                $q->where('data_posyandu_id', $request->posyandu_id);
            });
        }

        $data = $query->orderBy('created_at')->get();

        // Capture the request start_date for use in the closure
        $startDate = $request->start_date;

        // Generate WhatsApp messages for each item
        $data->each(function ($item) use ($startDate) {
            $pendaftaran = $item->pendaftaran;
            $namaPosyandu = $pendaftaran->posyandus->nama ?? 'Posyandu';
            $bulanPeriode = date('F Y', strtotime($startDate));
            $namaIbu = $item->nama_ibu ?? 'Bunda';

            $item->whatsapp_message = $this->generateWhatsAppMessage(
                $pendaftaran->jenis_sasaran,
                $pendaftaran,
                $namaPosyandu,
                $bulanPeriode,
                $item->nama_ibu ?? null
            );
        });

        [$start, $end] = $this->formatDates($request->start_date, $request->end_date);
        $title = $this->getReportTitle($jenisSasaran);

        return [
            'view' => 'laporan.balita_tidak_datang_pdf',
            'viewData' => $this->getCommonViewData($request, $data, $title),
            'filename' => "Laporan_Peserta_Tidak_Kunjung_{$start}_sd_{$end}.pdf"
        ];
    }

    protected function getReportTitle($jenisSasaran)
    {
        $titles = [
            1 => 'Laporan Ibu Hamil Tidak Datang',
            2 => 'Laporan Balita Tidak Datang',
            3 => 'Laporan Usia Produktif & Lansia Tidak Datang'
        ];

        return $titles[$jenisSasaran] ?? 'Laporan Peserta Tidak Kunjung';
    }
}
