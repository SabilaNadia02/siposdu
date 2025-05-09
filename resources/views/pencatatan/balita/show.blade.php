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
                <div class="card shadow-sm" style="border-radius: 0px; border-top: 3px solid #198754;">
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

                        @foreach (['success' => 'success', 'error' => 'danger'] as $msg => $type)
                            @if (session($msg))
                                <div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
                                    {{ session($msg) }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        @endforeach

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
                                    <button type="button" class="btn btn-sm text-light ms-auto"
                                        style="background-color: #198754;" data-bs-toggle="modal"
                                        data-bs-target="#tambahKunjunganBaruModal">
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
                                                <th style="width: 200px;">Keluhan</th>
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
                                                    <td>{{ $kunjungan->keluhan ?? '-' }}
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
                                                                style="width: 20px; height: 20px; font-size: 10px; padding: 1px;"
                                                                title="Hapus">
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

                            <!-- Di bagian Tab 3: Grafik Pertumbuhan Balita -->
                            <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                                @php
                                    $growthData = app(
                                        'App\Http\Controllers\PencatatanBalitaController',
                                    )->generateGrowthChartData($data->id);
                                @endphp

                                <!-- Status Pertumbuhan Terkini -->
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div class="card border-success">
                                            <div class="card-header bg-success text-white">
                                                <h5 class="card-title mb-0">Status Pertumbuhan Terkini</h5>
                                            </div>
                                            <div class="card-body">
                                                @if ($growthData['latestData'])
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="card mb-3">
                                                                <div class="card-header text-dark"
                                                                    style="background-color: #e9ffe9;">
                                                                    <i class="fas fa-weight"></i> Berat Badan
                                                                </div>
                                                                <div class="card-body">
                                                                    <h5>{{ $growthData['latestData']['weight'] }} kg</h5>
                                                                    <p class="mb-1">
                                                                        Status:
                                                                        <strong>{{ $growthData['analysis']['weight']['status'] }}</strong>
                                                                    </p>
                                                                    <p class="mb-1">
                                                                        Z-score:
                                                                        {{ number_format($growthData['analysis']['weight']['zScore'], 2) }}
                                                                    </p>
                                                                    <p class="mb-0">
                                                                        Median:
                                                                        {{ number_format($growthData['analysis']['weight']['median'], 2) }}
                                                                        kg
                                                                        (SD:
                                                                        {{ number_format($growthData['analysis']['weight']['sd'], 2) }})
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="card mb-3">
                                                                <div class="card-header text-dark"
                                                                    style="background-color: #e9ffe9;">
                                                                    <i class="fas fa-ruler-vertical"></i> Panjang Badan
                                                                </div>
                                                                <div class="card-body">
                                                                    <h5>{{ $growthData['latestData']['length'] }} cm</h5>
                                                                    <p class="mb-1">
                                                                        Status:
                                                                        <strong>{{ $growthData['analysis']['length']['status'] }}</strong>
                                                                    </p>
                                                                    <p class="mb-1">
                                                                        Z-score:
                                                                        {{ number_format($growthData['analysis']['length']['zScore'], 2) }}
                                                                    </p>
                                                                    <p class="mb-0">
                                                                        Median:
                                                                        {{ number_format($growthData['analysis']['length']['median'], 2) }}
                                                                        cm
                                                                        (SD:
                                                                        {{ number_format($growthData['analysis']['length']['sd'], 2) }})
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="card mb-3">
                                                                <div class="card-header text-dark"
                                                                    style="background-color: #e9ffe9;">
                                                                    <i class="fas fa-circle-notch"></i> Lingkar Lengan
                                                                </div>
                                                                <div class="card-body">
                                                                    <h5>{{ $growthData['latestData']['armCircumference'] }}
                                                                        cm</h5>
                                                                    <p class="mb-0">Referensi normal: 12.5-16.5 cm</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="card mb-3">
                                                                <div class="card-header text-dark"
                                                                    style="background-color: #e9ffe9;">
                                                                    <i class="fas fa-brain"></i> Lingkar Kepala
                                                                </div>
                                                                <div class="card-body">
                                                                    <h5>{{ $growthData['latestData']['headCircumference'] }}
                                                                        cm</h5>
                                                                    <p class="mb-0">Referensi normal: sesuai grafik
                                                                        pertumbuhan</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="alert alert-warning">
                                                        Belum ada data kunjungan untuk ditampilkan dalam grafik pertumbuhan.
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tab grafik -->
                                <ul class="nav nav-tabs mb-4" id="growthChartTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="weight-for-age-tab" data-bs-toggle="tab"
                                            data-bs-target="#weight-for-age" type="button" role="tab">
                                            BB/U (Berat Badan/Umur)
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="length-for-age-tab" data-bs-toggle="tab"
                                            data-bs-target="#length-for-age" type="button" role="tab">
                                            PB/U (Panjang Badan/Umur)
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="weight-for-length-tab" data-bs-toggle="tab"
                                            data-bs-target="#weight-for-length" type="button" role="tab">
                                            BB/PB (Berat Badan/Panjang Badan)
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="additional-charts-tab" data-bs-toggle="tab"
                                            data-bs-target="#additional-charts" type="button" role="tab">
                                            Grafik Tambahan
                                        </button>
                                    </li>
                                </ul>

                                <div class="tab-content" id="growthChartTabContent">
                                    <!-- Tab BB/U -->
                                    <div class="tab-pane fade show active" id="weight-for-age" role="tabpanel">
                                        <div class="card mb-4">
                                            <div class="card-header text-white"
                                                style="background-color: {{ $growthData['chartData']['gender'] == 1 ? '#0d6efd' : '#e83e8c' }};">
                                                <h5 class="card-title mb-0">
                                                    Grafik Berat Badan menurut Umur (BB/U) -
                                                    {{ $growthData['chartData']['gender'] == 1 ? 'Laki-laki' : 'Perempuan' }}
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <div id="weightForAgeChart" style="height: 400px;"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tab PB/U -->
                                    <div class="tab-pane fade" id="length-for-age" role="tabpanel">
                                        <div class="card mb-4">
                                            <div class="card-header text-white"
                                                style="background-color: {{ $growthData['chartData']['gender'] == 1 ? '#0d6efd' : '#e83e8c' }};">
                                                <h5 class="card-title mb-0">
                                                    Grafik Panjang Badan menurut Umur (PB/U) -
                                                    {{ $growthData['chartData']['gender'] == 1 ? 'Laki-laki' : 'Perempuan' }}
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <div id="lengthForAgeChart" style="height: 400px;"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tab BB/PB -->
                                    <div class="tab-pane fade" id="weight-for-length" role="tabpanel">
                                        <div class="card mb-4">
                                            <div class="card-header text-white"
                                                style="background-color: {{ $growthData['chartData']['gender'] == 1 ? '#0d6efd' : '#e83e8c' }};">
                                                <h5 class="card-title mb-0">
                                                    Grafik Berat Badan menurut Panjang Badan (BB/PB) -
                                                    {{ $growthData['chartData']['gender'] == 1 ? 'Laki-laki' : 'Perempuan' }}
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <div id="weightForLengthChart" style="height: 400px;"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tab Grafik Tambahan -->
                                    <div class="tab-pane fade" id="additional-charts" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card mb-4">
                                                    <div class="card-header text-white"
                                                        style="background-color: {{ $growthData['chartData']['gender'] == 1 ? '#0d6efd' : '#e83e8c' }};">
                                                        <h5 class="card-title mb-0">
                                                            Grafik IMT menurut Umur -
                                                            {{ $growthData['chartData']['gender'] == 1 ? 'Laki-laki' : 'Perempuan' }}
                                                        </h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div id="bmiForAgeChart" style="height: 400px;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card mb-4">
                                                    <div class="card-header text-white"
                                                        style="background-color: {{ $growthData['chartData']['gender'] == 1 ? '#0d6efd' : '#e83e8c' }};">
                                                        <h5 class="card-title mb-0">
                                                            Grafik Lingkar Kepala menurut Umur -
                                                            {{ $growthData['chartData']['gender'] == 1 ? 'Laki-laki' : 'Perempuan' }}
                                                        </h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div id="headCircumferenceForAgeChart" style="height: 400px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Rekomendasi Intervensi --}}
                                @if ($growthData['latestData'])
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header text-white" style="background-color: #198754;">
                                                    <h5 class="card-title mb-0">Rekomendasi Intervensi Gizi</h5>
                                                </div>
                                                <div class="card-body">
                                                    @if (!empty($growthData['analysis']['recommendations']))
                                                        <ul class="list-group">
                                                            @foreach ($growthData['analysis']['recommendations'] as $recommendation)
                                                                <li
                                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                                    {{ $recommendation }}
                                                                    <span class="badge bg-success rounded-pill">
                                                                        <i class="fas fa-check"></i>
                                                                    </span>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <p class="mb-0">Tidak diperlukan intervensi khusus - pertumbuhan
                                                            dalam batas normal.</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Keterangan --}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header text-white" style="background-color: #198754;">
                                                <h5 class="card-title mb-0">Kategori Status Gizi Berdasarkan Z-score</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead class="table-success">
                                                            <tr>
                                                                <th style="width: 30%;">Indikator</th>
                                                                <th style="width: 20%;">Kategori</th>
                                                                <th style="width: 20%;">Z-score</th>
                                                                <th style="width: 30%;">Interpretasi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <!-- Berat Badan menurut Umur (BB/U) -->
                                                            <tr>
                                                                <td rowspan="4">Berat Badan menurut Umur (BB/U)</td>
                                                                <td>Gizi Lebih</td>
                                                                <td>&gt; +2 SD</td>
                                                                <td>Berat badan berlebih</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Gizi Baik</td>
                                                                <td>-2 SD sampai +2 SD</td>
                                                                <td>Berat badan normal</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Gizi Kurang</td>
                                                                <td>-3 SD sampai &lt; -2 SD</td>
                                                                <td>Berat badan kurang</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Gizi Buruk</td>
                                                                <td>&lt; -3 SD</td>
                                                                <td>Berat badan sangat kurang</td>
                                                            </tr>

                                                            <!-- Panjang Badan menurut Umur (PB/U) -->
                                                            <tr>
                                                                <td rowspan="3">Panjang Badan menurut Umur (PB/U)</td>
                                                                <td>Pendek (Stunted)</td>
                                                                <td>&lt; -2 SD</td>
                                                                <td>Pendek untuk usia</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Normal</td>
                                                                <td>-2 SD sampai +2 SD</td>
                                                                <td>Normal untuk usia</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Tinggi</td>
                                                                <td>&gt; +2 SD</td>
                                                                <td>Tinggi untuk usia</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
            background-color: #198754 !important;
            color: #fff !important;
            border-color: #198754 !important;
        }

        /* Hover effect */
        .nav-tabs .nav-link:hover {
            color: #198754 !important;
        }

        /* Menghilangkan border bawah tab */
        .nav-tabs {
            border-bottom: none;
        }

        /* Growth Chart Tab Styling */
        .card-header {
            font-weight: 600;
        }

        .list-group-item {
            padding: 1rem 1.25rem;
            border-left: 4px solid #198754;
            margin-bottom: 0.5rem;
            border-radius: 4px;
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
        }

        .table th {
            white-space: nowrap;
        }

        /* Style untuk grafik */
        #weightChart,
        #lengthChart {
            width: 100%;
            min-height: 400px;
        }

        /* Style untuk tab */
        .nav-tabs .nav-link {
            transition: all 0.3s ease;
        }

        .nav-tabs .nav-link.active {
            background-color: #198754 !important;
            color: white !important;
        }

        /* Style untuk card */
        .card-header {
            font-weight: 600;
        }

        /* Style untuk tooltip grafik */
        .apexcharts-tooltip {
            background: #f8f9fa !important;
            color: #333;
        }

        .nav-tabs .nav-link {
            border-radius: 4px 4px 0 0;
            border: 1px solid #dee2e6;
            color: #495057;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
        }

        .nav-tabs .nav-link.active {
            background-color: #198754;
            color: white !important;
            border-color: #198754;
        }

        .nav-tabs .nav-link:not(.active) {
            background-color: #f8f9fa;
        }

        .nav-tabs .nav-link:not(.active):hover {
            border-color: #dee2e6;
            background-color: #e9ecef;
        }

        /* Warna khusus untuk jenis kelamin */
        .bg-boy {
            background-color: #0d6efd !important;
        }

        .bg-girl {
            background-color: #e83e8c !important;
        }

        /* Tooltip grafik */
        .apexcharts-tooltip {
            background: #f8f9fa !important;
            color: #333;
            border: 1px solid #dee2e6;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .apexcharts-tooltip-title {
            background: #198754 !important;
            color: white !important;
            border-bottom: 1px solid #dee2e6 !important;
            font-weight: bold;
        }

        /* Garis standar */
        .apexcharts-line-series path[stroke="#ff0000"] {
            stroke-dasharray: 5, 5;
        }

        .apexcharts-line-series path[stroke="#ff9900"] {
            stroke-dasharray: 5, 5;
        }

        .apexcharts-line-series path[stroke="#00aa00"] {
            stroke-width: 2;
        }
    </style>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // console.log('Gender:', gender, 'Color:', primaryColor);
            $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                if (e.target.getAttribute('aria-controls') === 'tab3') {
                    renderGrowthCharts();
                }
            });
            renderGrowthCharts();
        });

        // Di bagian scripts
        function renderGrowthCharts() {
            @if (isset($growthData))
                const growthData = @json($growthData);
                const gender = growthData.chartData.gender;
                const primaryColor = gender === 1 ? '#0d6efd' : '#e83e8c';

                function createChartWithStandards(elementId, seriesData, standardData, title, yTitle, unit) {
                    const options = {
                        chart: {
                            type: 'line',
                            height: 400
                        },
                        series: [{
                                name: 'Data Aktual',
                                data: seriesData,
                                color: primaryColor,
                            },
                            {
                                name: '-3SD',
                                data: standardData.map(item => item['-3SD']),
                            },
                            {
                                name: '-2SD',
                                data: standardData.map(item => item['-2SD']),
                            },
                            {
                                name: 'Median',
                                data: standardData.map(item => item['median']),
                            },
                            {
                                name: '+2SD',
                                data: standardData.map(item => item['+2SD']),
                            },
                            {
                                name: '+3SD',
                                data: standardData.map(item => item['+3SD']),
                            }
                        ],
                        stroke: {
                            width: [3, 2, 2, 2, 2, 2],
                            dashArray: [0, 5, 5, 0, 5, 5]
                        },
                        colors: [primaryColor, '#ff0000', '#ff9900', '#00aa00', '#ff9900', '#ff0000'],
                        xaxis: {
                            categories: growthData.chartData.labels,
                            title: {
                                text: 'Usia (bulan)'
                            }
                        },
                        yaxis: {
                            title: {
                                text: yTitle + (unit ? ` (${unit})` : '')
                            }
                        },
                        tooltip: {
                            shared: true,
                            y: {
                                formatter: function(val) {
                                    return val + (unit ? ` ${unit}` : '');
                                }
                            }
                        },
                        legend: {
                            position: 'bottom',
                            horizontalAlign: 'center'
                        },
                        title: {
                            text: title
                        }
                    };

                    const chart = new ApexCharts(document.getElementById(elementId), options);
                    return chart;
                }

                // Grafik BB/U
                if (growthData.chartData.weight && growthData.chartData.weight.some(w => w !== null)) {
                    const weightSeries = growthData.chartData.labels.map((label, i) => {
                        return {
                            x: label,
                            y: growthData.chartData.weight[i]
                        };
                    }).filter(item => item.y !== null);

                    const weightChart = new ApexCharts(document.getElementById('weightForAgeChart'), {
                        chart: {
                            type: 'line',
                            height: 400
                        },
                        series: [{
                                name: 'Berat Badan',
                                data: weightSeries,
                                color: primaryColor,
                            },
                            {
                                name: '-3SD',
                                data: growthData.chartData.standards.weightForAge.map((std, i) => ({
                                    x: growthData.chartData.labels[i],
                                    y: std['-3SD']
                                }))
                            },
                            {
                                name: '-2SD',
                                data: growthData.chartData.standards.weightForAge.map((std, i) => ({
                                    x: growthData.chartData.labels[i],
                                    y: std['-2SD']
                                }))
                            },
                            {
                                name: 'Median',
                                data: growthData.chartData.standards.weightForAge.map((std, i) => ({
                                    x: growthData.chartData.labels[i],
                                    y: std['median']
                                }))
                            },
                            {
                                name: '+2SD',
                                data: growthData.chartData.standards.weightForAge.map((std, i) => ({
                                    x: growthData.chartData.labels[i],
                                    y: std['+2SD']
                                }))
                            },
                            {
                                name: '+3SD',
                                data: growthData.chartData.standards.weightForAge.map((std, i) => ({
                                    x: growthData.chartData.labels[i],
                                    y: std['+3SD']
                                }))
                            }
                        ],
                        colors: [primaryColor, '#ff0000', '#ff9900', '#00aa00', '#ff9900', '#ff0000'],
                        stroke: {
                            width: [3, 2, 2, 2, 2, 2],
                            dashArray: [0, 5, 5, 0, 5, 5]
                        },
                        xaxis: {
                            type: 'category',
                            title: {
                                text: 'Usia (bulan)'
                            }
                        },
                        yaxis: {
                            title: {
                                text: 'Berat Badan (kg)'
                            }
                        },
                        tooltip: {
                            shared: true,
                            y: {
                                formatter: function(val) {
                                    return val + ' kg';
                                }
                            }
                        },
                        legend: {
                            position: 'bottom',
                            horizontalAlign: 'center'
                        },
                        title: {
                            text: 'Grafik Berat Badan per Usia (BB/U)'
                        }
                    });

                    weightChart.render();
                }

                // Grafik PB/U
                if (growthData.chartData.length && growthData.chartData.length.some(l => l !== null)) {
                    const lengthSeries = growthData.chartData.labels.map((label, i) => {
                        return {
                            x: label,
                            y: growthData.chartData.length[i]
                        };
                    }).filter(item => item.y !== null);

                    const lengthChart = new ApexCharts(document.getElementById('lengthForAgeChart'), {
                        chart: {
                            type: 'line',
                            height: 400
                        },
                        series: [{
                                name: 'Panjang Badan',
                                data: lengthSeries,
                                color: primaryColor,
                            },
                            {
                                name: '-3SD',
                                data: growthData.chartData.standards.lengthForAge.map((std, i) => ({
                                    x: growthData.chartData.labels[i],
                                    y: std['-3SD']
                                }))
                            },
                            {
                                name: '-2SD',
                                data: growthData.chartData.standards.lengthForAge.map((std, i) => ({
                                    x: growthData.chartData.labels[i],
                                    y: std['-2SD']
                                }))
                            },
                            {
                                name: 'Median',
                                data: growthData.chartData.standards.lengthForAge.map((std, i) => ({
                                    x: growthData.chartData.labels[i],
                                    y: std['median']
                                }))
                            },
                            {
                                name: '+2SD',
                                data: growthData.chartData.standards.lengthForAge.map((std, i) => ({
                                    x: growthData.chartData.labels[i],
                                    y: std['+2SD']
                                }))
                            },
                            {
                                name: '+3SD',
                                data: growthData.chartData.standards.lengthForAge.map((std, i) => ({
                                    x: growthData.chartData.labels[i],
                                    y: std['+3SD']
                                }))
                            }
                        ],
                        colors: [primaryColor, '#ff0000', '#ff9900', '#00aa00', '#ff9900', '#ff0000'],
                        stroke: {
                            width: [3, 2, 2, 2, 2, 2],
                            dashArray: [0, 5, 5, 0, 5, 5]
                        },
                        xaxis: {
                            type: 'category',
                            title: {
                                text: 'Usia (bulan)'
                            }
                        },
                        yaxis: {
                            title: {
                                text: 'Panjang Badan (cm)'
                            }
                        },
                        tooltip: {
                            shared: true,
                            y: {
                                formatter: function(val) {
                                    return val + ' cm';
                                }
                            }
                        },
                        legend: {
                            position: 'bottom',
                            horizontalAlign: 'center'
                        },
                        title: {
                            text: 'Grafik Panjang Badan per Usia (PB/U)'
                        }
                    });

                    lengthChart.render();
                }

                // Grafik BB/PB
                if (growthData.chartData.weight && growthData.chartData.length) {
                    const weightForLengthSeries = growthData.chartData.labels.map((label, i) => {
                        if (growthData.chartData.length[i] && growthData.chartData.weight[i]) {
                            return {
                                x: growthData.chartData.length[i], // Panjang badan
                                y: growthData.chartData.weight[i] // Berat badan
                            };
                        }
                        return null;
                    }).filter(item => item !== null);

                    const weightForLengthChart = new ApexCharts(document.getElementById('weightForLengthChart'), {
                        chart: {
                            type: 'scatter',
                            height: 400,
                            zoom: {
                                enabled: true
                            }
                        },
                        series: [{
                                name: 'BB/PB Aktual',
                                data: weightForLengthSeries,
                                color: primaryColor,
                                type: 'scatter'
                            },
                            {
                                name: '-3SD',
                                data: growthData.chartData.standards.weightForLength.map(std => ({
                                    x: std['pb'],
                                    y: std['-3SD']
                                })),
                                type: 'line',
                                color: '#ff0000'
                            },
                            {
                                name: '-2SD',
                                data: growthData.chartData.standards.weightForLength.map(std => ({
                                    x: std['pb'],
                                    y: std['-2SD']
                                })),
                                type: 'line',
                                color: '#ff9900'
                            },
                            {
                                name: 'Median',
                                data: growthData.chartData.standards.weightForLength.map(std => ({
                                    x: std['pb'],
                                    y: std['median']
                                })),
                                type: 'line',
                                color: '#00aa00'
                            },
                            {
                                name: '+2SD',
                                data: growthData.chartData.standards.weightForLength.map(std => ({
                                    x: std['pb'],
                                    y: std['+2SD']
                                })),
                                type: 'line',
                                color: '#ff9900'
                            },
                            {
                                name: '+3SD',
                                data: growthData.chartData.standards.weightForLength.map(std => ({
                                    x: std['pb'],
                                    y: std['+3SD']
                                })),
                                type: 'line',
                                color: '#ff0000'
                            }
                        ],
                        stroke: {
                            width: [0, 2, 2, 2, 2, 2],
                            dashArray: [0, 5, 5, 0, 5, 5]
                        },
                        markers: {
                            size: 5
                        },
                        xaxis: {
                            title: {
                                text: 'Panjang Badan (cm)'
                            },
                            tickAmount: 10
                        },
                        yaxis: {
                            title: {
                                text: 'Berat Badan (kg)'
                            }
                        },
                        tooltip: {
                            shared: false,
                            x: {
                                formatter: function(val) {
                                    return val + ' cm';
                                }
                            },
                            y: {
                                formatter: function(val) {
                                    return val + ' kg';
                                }
                            }
                        },
                        legend: {
                            position: 'bottom',
                            horizontalAlign: 'center'
                        },
                        title: {
                            text: 'Grafik Berat Badan menurut Panjang Badan (BB/PB)'
                        }
                    });

                    weightForLengthChart.render();
                }

                // Grafik IMT/U
                if (growthData.chartData.bmi && growthData.chartData.bmi.some(b => b !== null)) {
                    const bmiSeries = growthData.chartData.labels.map((label, i) => {
                        return {
                            x: growthData.chartData.ages[i], // Gunakan usia dalam bulan sebagai x-axis
                            y: growthData.chartData.bmi[i]
                        };
                    }).filter(item => item.y !== null);

                    const bmiChart = new ApexCharts(document.getElementById('bmiForAgeChart'), {
                        chart: {
                            type: 'line',
                            height: 400
                        },
                        series: [{
                                name: 'IMT',
                                data: bmiSeries,
                                color: primaryColor
                            },
                            {
                                name: '-3SD',
                                data: growthData.chartData.standards.bmiForAge.map((std, i) => ({
                                    x: growthData.chartData.ages[i],
                                    y: std['-3SD']
                                })),
                                type: 'line',
                                color: '#ff0000'
                            },
                            {
                                name: '-2SD',
                                data: growthData.chartData.standards.bmiForAge.map((std, i) => ({
                                    x: growthData.chartData.ages[i],
                                    y: std['-2SD']
                                })),
                                type: 'line',
                                color: '#ff9900'
                            },
                            {
                                name: 'Median',
                                data: growthData.chartData.standards.bmiForAge.map((std, i) => ({
                                    x: growthData.chartData.ages[i],
                                    y: std['median']
                                })),
                                type: 'line',
                                color: '#00aa00'
                            },
                            {
                                name: '+2SD',
                                data: growthData.chartData.standards.bmiForAge.map((std, i) => ({
                                    x: growthData.chartData.ages[i],
                                    y: std['+2SD']
                                })),
                                type: 'line',
                                color: '#ff9900'
                            },
                            {
                                name: '+3SD',
                                data: growthData.chartData.standards.bmiForAge.map((std, i) => ({
                                    x: growthData.chartData.ages[i],
                                    y: std['+3SD']
                                })),
                                type: 'line',
                                color: '#ff0000'
                            }
                        ],
                        xaxis: {
                            title: {
                                text: 'Usia (bulan)'
                            },
                            type: 'numeric',
                            tickAmount: 10
                        },
                        yaxis: {
                            title: {
                                text: 'Indeks Massa Tubuh (kg/m²)'
                            }
                        },
                        tooltip: {
                            shared: true,
                            y: {
                                formatter: function(val) {
                                    return val + ' kg/m²';
                                }
                            },
                            x: {
                                formatter: function(val) {
                                    return val + ' bulan';
                                }
                            }
                        },
                        legend: {
                            position: 'bottom',
                            horizontalAlign: 'center'
                        },
                        title: {
                            text: 'Grafik IMT menurut Umur (IMT/U)'
                        }
                    });

                    bmiChart.render();
                }

                // Grafik LK/U
                if (growthData.chartData.headCircumference && growthData.chartData.headCircumference.some(h => h !== null)) {
                    const hcSeries = growthData.chartData.labels.map((label, i) => {
                        return {
                            x: growthData.chartData.ages[i], // Gunakan usia dalam bulan sebagai x-axis
                            y: growthData.chartData.headCircumference[i]
                        };
                    }).filter(item => item.y !== null);

                    const hcChart = new ApexCharts(document.getElementById('headCircumferenceForAgeChart'), {
                        chart: {
                            type: 'line',
                            height: 400
                        },
                        series: [{
                                name: 'Lingkar Kepala',
                                data: hcSeries,
                                color: primaryColor
                            },
                            {
                                name: '-3SD',
                                data: growthData.chartData.standards.headCircumferenceForAge.map((std, i) => ({
                                    x: growthData.chartData.ages[i],
                                    y: std['-3SD']
                                })),
                                type: 'line',
                                color: '#ff0000'
                            },
                            {
                                name: '-2SD',
                                data: growthData.chartData.standards.headCircumferenceForAge.map((std, i) => ({
                                    x: growthData.chartData.ages[i],
                                    y: std['-2SD']
                                })),
                                type: 'line',
                                color: '#ff9900'
                            },
                            {
                                name: 'Median',
                                data: growthData.chartData.standards.headCircumferenceForAge.map((std, i) => ({
                                    x: growthData.chartData.ages[i],
                                    y: std['median']
                                })),
                                type: 'line',
                                color: '#00aa00'
                            },
                            {
                                name: '+2SD',
                                data: growthData.chartData.standards.headCircumferenceForAge.map((std, i) => ({
                                    x: growthData.chartData.ages[i],
                                    y: std['+2SD']
                                })),
                                type: 'line',
                                color: '#ff9900'
                            },
                            {
                                name: '+3SD',
                                data: growthData.chartData.standards.headCircumferenceForAge.map((std, i) => ({
                                    x: growthData.chartData.ages[i],
                                    y: std['+3SD']
                                })),
                                type: 'line',
                                color: '#ff0000'
                            }
                        ],
                        xaxis: {
                            title: {
                                text: 'Usia (bulan)'
                            },
                            type: 'numeric',
                            tickAmount: 10
                        },
                        yaxis: {
                            title: {
                                text: 'Lingkar Kepala (cm)'
                            }
                        },
                        tooltip: {
                            shared: true,
                            y: {
                                formatter: function(val) {
                                    return val + ' cm';
                                }
                            },
                            x: {
                                formatter: function(val) {
                                    return val + ' bulan';
                                }
                            }
                        },
                        legend: {
                            position: 'bottom',
                            horizontalAlign: 'center'
                        },
                        title: {
                            text: 'Grafik Lingkar Kepala menurut Umur (LK/U)'
                        }
                    });

                    hcChart.render();
                }
            @endif
        }
    </script>
@endpush
