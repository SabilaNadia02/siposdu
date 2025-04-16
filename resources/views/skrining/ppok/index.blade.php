@extends('layouts.master')

@section('title', 'Skrining PPOK')

@section('content')
    <!--begin::App Main-->
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0" style="color: #333333;">Skrining PPOK</h3>
                        <p style="color: #777777;">Halaman ini untuk mengelola data Skrining PPOK peserta posyandu.</p>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="#" style="color: #FF8F00; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Skrining PPOK</li>
                        </ol>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content Header-->

        <!--begin::App Content-->
        <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row justify-content-center">
                    <!--begin::Col-->
                    <div class="col-lg-4 col-md-6 col-12">
                        <!--begin::Small Box Widget 1-->
                        <div class="small-box text-dark text-center" style="background-color: #FFF3E0; border-radius: 2px;">
                            <div class="inner">
                                <h3>{{ $totalDenganGejala }}</h3>
                                <p>Total Dengan Gejala (Skor > 6)</p>
                            </div>
                        </div>
                        <!--end::Small Box Widget 1-->
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-lg-4 col-md-6 col-12">
                        <!--begin::Small Box Widget 2-->
                        <div class="small-box text-dark text-center" style="background-color: #FFF3E0; border-radius: 2px;">
                            <div class="inner">
                                <h3>{{ $totalTanpaGejala }}</h3>
                                <p>Total Tanpa Gejala (Skor ≤ 6)</p>
                            </div>
                        </div>
                        <!--end::Small Box Widget 2-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

                {{-- <!--begin::Row-->
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <div class="float-sm">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" id="searchPeserta"
                                    placeholder="Cari nama peserta..." style="border-radius: 2px;">
                                <span class="input-group-text" style="border-radius: 2px; color: #FF8F00;">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Row--> --}}

                <!--begin::Row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4" style="border-radius: 0px;">
                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="border-top: 3px solid #FF8F00; border-radius: 0px;">
                                <h3 class="card-title">Tabel Data Skrining PPOK</h3>
                                <button type="button" class="btn btn-sm ms-auto text-light"
                                    style="background-color: #FF8F00;" data-bs-toggle="modal"
                                    data-bs-target="#tambahSkringPPOKModal">
                                    Tambah Skrining PPOK
                                </button>
                            </div>
                            @include('skrining.ppok.modal.tambah_skrining_ppok')
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered" id="ppokTable">
                                    <thead>
                                        <tr>
                                            <th style="width: 50px; text-align: center">No</th>
                                            <th style="width: 120px;">Waktu Skrining</th>
                                            <th style="width: 200px;">Nama Peserta</th>
                                            <th style="width: 250px;">Pertanyaan</th>
                                            <th style="width: 80px; text-align: center">Skor</th>
                                            <th style="width: 100px; text-align: center">Total Skor</th>
                                            <th style="width: 100px; text-align: center">Diagnosa</th>
                                            <th style="width: 120px; text-align: center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($skriningPPOK as $skrining)
                                            @php
                                                $totalSkor = 0;
                                                $detailSkor = [];

                                                foreach ($skrining->detailPencatatanSkrining as $detail) {
                                                    $pertanyaanId = $detail->pertanyaanSkrining->id;
                                                    $jawaban = $detail->hasil_skrining;
                                                    $skor = 0;

                                                    switch ($pertanyaanId) {
                                                        case 5: // Jenis Kelamin
                                                            $skor = $jawaban == 1 ? 1 : 0;
                                                            break;
                                                        case 6: // Usia
                                                            if ($jawaban >= 60) {
                                                                $skor = 2;
                                                            } elseif ($jawaban >= 50) {
                                                                $skor = 1;
                                                            }
                                                            break;
                                                        case 7: // Merokok
                                                            if ($jawaban == 3) {
                                                                // 20-30 bungkus/tahun
                                                                $skor = 1;
                                                            } elseif ($jawaban == 4) {
                                                                // >=30 bungkus/tahun
                                                                $skor = 2;
                                                            }
                                                            break;
                                                        case 8: // Nafas pendek
                                                        case 9: // Dahak dari paru
                                                        case 10: // Batuk tanpa flu
                                                        case 11: // Pemeriksaan spirometri
                                                            $skor = $jawaban == 1 ? 1 : 0;
                                                            break;
                                                    }

                                                    $totalSkor += $skor;
                                                    $detailSkor[$detail->id] = $skor;
                                                }

                                                $diagnosa = $totalSkor > 6 ? 'Ya' : 'Tidak';
                                                $rowspan = $skrining->detailPencatatanSkrining->count();
                                            @endphp

                                            @foreach ($skrining->detailPencatatanSkrining as $index => $detail)
                                                <tr class="participant-row" data-participant-id="{{ $skrining->id }}">
                                                    @if ($index === 0)
                                                        <td rowspan="{{ $rowspan }}" style="text-align: center">
                                                            {{ $loop->parent->iteration }}</td>
                                                        <td rowspan="{{ $rowspan }}">
                                                            {{ date('d/m/Y', strtotime($skrining->waktu_skrining)) }}</td>
                                                        <td rowspan="{{ $rowspan }}" class="participant-name">
                                                            {{ $skrining->pendaftaran->nama }}</td>
                                                    @endif

                                                    <td>{{ $detail->pertanyaanSkrining->dataPertanyaan->nama_pertanyaan ?? 'N/A' }}
                                                    </td>
                                                    <td style="text-align: center">
                                                        {{ $detailSkor[$detail->id] ?? 0 }}
                                                    </td>

                                                    @if ($index === 0)
                                                        <td rowspan="{{ $rowspan }}" style="text-align: center">
                                                            <strong>{{ $totalSkor }}</strong>
                                                        </td>
                                                        <td rowspan="{{ $rowspan }}" style="text-align: center">
                                                            <span
                                                                class="badge {{ $diagnosa == 'Ya' ? 'bg-danger' : 'bg-success' }}">
                                                                {{ $diagnosa }}
                                                            </span>
                                                        </td>

                                                        <td rowspan="{{ $rowspan }}" style="text-align: center">
                                                            <div class="btn-group">
                                                                <a href="{{ route('skrining.ppok.edit', $skrining->id) }}"
                                                                    class="btn btn-warning btn-sm" title="Edit"
                                                                    style="width: 20px; height: 20px; font-size: 10px; padding: 1px; display: flex; justify-content: center; align-items: center; margin-right: 5px;">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <form
                                                                    action="{{ route('skrining.ppok.destroy', $skrining->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                                        title="Hapus"
                                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                                                                        style="width: 20px; height: 20px; font-size: 10px; padding: 1px; display: flex; justify-content: center; align-items: center;">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix" style="background-color: white">
                                <ul class="pagination pagination-sm m-0 float-end">
                                    @if ($skriningPPOK->onFirstPage())
                                        <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link"
                                                style="background-color: #FF8F00; color: white; border: none;"
                                                href="{{ $skriningPPOK->previousPageUrl() }}">&laquo;</a></li>
                                    @endif
                                    @for ($i = 1; $i <= $skriningPPOK->lastPage(); $i++)
                                        <li class="page-item {{ $skriningPPOK->currentPage() == $i ? 'active' : '' }}">
                                            <a class="page-link"
                                                style="background-color: {{ $skriningPPOK->currentPage() == $i ? '#FF8F00' : 'white' }}; color: {{ $skriningPPOK->currentPage() == $i ? 'white' : '#FF8F00' }}; border: none;"
                                                href="{{ $skriningPPOK->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    @if ($skriningPPOK->hasMorePages())
                                        <li class="page-item"><a class="page-link"
                                                style="background-color: #FF8F00; color: white; border: none;"
                                                href="{{ $skriningPPOK->nextPageUrl() }}">&raquo;</a></li>
                                    @else
                                        <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
            <!--end::Row-->
        </div>
    </main>
    <!--end::App Main-->

    <script>
        $(document).ready(function() {
            $('#searchPeserta').on('input', function() {
                const searchTerm = $(this).val().toLowerCase().trim();

                if (searchTerm === '') {
                    // Jika pencarian kosong, tampilkan semua baris
                    $('tbody tr').show();
                    return;
                }

                // Sembunyikan semua baris terlebih dahulu
                $('tbody tr').hide();

                // Cari baris yang sesuai dengan kriteria pencarian
                $('tbody tr').each(function() {
                    const row = $(this);
                    const participantName = row.find('.participant-name').text().toLowerCase();

                    // Jika baris ini adalah baris utama (memiliki class participant-name)
                    if (participantName.includes(searchTerm)) {
                        const participantId = row.data('participant-id');

                        // Tampilkan semua baris dengan participant-id yang sama
                        $(`tr[data-participant-id="${participantId}"]`).show();
                    }
                });
            });
        });
    </script>

    <style>
        .float-sm-end {
            float: right !important;
        }

        .input-group {
            width: 250px;
        }

        /* Style untuk hasil pencarian */
        .highlight {
            background-color: yellow;
            font-weight: bold;
        }
    </style>
@endsection