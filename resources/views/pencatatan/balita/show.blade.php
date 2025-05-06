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

                            <!-- Tab 3: Grafik Pertumbuhan Balita -->
                            <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                                @php
                                    $growthData = app(
                                        'App\Http\Controllers\PencatatanBalitaController',
                                    )->generateGrowthChartData($data->id);
                                @endphp

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

                                @if ($growthData['latestData'])
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <div class="card border-primary">
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

                                <!-- Grafik Pertumbuhan -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card mb-4">
                                            <div class="card-header bg-success text-white">
                                                <h5 class="card-title mb-0">Grafik Pertumbuhan Berat Badan menurut Umur
                                                    (BB/U)</h5>
                                            </div>
                                            <div class="card-body">
                                                <div id="weightChart" style="height: 400px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card mb-4">
                                            <div class="card-header bg-success text-white">
                                                <h5 class="card-title mb-0">Grafik Pertumbuhan Panjang Badan menurut Umur
                                                    (PB/U)</h5>
                                            </div>
                                            <div class="card-body">
                                                <div id="lengthChart" style="height: 400px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
                                                                <th>Indikator</th>
                                                                <th>Kategori</th>
                                                                <th>Z-score</th>
                                                                <th>Interpretasi</th>
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
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        $(document).ready(function() {
            // Inisialisasi chart saat tab aktif
            $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                if (e.target.getAttribute('aria-controls') === 'tab3') {
                    renderGrowthCharts();
                }
            });

            // Jika tab grafik sudah aktif saat load
            if ($('#tab3').hasClass('active')) {
                renderGrowthCharts();
            }
        });

        function renderGrowthCharts() {
            @if (isset($growthData))
                console.log('Memulai render grafik pertumbuhan...');

                // Hapus chart sebelumnya jika ada
                if (typeof weightChart !== 'undefined') {
                    weightChart.destroy();
                }
                if (typeof lengthChart !== 'undefined') {
                    lengthChart.destroy();
                }

                // Konversi data PHP ke JavaScript
                const growthData = @json($growthData);
                console.log('Data pertumbuhan:', growthData);

                // Fungsi untuk memformat data
                function formatChartData(labels, values) {
                    return labels.map((label, index) => {
                        return {
                            x: label,
                            y: values[index]
                        };
                    }).filter(item => item.y !== null);
                }

                // Grafik Berat Badan
                const weightData = formatChartData(
                    growthData.chartData.labels,
                    growthData.chartData.weight
                );

                if (weightData.length > 0) {
                    const weightOptions = {
                        series: [{
                            name: 'Berat Badan',
                            data: weightData
                        }],
                        chart: {
                            type: 'line',
                            height: 350,
                            zoom: {
                                enabled: false
                            }
                        },
                        colors: ['#28a745'],
                        dataLabels: {
                            enabled: true,
                            formatter: function(val) {
                                return val.toFixed(2) + ' kg';
                            }
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 3
                        },
                        markers: {
                            size: 5
                        },
                        xaxis: {
                            type: 'category',
                            title: {
                                text: 'Usia'
                            }
                        },
                        yaxis: {
                            title: {
                                text: 'Berat Badan (kg)'
                            },
                            min: Math.max(0, Math.min(...growthData.chartData.weight.filter(w => w !== null)) - 1),
                            max: Math.max(...growthData.chartData.weight.filter(w => w !== null)) + 1
                        },
                        tooltip: {
                            y: {
                                formatter: function(val) {
                                    return val + ' kg';
                                }
                            }
                        }
                    };

                    const weightChart = new ApexCharts(
                        document.querySelector("#weightChart"),
                        weightOptions
                    );
                    weightChart.render();
                    window.weightChart = weightChart;
                } else {
                    $('#weightChart').html(
                        '<div class="alert alert-warning">Tidak ada data berat badan yang tersedia</div>');
                }

                // Grafik Panjang Badan
                const lengthData = formatChartData(
                    growthData.chartData.labels,
                    growthData.chartData.length
                );

                if (lengthData.length > 0) {
                    const lengthOptions = {
                        series: [{
                            name: 'Panjang Badan',
                            data: lengthData
                        }],
                        chart: {
                            type: 'line',
                            height: 350,
                            zoom: {
                                enabled: false
                            }
                        },
                        colors: ['#17a2b8'],
                        dataLabels: {
                            enabled: true,
                            formatter: function(val) {
                                return val.toFixed(2) + ' cm';
                            }
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 3
                        },
                        markers: {
                            size: 5
                        },
                        xaxis: {
                            type: 'category',
                            title: {
                                text: 'Usia'
                            }
                        },
                        yaxis: {
                            title: {
                                text: 'Panjang Badan (cm)'
                            },
                            min: Math.max(0, Math.min(...growthData.chartData.length.filter(l => l !== null)) - 5),
                            max: Math.max(...growthData.chartData.length.filter(l => l !== null)) + 5
                        },
                        tooltip: {
                            y: {
                                formatter: function(val) {
                                    return val + ' cm';
                                }
                            }
                        }
                    };

                    const lengthChart = new ApexCharts(
                        document.querySelector("#lengthChart"),
                        lengthOptions
                    );
                    lengthChart.render();
                    window.lengthChart = lengthChart;
                } else {
                    $('#lengthChart').html(
                        '<div class="alert alert-warning">Tidak ada data panjang badan yang tersedia</div>');
                }
            @else
                console.log('Tidak ada data pertumbuhan yang tersedia');
                $('#weightChart').html('<div class="alert alert-warning">Data grafik berat badan tidak tersedia</div>');
                $('#lengthChart').html('<div class="alert alert-warning">Data grafik panjang badan tidak tersedia</div>');
            @endif
        }
    </script>
