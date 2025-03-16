@extends('layouts.master')

@section('title', 'Detail Pencatatan Balita')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0" style="color: #333333; font-size: 1.5rem;">Pencatatan Kunjungan Posyandu</h3>
                        <p style="color: #777777; font-size: 1rem;">Halaman ini untuk mengelola data pencatatan kunjungan
                            pada Balita.</p>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end align-items-center">
                        <a href="{{ route('pencatatan.balita.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="card shadow-sm" style="border-radius: 0px; border-top: 3px solid #28A745;">
                    <div class="card-header">
                        <!-- Tab navigation -->
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item me-2">
                                <button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1"
                                    type="button" role="tab">
                                    Data Pencatatan Awal
                                </button>
                            </li>
                            <li class="nav-item me-2">
                                <button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2"
                                    type="button" role="tab">
                                    Riwayat Kunjungan
                                </button>
                            </li>
                            <li class="nav-item me-2">
                                <button class="nav-link" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab3"
                                    type="button" role="tab">
                                    Grafik Pertumbuhan Balita
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">

                            <!-- Tab 1: Data Pencatatan Awal -->
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>No Pendaftaran</th>
                                        <td>{{ str_pad(optional($data->pendaftaran)->id, 4, '0', STR_PAD_LEFT) ?? '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Nama</th>
                                        <td>{{ optional($data->pendaftaran)->nama ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Usia</th>
                                        <td>
                                            @php
                                                $lahir = \Carbon\Carbon::parse($data->pendaftaran->tanggal_lahir);
                                                $sekarang = \Carbon\Carbon::now();
                                                $usia = $lahir->diff($sekarang);
                                            @endphp
                                            {{ $usia->y }} tahun, {{ $usia->m }} bulan,
                                            {{ $usia->d }} hari
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Nama Ibu</th>
                                        <td>{{ $data->nama_ibu ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Ayah</th>
                                        <td>{{ $data->nama_ayah ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Berat Badan Lahir</th>
                                        <td>{{ $data->berat_badan_lahir ?? '-' }} kg</td>
                                    </tr>
                                    <tr>
                                        <th>Panjang Badan Lahir</th>
                                        <td>{{ $data->panjang_badan_lahir ?? '-' }} cm</td>
                                    </tr>
                                </table>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('pencatatan.balita.edit', $data->id) }}"
                                        class="btn btn-success mt-2">
                                        <i class="fas fa-edit"></i> Edit Data
                                    </a>
                                </div>
                            </div>

                            <!-- Tab 2: Riwayat Kunjungan -->
                            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                                <h4 class="mb-0">Riwayat Penimbangan, Pengukuran, dan Pemeriksaan</h4>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <p>Data riwayat penimbangan, pengukuran, dan pemeriksaan Balita.</p>
                                    <button type="button" class="btn btn-success btn-sm ms-auto text-light"
                                        data-bs-toggle="modal" data-bs-target="#tambahKunjunganBaruModal">
                                        <i class="bi bi-plus"></i> Tambah Data
                                    </button>
                                </div>
                                @include('pencatatan.balita.modal.tambah_kunjungan_baru')

                                @if ($data->pencatatanKunjungan->isEmpty())
                                    <p class="text-muted">Belum ada riwayat kunjungan.</p>
                                @else
                                    <table class="table table-bordered">
                                        <thead class="table-success">
                                            <tr>
                                                <th style="width: 150px;">Usia (bulan)</th>
                                                <th style="width: 150px;">Tanggal Kunjungan</th>
                                                <th style="width: 100px;">Berat Badan</th>
                                                <th style="width: 100px;">Panjang Badan</th>
                                                <th style="width: 100px;">Lingkar Lengan</th>
                                                <th style="width: 100px;">Lingkar Kepala</th>
                                                <th style="width: 120px;">ASI Eksklusif</th>
                                                <th style="width: 120px;">MP ASI</th>
                                                <th style="width: 120px;">MT Pangan Pemulihan</th>
                                                <th style="width: 120px;">Catatan Kesehatan</th>
                                                <th style="width: 200px;">Keluhan</th>
                                                <th style="width: 200px;">Edukasi</th>
                                                <th class="text-center" style="width: 100px;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data->pencatatanKunjungan as $kunjungan)
                                                <tr>
                                                    <td>
                                                        {{ (int) \Carbon\Carbon::parse($kunjungan->pencatatanAwal->pendaftaran->tanggal_lahir)->diffInMonths(
                                                            \Carbon\Carbon::parse($kunjungan->waktu_pencatatan),
                                                        ) }}
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($kunjungan->waktu_pencatatan)->translatedFormat('j F Y') }}
                                                    </td>
                                                    <td>{{ $kunjungan->berat_badan ?? '-' }}
                                                        kg</td>
                                                    <td>{{ $kunjungan->panjang_badan ?? '-' }}
                                                        cm</td>
                                                    <td>{{ $kunjungan->lingkar_lengan ?? '-' }}
                                                        cm</td>
                                                    <td>{{ $kunjungan->lingkar_kepala ?? '-' }}
                                                        cm</td>
                                                    <td>{{ $kunjungan->asi_eksklusif == 1 ? 'Ya' : ($kunjungan->asi_eksklusif == 2 ? 'Tidak' : '-') }}
                                                    </td>
                                                    <td>{{ $kunjungan->mp_asi == 1 ? 'Ya' : ($kunjungan->mp_asi == 2 ? 'Tidak' : '-') }}
                                                    </td>
                                                    <td>{{ $kunjungan->mt_pangan_pemulihan == 1 ? 'Ya' : ($kunjungan->mt_pangan_pemulihan == 2 ? 'Tidak' : '-') }}
                                                    </td>
                                                    <td>{{ $kunjungan->catatan_kesehatan ?? '-' }}
                                                    </td>
                                                    <td>{{ $kunjungan->keluhan ?? '-' }}
                                                    </td>
                                                    <td>{{ $kunjungan->edukasi ?? '-' }}
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('pencatatan.balita.kunjungan.show', [$data->id, $kunjungan->id]) }}"
                                                            class="btn btn-info btn-sm" title="Lihat"
                                                            style="width: 20px; height: 20px; font-size: 10px; padding: 1px;">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('pencatatan.balita.kunjungan.edit', [$data->id, $kunjungan->id]) }}"
                                                            class="btn btn-warning btn-sm" title="Edit"
                                                            style="width: 20px; height: 20px; font-size: 10px; padding: 1px;">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form
                                                            action="{{ route('pencatatan.balita.kunjungan.destroy', [$data->id, $kunjungan->id]) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm btn-hapus"
                                                                title="Hapus"
                                                                style="width: 20px; height: 20px; font-size: 10px; padding: 1px;"
                                                                onclick="return confirm('Yakin ingin menghapus?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>

                            <!-- Tab 3: Grafik Pertumbuhan Balita -->
                            <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                                <h5>Grafik Pertumbuhan Balita</h5>
                                <p>Grafik pertumbuhan balita berdasarkan data yang tersedia.</p>

                                <!--begin::Row-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Kategori</th>
                                                            <th>Keterangan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th>
                                                                < -3 SD</th>
                                                            <td>Sangat Kurus</td>
                                                        </tr>
                                                        <tr>
                                                            <th>-3 SD sampai dengan < -2 SD</th>
                                                            <td>Kurus</td>
                                                        </tr>
                                                        <tr>
                                                            <th>-2 SD sampai dengan 2 SD</th>
                                                            <td>Normal</td>
                                                        </tr>
                                                        <tr>
                                                            <th>> 2 SD</th>
                                                            <td>Gemuk</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!--end::Row-->

                                <!--begin::Row-->
                                <div class="row">
                                    <!-- Start col -->
                                    <div class="col-lg-12">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <h5 class="card-title">Grafik pertumbuhan Sejak Lahir - 2 Tahun (z-scores)
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <div id="revenue-chart"></div>
                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <!-- /.Start col -->
                                </div>
                                <!--end::Row-->

                                <!--begin::Row-->
                                <div class="row">
                                    <!-- Start col -->
                                    <div class="col-lg-12">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <h5 class="card-title">Grafik pertumbuhan 2 Tahun - 5 Tahun (z-scores)</h5>
                                            </div>
                                            <div class="card-body">
                                                <div id="revenue-chart"></div>
                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <!-- /.Start col -->
                                </div>
                                <!--end::Row-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <style>
        /* Styling untuk table dan padding */
        table.table th,
        table.table td {
            padding: 10px;
        }

        table.table th {
            text-align: left;
            width: 35%;
        }

        /* Styling untuk tombol tab */
        .nav-tabs .nav-link {
            border-radius: 4px;
            border: 1px solid #ddd;
            color: #333;
            transition: all 0.3s ease;
            padding: 10px 20px;
            font-weight: 500;
            background: #f8f9fa;
        }

        /* Styling untuk tab yang aktif */
        .nav-tabs .nav-link.active {
            background-color: #28A745 !important;
            color: #fff !important;
            border-color: #28A745 !important;
        }

        /* Hover effect */
        .nav-tabs .nav-link:hover {
            color: #28A745 !important;
        }

        /* Menghilangkan border bawah tab */
        .nav-tabs {
            border-bottom: none;
        }
    </style>
@endsection
