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
                            kunjungan pada Ibu Hamil.</p>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end align-items-center">
                        <a href="{{ route('pencatatan.ibu.show', $data->id, $kunjungan->id) }}"
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
                                <th>Lingkar Lengan</th>
                                <td>{{ $detail_kunjungan->lingkar_lengan ?? '-' }} cm</td>
                            </tr>
                            <tr>
                                <th>Tekanan Darah</th>
                                <td>{{ $detail_kunjungan->tekanan_darah_sistolik ?? '-' }}/{{ $kunjungan->tekanan_darah_diastolik ?? '-' }}
                                    mmHg</td>
                            </tr>
                            <tr>
                                <th>Pemberian MT Bumil KEK</th>
                                <td>{{ $detail_kunjungan->mt_bumil_kek == 1 ? 'Ya' : ($kunjungan->mt_bumil_kek == 2 ? 'Tidak' : '-') }}
                                </td>
                            </tr>
                            <tr>
                                <th>Mengikuti Kelas Ibu Hamil</th>
                                <td>{{ $detail_kunjungan->kelas_ibu_hamil == 1 ? 'Ya' : ($kunjungan->kelas_ibu_hamil == 2 ? 'Tidak' : '-') }}
                                </td>
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
