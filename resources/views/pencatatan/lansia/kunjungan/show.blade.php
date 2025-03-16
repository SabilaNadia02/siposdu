@extends('layouts.master')

@section('title', 'Detail Kunjungan Lansia')

@section('content')

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0" style="color: #333333; font-size: 1.5rem;">Detail Kunjungan Posyandu</h3>
                        <p style="color: #777777; font-size: 1rem;">Halaman ini untuk mengelola data detail pencatatan
                            kunjungan pada usia subur atau lansia.</p>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end align-items-center">
                        <a href="{{ route('pencatatan.lansia.show', $kunjungan->id) }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="card shadow-sm" style="border-radius: 0px; border-top: 3px solid #FF8F00;">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Tanggal Kunjungan</th>
                                <td>{{ \Carbon\Carbon::parse($detail_kunjungan->waktu_pencatatan)->translatedFormat('j F Y') }}
                                </td>
                            </tr>
                            <tr>
                                <th>Berat Badan</th>
                                <td>{{ $detail_kunjungan->berat_badan ?? '-' }} kg</td>
                            </tr>
                            <tr>
                                <th>Tinggi Badan</th>
                                <td>{{ $detail_kunjungan->tinggi_badan ?? '-' }} cm</td>
                            </tr>
                            <tr>
                                <th style="width: 120px;">Tekanan Darah</th>
                                <td>{{ $detail_kunjungan->tekanan_darah_sistolik ?? '-' }}/{{ $detail_kunjungan->tekanan_darah_diastolik ?? '-' }}
                                    mmHg</td>
                            </tr>
                            <tr>
                                <th style="width: 100px;">Lingkar Perut</th>
                                <td>{{ $detail_kunjungan->lingkar_perut ?? '-' }} cm
                            </tr>
                            <tr>
                                <th style="width: 100px;">Gula Darah</th>
                                <td>{{ $detail_kunjungan->gula_darah ?? '-' }} mg/dL
                            </tr>
                            <tr>
                                <th style="width: 100px;">Kolestrol</th>
                                <td>{{ $detail_kunjungan->kolestrol ?? '-' }} mg/dL
                            </tr>
                            <tr>
                                <th style="width: 100px;">Tes Mata (Kanan/Kiri)</th>
                                <td>{{ $detail_kunjungan->tes_mata_kanan == 1 ? 'Normal (N)' : ($detail_kunjungan->tes_mata_kanan == 2 ? 'Tidak Normal (TN)' : '-') }}
                                    /
                                    {{ $detail_kunjungan->tes_mata_kiri == 1 ? 'Normal (N)' : ($detail_kunjungan->tes_mata_kiri == 2 ? 'Tidak Normal (TN)' : '-') }}
                            </tr>
                            <tr>
                                <th style="width: 100px;">Tes Telinga (Kanan/Kiri)</th>
                                <td>{{ $detail_kunjungan->tes_telinga_kanan == 1 ? 'Normal (N)' : ($detail_kunjungan->tes_telinga_kanan == 2 ? 'Tidak Normal (TN)' : '-') }}
                                    /
                                    {{ $detail_kunjungan->tes_telinga_kanan == 1 ? 'Normal (N)' : ($detail_kunjungan->tes_telinga_kiri == 2 ? 'Tidak Normal (TN)' : '-') }}
                            </tr>
                            <tr>
                                <th>Keluhan</th>
                                <td>{{ $detail_kunjungan->keluhan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Edukasi</th>
                                <td>{{ $detail_kunjungan->edukasi ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <style>
        .table th {
            width: 500px;
        }
    </style>

@endsection
