@extends('layouts.master')

@section('title', 'Detail Kunjungan Lansia')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0" style="color: #333333;">Detail Kunjungan Posyandu</h3>
                        <p style="color: #777777;">Halaman ini menampilkan detail data kunjungan Lansia.</p>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end align-items-center">
                        <a href="{{ route('pencatatan.lansia.show', $kunjungan->id) }}" class="btn btn-secondary">
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
                        <div class="card" style="border-top: 3px solid #FF8F00; border-radius: 0px">
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
                                        <p style="font-size: 1rem;">{{ $detail_kunjungan->berat_badan ?? '-' }} kg</p>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Tekanan Darah:</strong>
                                        <p style="font-size: 1rem;">
                                            {{ $detail_kunjungan->tekanan_darah_sistolik ?? '-' }}/{{ $detail_kunjungan->tekanan_darah_diastolik ?? '-' }}
                                            mmHg</p>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Lingkar Perut:</strong>
                                        <p style="font-size: 1rem;">{{ $detail_kunjungan->lingkar_perut ?? '-' }} cm</p>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Gula Darah:</strong>
                                        <p style="font-size: 1rem;">{{ $detail_kunjungan->gula_darah ?? '-' }} mg/dL</p>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Kolesterol:</strong>
                                        <p style="font-size: 1rem;">{{ $detail_kunjungan->kolestrol ?? '-' }} mg/dL</p>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Tes Mata (Kanan/Kiri):</strong>
                                        <p style="font-size: 1rem;">
                                            {{ $detail_kunjungan->tes_mata_kanan == 1 ? 'Normal (N)' : ($detail_kunjungan->tes_mata_kanan == 2 ? 'Tidak Normal (TN)' : '-') }}
                                            /
                                            {{ $detail_kunjungan->tes_mata_kiri == 1 ? 'Normal (N)' : ($detail_kunjungan->tes_mata_kiri == 2 ? 'Tidak Normal (TN)' : '-') }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Tes Telinga (Kanan/Kiri):</strong>
                                        <p style="font-size: 1rem;">
                                            {{ $detail_kunjungan->tes_telinga_kanan == 1 ? 'Normal (N)' : ($detail_kunjungan->tes_telinga_kanan == 2 ? 'Tidak Normal (TN)' : '-') }}
                                            /
                                            {{ $detail_kunjungan->tes_telinga_kiri == 1 ? 'Normal (N)' : ($detail_kunjungan->tes_telinga_kiri == 2 ? 'Tidak Normal (TN)' : '-') }}
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
