@extends('layouts.master')

@section('title', 'Detail Kunjungan Ibu Hamil')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0" style="color: #333333;">Detail Kunjungan Posyandu</h3>
                        <p style="color: #777777;">Halaman ini menampilkan detail data kunjungan Ibu Hamil.</p>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end align-items-center">
                        <a href="{{ route('pencatatan.ibu.show', $kunjungan->id) }}" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-8" style="border-radius: 0px">
                        <div class="card" style="border-top: 3px solid #007BFF; border-radius: 0px">
                            <div class="card-body" style="border-radius: 0px">
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <strong>Tanggal Kunjungan:</strong>
                                        <p style="font-size: 1rem;">
                                            {{ \Carbon\Carbon::parse($detail_kunjungan->waktu_pencatatan)->translatedFormat('j F Y') }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Berat Badan:</strong>
                                        <p style="font-size: 1rem;">{{ $data->berat_badan ?? '-' }} kg</p>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Lingkar Lengan:</strong>
                                        <p style="font-size: 1rem;">{{ $detail_kunjungan->lingkar_lengan ?? '-' }} cm</p>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Tekanan Darah:</strong>
                                        <p style="font-size: 1rem;">
                                            {{ $detail_kunjungan->tekanan_darah_sistolik ?? '-' }}/{{ $detail_kunjungan->tekanan_darah_diastolik ?? '-' }}
                                            mmHg</p>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Pemberian MT Bumil KEK:</strong>
                                        <p style="font-size: 1rem;">
                                            {{ $detail_kunjungan->mt_bumil_kek == 1 ? 'Ya' : ($detail_kunjungan->mt_bumil_kek == 2 ? 'Tidak' : '-') }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Mengikuti Kelas Ibu Hamil:</strong>
                                        <p style="font-size: 1rem;">
                                            {{ $detail_kunjungan->kelas_ibu_hamil == 1 ? 'Ya' : ($detail_kunjungan->kelas_ibu_hamil == 2 ? 'Tidak' : '-') }}
                                        </p>
                                    </div>
                                    <div class="col-12">
                                        <strong>Keluhan:</strong>
                                        <p class="text-wrap" style="font-size: 1rem;">
                                            {{ $detail_kunjungan->keluhan ?? '-' }}</p>
                                    </div>
                                    <div class="col-12">
                                        <strong>Edukasi:</strong>
                                        <p class="text-wrap" style="font-size: 1rem;">
                                            {{ $detail_kunjungan->edukasi ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
