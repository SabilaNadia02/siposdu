@extends('layouts.master')

@section('title', 'Detail Kunjungan Ibu Hamil')

@section('content')

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0" style="color: #333333; font-size: 1.5rem;">Detail Kunjungan Posyandu</h3>
                        <p style="color: #777777; font-size: 1rem;">Halaman ini untuk mengelola data detail pencatatan
                            kunjungan pada Balita.</p>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end align-items-center">
                        <a href="{{ route('pencatatan.balita.show', $kunjungan->id) }}"
                            class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="card shadow-sm" style="border-radius: 0px; border-top: 3px solid #007BFF;">
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
                                <th>Panjang Badan</th>
                                <td>{{ $detail_kunjungan->panjang_badan ?? '-' }} cm</td>
                            </tr>
                            <tr>
                                <th>Lingkar Lengan</th>
                                <td>{{ $detail_kunjungan->lingkar_lengan ?? '-' }} cm</td>
                            </tr>
                            <tr>
                                <th>Lingkar Kepala</th>
                                <td>{{ $detail_kunjungan->lingkar_kepala ?? '-' }} cm</td>
                            </tr>
                            <tr>
                                <th>ASI Eksklusif</th>
                                <td>{{ $detail_kunjungan->asi_eksklusif == 1 ? 'Ya' : ($detail_kunjungan->asi_eksklusif == 2 ? 'Tidak' : '-') }}
                                </td>
                            </tr>
                            <tr>
                                <th>MP ASI</th>
                                <td>{{ $detail_kunjungan->mp_asi == 1 ? 'Ya' : ($detail_kunjungan->mp_asi == 2 ? 'Tidak' : '-') }}
                                </td>
                            </tr>
                            <tr>
                                <th>MP Pangan Pemulihan</th>
                                <td>{{ $detail_kunjungan->mt_pangan_pemulihan == 1 ? 'Ya' : ($detail_kunjungan->mt_pangan_pemulihan == 2 ? 'Tidak' : '-') }}
                                </td>
                            </tr>
                            <tr>
                                <th>Catatan Kesehatan</th>
                                <td>{{ $detail_kunjungan->catatan_kesehatan ?? '-' }}</td>
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

@endsection
