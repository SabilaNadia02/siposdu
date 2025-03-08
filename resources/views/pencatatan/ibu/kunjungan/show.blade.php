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
                        <a href="{{ route('pencatatan.ibu.show', $kunjungan->id) }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="card shadow-sm border-top-primary">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Tanggal Kunjungan</th>
                                <td>{{ \Carbon\Carbon::parse($kunjungan->waktu_pencatatan)->translatedFormat('j F Y') }}
                                </td>
                            </tr>
                            @if ($kunjungan->detailPencatatanKunjungan->isNotEmpty())
                                @foreach ($kunjungan->detailPencatatanKunjungan as $detail)
                                    <tr>
                                        <th>Berat Badan</th>
                                        <td>{{ $detail->berat_badan ?? '-' }} kg</td>
                                    </tr>
                                    <tr>
                                        <th>Lingkar Lengan</th>
                                        <td>{{ $detail->lingkar_lengan ?? '-' }} cm</td>
                                    </tr>
                                    <tr>
                                        <th>Tekanan Darah</th>
                                        <td>{{ $detail->tekanan_darah_sistolik ?? '-' }}/{{ $detail->tekanan_darah_diastolik ?? '-' }}
                                            mmHg</td>
                                    </tr>
                                    <tr>
                                        <th>Keluhan</th>
                                        <td>{{ $detail->keluhan ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Edukasi</th>
                                        <td>{{ $detail->edukasi ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="2" class="text-center">Tidak ada data kunjungan</td>
                                </tr>
                            @endif
                        </table>

                        {{-- <a href="{{ route('pencatatan.ibu.index') }}" class="btn btn-secondary">Kembali</a>
                    <a href="{{ route('pencatatan.ibu.kunjungan.edit', $kunjungan->id) }}" class="btn btn-warning">Edit</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- <main class="app-main">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5>Detail Kunjungan</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Tanggal Kunjungan</th>
                            <td>{{ \Carbon\Carbon::parse($kunjungan->waktu_pencatatan)->translatedFormat('j F Y') }}</td>
                        </tr>

                        @if ($kunjungan->detailPencatatanKunjungan->isNotEmpty())
                            @foreach ($kunjungan->detailPencatatanKunjungan as $detail)
                                <tr>
                                    <th>Berat Badan</th>
                                    <td>{{ $detail->berat_badan ?? '-' }} kg</td>
                                </tr>
                                <tr>
                                    <th>Lingkar Lengan</th>
                                    <td>{{ $detail->lingkar_lengan ?? '-' }} cm</td>
                                </tr>
                                <tr>
                                    <th>Tekanan Darah</th>
                                    <td>{{ $detail->tekanan_darah_sistolik ?? '-' }}/{{ $detail->tekanan_darah_diastolik ?? '-' }}
                                        mmHg</td>
                                </tr>
                                <tr>
                                    <th>Keluhan</th>
                                    <td>{{ $detail->keluhan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Edukasi</th>
                                    <td>{{ $detail->edukasi ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <hr>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="2" class="text-center">Tidak ada data kunjungan</td>
                            </tr>
                        @endif
                    </table>

                    <a href="{{ route('pencatatan.ibu.index') }}" class="btn btn-secondary">Kembali</a>
                    <a href="{{ route('pencatatan.ibu.kunjungan.edit', $kunjungan->id) }}" class="btn btn-warning">Edit</a>
                </div>
            </div>
        </div>
    </main> --}}
@endsection
