<?php

namespace App\Reports\Handlers;

use App\Models\DataPosyandu;
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
}