@endsection

{{-- @section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        $(document).ready(function() {
            $('.btn-hapus').on('click', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#198754',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            // Pastikan tab grafik sudah aktif sebelum merender chart
            $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                if (e.target.getAttribute('aria-controls') === 'tab3') {
                    setTimeout(renderGrowthCharts, 100); // Beri sedikit delay
                }
            });

            // Jika tab grafik sudah aktif saat load, langsung render
            if ($('#tab3').hasClass('active')) {
                renderGrowthCharts();
            }
        });

        function renderGrowthCharts() {
            @if (isset($growthData) && $growthData['latestData'])
                // Konversi data PHP ke format JavaScript
                const growthData = @json($growthData);
                console.log('Growth data:', growthData);

                // Pastikan container chart ada
                if ($("#weightChart").length === 0 || $("#lengthChart").length === 0) {
                    console.error('Chart containers not found');
                    return;
                }

                // Fungsi untuk membersihkan data null
                const cleanData = (data) => data.map((val, i) =>
                    val !== null ? {
                        x: growthData.chartData.labels[i],
                        y: val
                    } : null
                ).filter(item => item !== null);

                // Weight for Age Chart
                const weightOptions = {
                    series: [{
                        name: 'Berat Badan (kg)',
                        data: cleanData(growthData.chartData.weight)
                    }],
                    chart: {
                        height: 350,
                        type: 'line',
                        zoom: {
                            enabled: false
                        },
                        toolbar: {
                            show: true
                        }
                    },
                    colors: ['#28a745'],
                    dataLabels: {
                        enabled: true,
                        formatter: function(val) {
                            return val.toFixed(1) + ' kg';
                        }
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 3
                    },
                    markers: {
                        size: 5,
                        hover: {
                            size: 7
                        }
                    },
                    title: {
                        text: 'Perkembangan Berat Badan menurut Umur',
                        align: 'left'
                    },
                    grid: {
                        row: {
                            colors: ['#f3f3f3', 'transparent'],
                            opacity: 0.5
                        }
                    },
                    xaxis: {
                        type: 'category',
                        title: {
                            text: 'Usia'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Berat Badan (kg)'
                        },
                        min: Math.min(...growthData.chartData.weight.filter(w => w !== null)) - 1,
                        max: Math.max(...growthData.chartData.weight.filter(w => w !== null)) + 1
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return val ? (val + ' kg') : 'N/A';
                            }
                        }
                    }
                };

                const weightChart = new ApexCharts(document.querySelector("#weightChart"), weightOptions);
                weightChart.render();

                // Length for Age Chart
                const lengthOptions = {
                    series: [{
                        name: 'Panjang Badan (cm)',
                        data: cleanData(growthData.chartData.length)
                    }],
                    chart: {
                        height: 350,
                        type: 'line',
                        zoom: {
                            enabled: false
                        },
                        toolbar: {
                            show: true
                        }
                    },
                    colors: ['#17a2b8'],
                    dataLabels: {
                        enabled: true,
                        formatter: function(val) {
                            return val.toFixed(1) + ' cm';
                        }
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 3
                    },
                    markers: {
                        size: 5,
                        hover: {
                            size: 7
                        }
                    },
                    title: {
                        text: 'Perkembangan Panjang Badan menurut Umur',
                        align: 'left'
                    },
                    grid: {
                        row: {
                            colors: ['#f3f3f3', 'transparent'],
                            opacity: 0.5
                        }
                    },
                    xaxis: {
                        type: 'category',
                        title: {
                            text: 'Usia'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Panjang Badan (cm)'
                        },
                        min: Math.min(...growthData.chartData.length.filter(l => l !== null)) - 5,
                        max: Math.max(...growthData.chartData.length.filter(l => l !== null)) + 5
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return val ? (val + ' cm') : 'N/A';
                            }
                        }
                    }
                };

                const lengthChart = new ApexCharts(document.querySelector("#lengthChart"), lengthOptions);
                lengthChart.render();
            @else
                console.log('No growth data available');
                // Tampilkan pesan error jika tidak ada data
                $('#weightChart').html('<div class="alert alert-warning">Data grafik berat badan tidak tersedia</div>');
                $('#lengthChart').html('<div class="alert alert-warning">Data grafik panjang badan tidak tersedia</div>');
            @endif
        }
    </script>
@endsection --}}
