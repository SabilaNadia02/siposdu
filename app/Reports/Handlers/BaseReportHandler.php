<?php

namespace App\Reports\Handlers;

use App\Models\DataPosyandu;
use DateTime;
use Illuminate\Http\Request;

abstract class BaseReportHandler
{
    protected $jenisSasaranOptions = [
        1 => 'Ibu Hamil',
        2 => 'Balita',
        3 => 'Usia Produktif dan Lansia'
    ];

    abstract public function handle(Request $request);

    protected function applyCommonFilters($query, Request $request)
    {
        if ($request->posyandu_id && $request->posyandu_id != 'semua') {
            $query->where('data_posyandu_id', $request->posyandu_id);
        }

        if ($request->jenis_sasaran && $request->jenis_sasaran != 'semua') {
            $query->where('jenis_sasaran', $request->jenis_sasaran);
        }

        return $query;
    }

    protected function formatDates($startDate, $endDate)
    {
        $start = date('d-m-Y', strtotime($startDate));
        $end = date('d-m-Y', strtotime($endDate . ' -1 day'));
        return [$start, $end];
    }

    protected function getCommonViewData(Request $request, $data, $title)
    {
        $posyanduId = $request->posyandu_id;
        $jenisSasaran = $request->jenis_sasaran;

        return [
            'data' => $data,
            'title' => $title,
            'startDate' => $request->start_date,
            'endDate' => $request->end_date,
            'posyanduFilter' => $posyanduId == 'semua' ? 'Semua Posyandu' : DataPosyandu::find($posyanduId)->nama ?? 'Semua Posyandu',
            'jenisSasaranFilter' => $jenisSasaran == 'semua' ? 'Semua Jenis Sasaran' : ($this->jenisSasaranOptions[$jenisSasaran] ?? 'Semua Jenis Sasaran'),
            'jenisSasaranOptions' => $this->jenisSasaranOptions,
        ];
    }

    protected function generateWhatsAppMessage($jenisSasaran, $pendaftaran, $namaPosyandu, $bulanPeriode, $namaIbu = null)
    {
        switch ($jenisSasaran) {
            case 1: // Ibu Hamil
                $nama = $pendaftaran->nama;
                return "$namaPosyandu - Pemberitahuan Kunjungan Posyandu\n\n" .
                    "Yth. Bunda $nama,\n\n" .
                    "Kami dari $namaPosyandu mencatat bahwa Bunda belum hadir dalam kegiatan Posyandu untuk pemeriksaan kehamilan bulan $bulanPeriode.\n\n" .
                    "Kami mengingatkan pentingnya pemeriksaan rutin kehamilan demi menjaga kesehatan Bunda dan janin. Silakan hadir ke Posyandu atau hubungi petugas jika ada kendala.\n\n" .
                    "Terima kasih atas perhatian Bunda.\n\n" .
                    "Salam sehat,\n" .
                    "Tim $namaPosyandu";

            case 2: // Balita
                $namaIbu = $namaIbu ?? 'Bunda';
                $namaBalita = $pendaftaran->nama ?? 'Ananda';
                return "$namaPosyandu - Pemberitahuan Kunjungan Posyandu\n\n" .
                    "Yth. Bunda $namaIbu,\n\n" .
                    "Kami dari $namaPosyandu ingin menginformasikan bahwa berdasarkan data kunjungan terakhir, ananda $namaBalita belum hadir dalam kegiatan Posyandu bulan $bulanPeriode.\n\n" .
                    "Kami mengajak Bunda untuk membawa ananda ke Posyandu agar tumbuh kembangnya dapat terus dipantau dan mendapatkan layanan kesehatan yang dibutuhkan.\n\n" .
                    "Jika Bunda berhalangan hadir, silakan hubungi kader Posyandu atau petugas setempat untuk informasi lebih lanjut.\n\n" .
                    "Terima kasih atas perhatian dan kerja samanya.\n\n" .
                    "Salam sehat,\n" .
                    "Tim $namaPosyandu";

            case 3: // Usia Produktif & Lansia
                $nama = $pendaftaran->nama;
                $usia = (new DateTime($pendaftaran->tanggal_lahir))->diff(new DateTime())->y;
                $gender = $pendaftaran->jenis_kelamin == 1 ? 'Bapak' : 'Ibu';

                if ($usia >= 60) {
                    // Lansia
                    return "$namaPosyandu - Pemberitahuan Kunjungan Posyandu\n\n" .
                        "Yth. $gender $nama,\n\n" .
                        "Kami dari $namaPosyandu mencatat bahwa $gender belum hadir dalam kegiatan Posyandu lansia bulan $bulanPeriode.\n\n" .
                        "Pemeriksaan kesehatan rutin sangat penting untuk menjaga kondisi tubuh dan mencegah penyakit di usia lanjut. Kami mengundang $gender untuk hadir pada jadwal berikutnya.\n\n" .
                        "Salam hormat dan sehat selalu,\n" .
                        "Tim $namaPosyandu";
                } else {
                    // Usia Produktif
                    return "$namaPosyandu - Pemberitahuan Kunjungan Posyandu\n\n" .
                        "Yth. $nama,\n\n" .
                        "Kami dari $namaPosyandu ingin menginformasikan bahwa Anda belum hadir dalam kegiatan Posyandu bulan $bulanPeriode untuk kelompok usia produktif.\n\n" .
                        "Pemeriksaan berkala membantu mendeteksi risiko penyakit sejak dini dan menjaga kualitas hidup Anda. Silakan datang ke Posyandu atau hubungi petugas bila ada kendala.\n\n" .
                        "Terima kasih atas perhatian Anda.\n\n" .
                        "Salam sehat,\n" .
                        "Tim $namaPosyandu";
                }

            default:
                return "Pemberitahuan Kunjungan Posyandu";
        }
    }
}
