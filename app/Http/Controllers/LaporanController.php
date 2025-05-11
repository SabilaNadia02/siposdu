<?php

namespace App\Http\Controllers;

use App\Reports\Handlers\{
    BalitaTidakDatangReportHandler,
    ImunisasiReportHandler,
    KelulusanReportHandler,
    KunjunganReportHandler,
    ObatReportHandler,
    PendaftaranReportHandler,
    PencatatanReportHandler,
    RujukanReportHandler,
    SkriningPpokReportHandler,
    SkriningTbcReportHandler,
    VaksinReportHandler,
    VitaminReportHandler,
    BalitaStuntingReportHandler,
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\DataPosyandu;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    private $jenisSasaranOptions = [
        1 => 'Ibu Hamil',
        2 => 'Balita',
        3 => 'Usia Produktif dan Lansia'
    ];

    public function index()
    {
        $posyandus = DataPosyandu::all();
        return view('laporan.index', [
            'posyandus' => $posyandus,
            'jenisSasaranOptions' => $this->jenisSasaranOptions
        ]);
    }

    public function generatePDF(Request $request)
    {
        Log::info('Generate PDF Request:', $request->all());

        $request->validate([
            'jenis' => 'required|in:pendaftaran,pencatatan,kunjungan,imunisasi,vitamin,obat,vaksin,skrining,kelulusan,skrining_tbc,skrining_ppok,rujukan,balita_tidak_datang,balita_stunting,',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'posyandu_id' => 'nullable|string',
            'jenis_sasaran' => 'nullable|string'
        ]);

        try {
            $handler = $this->getReportHandler($request->jenis);
            $reportData = $handler->handle($request);

            $pdf = Pdf::loadView($reportData['view'], $reportData['viewData'])
                ->setPaper('a4', 'landscape');

            return $pdf->download($reportData['filename']);

        } catch (\Exception $e) {
            Log::error("Laporan PDF Gagal [{$request->jenis}]: " . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'Gagal menghasilkan laporan: ' . $e->getMessage());
        }
    }

    private function getReportHandler($jenis)
    {
        $handlers = [
            'pendaftaran' => new PendaftaranReportHandler(),
            'pencatatan' => new PencatatanReportHandler(),
            'kunjungan' => new KunjunganReportHandler(),
            'imunisasi' => new ImunisasiReportHandler(),
            'vitamin' => new VitaminReportHandler(),
            'obat' => new ObatReportHandler(),
            'vaksin' => new VaksinReportHandler(),
            'kelulusan' => new KelulusanReportHandler(),
            'skrining_tbc' => new SkriningTbcReportHandler(),
            'skrining_ppok' => new SkriningPpokReportHandler(),
            'rujukan' => new RujukanReportHandler(),
            'balita_tidak_datang' => new BalitaTidakDatangReportHandler(),
            'balita_stunting' => new BalitaStuntingReportHandler(),
        ];

        if (!isset($handlers[$jenis])) {
            throw new \InvalidArgumentException('Jenis laporan tidak valid');
        }

        return $handlers[$jenis];
    }
}
