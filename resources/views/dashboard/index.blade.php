@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
    <main class="app-main" style="background-color: white">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0" style="color: #333333;">Dashboard</h3>
                        <p style="color: #777777;">Ringkasan statistik dan aktivitas terbaru di Posyandu.</p>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <!-- Stats Cards -->
                <div class="row">
                    <!-- Total Pendaftaran (pink) -->
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="small-box text-light"
                            style="background-color: #d63384; border: 1px solid #d63384; border-radius: 2px;">
                            <div class="inner">
                                <h3>{{ number_format($stats['total_pendaftaran']) }}</h3>
                                <p>Total Peserta</p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Balita (success / hijau) -->
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="small-box text-light"
                            style="background-color: #198754; border: 1px solid #198754; border-radius: 2px;">
                            <div class="inner">
                                <h3>{{ number_format($stats['total_balita']) }}</h3>
                                <p>Total Balita</p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Ibu Hamil (primary / biru) -->
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="small-box text-light"
                            style="background-color: #0d6efd; border: 1px solid #0d6efd; border-radius: 2px;">
                            <div class="inner">
                                <h3>{{ number_format($stats['total_ibu_hamil']) }}</h3>
                                <p>Total Ibu Hamil</p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Lansia (warning / kuning) -->
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="small-box text-dark"
                            style="background-color: #ffc107; border: 1px solid #ffc107; border-radius: 2px;">
                            <div class="inner">
                                <h3>{{ number_format($stats['total_lansia']) }}</h3>
                                <p>Total Lansia</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Combined Charts and Distribution Card -->
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4" style="border-radius: 0px;">
                            <div class="card-header" style="border-top: 3px solid #FF69B4; border-radius: 0px;">
                                <ul class="nav nav-tabs card-header-tabs" id="dashboardTabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="all-tab" data-bs-toggle="tab" href="#all"
                                            role="tab" aria-controls="all" aria-selected="true">Semua Sasaran</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="ibuhamil-tab" data-bs-toggle="tab" href="#ibuhamil"
                                            role="tab" aria-controls="ibuhamil" aria-selected="false">Ibu Hamil</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="balita-tab" data-bs-toggle="tab" href="#balita"
                                            role="tab" aria-controls="balita" aria-selected="false">Balita</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="lansia-tab" data-bs-toggle="tab" href="#lansia"
                                            role="tab" aria-controls="lansia" aria-selected="false">Lansia</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="dashboardTabsContent">
                                    <!-- All Tab -->
                                    <div class="tab-pane fade show active" id="all" role="tabpanel"
                                        aria-labelledby="all-tab">
                                        <div class="row">
                                            <!-- Chart Area untuk distribusi sasaran -->
                                            <div class="col-md-6">
                                                <div class="card mb-4" style="border-radius: 0px; height: 400px;">
                                                    <div class="card-header d-flex justify-content-between align-items-center"
                                                        style="border-top: 3px solid #FF69B4; border-radius: 0px;">
                                                        <h5 class="card-title">Distribusi Peserta Berdasarkan Jenis Sasaran
                                                        </h5>
                                                    </div>
                                                    <div class="card-body d-flex align-items-center justify-content-center"
                                                        style="height: calc(100% - 50px); padding: 10px;">
                                                        <div class="chart-area w-100 h-100">
                                                            <canvas id="pasienChartAll"
                                                                style="width: 100%; height: 100%;"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Posyandu Distribution -->
                                            <div class="col-md-6">
                                                <div class="card mb-4" style="border-radius: 0px; height: 400px;">
                                                    <div class="card-header d-flex justify-content-between align-items-center"
                                                        style="border-top: 3px solid #FF69B4; border-radius: 0px;">
                                                        <h5 class="card-title">Distribusi Peserta Berdasarkan Kelompok
                                                            Posyandu</h5>
                                                    </div>
                                                    <div class="card-body d-flex align-items-center justify-content-center"
                                                        style="height: calc(100% - 50px); padding: 10px;">
                                                        <div class="chart-area w-100 h-100">
                                                            <canvas id="posyanduAreaChartAll"
                                                                style="width: 100%; height: 100%;"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Ibu Hamil Tab -->
                                    <div class="tab-pane fade" id="ibuhamil" role="tabpanel"
                                        aria-labelledby="ibuhamil-tab">
                                        <div class="row">
                                            <!-- Chart Area -->
                                            <div class="col-md-6">
                                                <div class="card mb-4" style="border-radius: 0px; height: 400px;">
                                                    <div class="card-header d-flex justify-content-between align-items-center"
                                                        style="border-top: 3px solid #FF69B4; border-radius: 0px;">
                                                        <h5 class="card-title">Kunjungan Bulanan Ibu Hamil</h5>
                                                    </div>
                                                    <div class="card-body d-flex align-items-center justify-content-center"
                                                        style="height: calc(100% - 50px); padding: 10px;">
                                                        <div class="chart-area w-100 h-100">
                                                            <canvas id="kunjunganChartIbuHamil"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Posyandu Distribution -->
                                            <div class="col-md-6">
                                                <div class="card mb-4" style="border-radius: 0px; height: 400px;">
                                                    <div class="card-header d-flex justify-content-between align-items-center"
                                                        style="border-top: 3px solid #FF69B4; border-radius: 0px;">
                                                        <h5 class="card-title">Distribusi Ibu Hamil Berdasarkan Posyandu
                                                        </h5>
                                                    </div>
                                                    <div class="card-body" style="height: calc(100% - 50px);">
                                                        <div class="row h-100">
                                                            <div
                                                                class="col-md-6 h-100 d-flex align-items-center justify-content-center">
                                                                <div class="chart-pie w-100 h-100">
                                                                    <canvas id="posyanduChartIbuHamil"></canvas>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 d-flex align-items-center">
                                                                <div class="table-responsive w-100">
                                                                    <table class="table table-sm table-borderless">
                                                                        <tbody>
                                                                            @foreach ($posyanduData['ibu_hamil']['labels'] as $index => $label)
                                                                                <tr>
                                                                                    <td><i class="fas fa-circle me-2"
                                                                                            style="color: {{ $posyanduData['ibu_hamil']['colors'][$index] }}"></i>
                                                                                    </td>
                                                                                    <td>{{ $label }}</td>
                                                                                    <td class="text-end">
                                                                                        {{ $posyanduData['ibu_hamil']['values'][$index] }}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
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

                                    <!-- Balita Tab -->
                                    <div class="tab-pane fade" id="balita" role="tabpanel"
                                        aria-labelledby="balita-tab">
                                        <div class="row">
                                            <!-- Chart Area -->
                                            <div class="col-md-6">
                                                <div class="card mb-4" style="border-radius: 0px; height: 400px;">
                                                    <div class="card-header d-flex justify-content-between align-items-center"
                                                        style="border-top: 3px solid #FF69B4; border-radius: 0px;">
                                                        <h5 class="card-title">Kunjungan Bulanan Balita</h5>
                                                    </div>
                                                    <div class="card-body d-flex align-items-center justify-content-center"
                                                        style="height: calc(100% - 50px); padding: 10px;">
                                                        <div class="chart-area w-100 h-100">
                                                            <canvas id="kunjunganChartBalita"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Posyandu Distribution -->
                                            <div class="col-md-6">
                                                <div class="card mb-4" style="border-radius: 0px; height: 400px;">
                                                    <div class="card-header d-flex justify-content-between align-items-center"
                                                        style="border-top: 3px solid #FF69B4; border-radius: 0px;">
                                                        <h5 class="card-title">Distribusi Balita Berdasarkan Posyandu</h5>
                                                    </div>
                                                    <div class="card-body" style="height: calc(100% - 50px);">
                                                        <div class="row h-100">
                                                            <div
                                                                class="col-md-6 h-100 d-flex align-items-center justify-content-center">
                                                                <div class="chart-pie w-100 h-100">
                                                                    <canvas id="posyanduChartBalita"></canvas>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 d-flex align-items-center">
                                                                <div class="table-responsive w-100">
                                                                    <table class="table table-sm table-borderless">
                                                                        <tbody>
                                                                            @foreach ($posyanduData['balita']['labels'] as $index => $label)
                                                                                <tr>
                                                                                    <td><i class="fas fa-circle me-2"
                                                                                            style="color: {{ $posyanduData['balita']['colors'][$index] }}"></i>
                                                                                    </td>
                                                                                    <td>{{ $label }}</td>
                                                                                    <td class="text-end">
                                                                                        {{ $posyanduData['balita']['values'][$index] }}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
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

                                    <!-- Lansia Tab -->
                                    <div class="tab-pane fade" id="lansia" role="tabpanel"
                                        aria-labelledby="lansia-tab">
                                        <div class="row">
                                            <!-- Chart Area -->
                                            <div class="col-md-6">
                                                <div class="card mb-4" style="border-radius: 0px; height: 400px;">
                                                    <div class="card-header d-flex justify-content-between align-items-center"
                                                        style="border-top: 3px solid #FF69B4; border-radius: 0px;">
                                                        <h5 class="card-title">Kunjungan Bulanan Lansia</h5>
                                                    </div>
                                                    <div class="card-body d-flex align-items-center justify-content-center"
                                                        style="height: calc(100% - 50px); padding: 10px;">
                                                        <div class="chart-area w-100 h-100">
                                                            <canvas id="kunjunganChartLansia"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Posyandu Distribution -->
                                            <div class="col-md-6">
                                                <div class="card mb-4" style="border-radius: 0px; height: 400px;">
                                                    <div class="card-header d-flex justify-content-between align-items-center"
                                                        style="border-top: 3px solid #FF69B4; border-radius: 0px;">
                                                        <h5 class="card-title">Distribusi Lansia Berdasarkan Posyandu</h5>
                                                    </div>
                                                    <div class="card-body" style="height: calc(100% - 50px);">
                                                        <div class="row h-100">
                                                            <div
                                                                class="col-md-6 h-100 d-flex align-items-center justify-content-center">
                                                                <div class="chart-pie w-100 h-100">
                                                                    <canvas id="posyanduChartLansia"></canvas>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 d-flex align-items-center">
                                                                <div class="table-responsive w-100">
                                                                    <table class="table table-sm table-borderless">
                                                                        <tbody>
                                                                            @foreach ($posyanduData['lansia']['labels'] as $index => $label)
                                                                                <tr>
                                                                                    <td><i class="fas fa-circle me-2"
                                                                                            style="color: {{ $posyanduData['lansia']['colors'][$index] }}"></i>
                                                                                    </td>
                                                                                    <td>{{ $label }}</td>
                                                                                    <td class="text-end">
                                                                                        {{ $posyanduData['lansia']['values'][$index] }}
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
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
                    </div>
                </div>
            </div>
    </main>
@endsection

@section('scripts')
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Area Chart untuk Distribusi Sasaran (All)
            var ctxPasienAll = document.getElementById('pasienChartAll').getContext('2d');
            new Chart(ctxPasienAll, {
                type: 'line',
                data: {
                    labels: @json($pasienLabels),
                    datasets: [{
                        label: 'Jumlah Sasaran',
                        data: @json($pasienValues),
                        backgroundColor: 'rgba(214, 51, 132, 0.2)',
                        borderColor: '#d63384',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Distribusi Semua Sasaran',
                            font: {
                                size: 16
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Jumlah: ' + context.raw;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });

            // Area Chart for Posyandu Distribution (All)
            var ctxPosyanduAreaAll = document.getElementById('posyanduAreaChartAll').getContext('2d');
            new Chart(ctxPosyanduAreaAll, {
                type: 'line',
                data: {
                    labels: @json($posyanduData['all']['labels']),
                    datasets: [{
                        label: 'Jumlah Sasaran',
                        data: @json($posyanduData['all']['values']),
                        backgroundColor: 'rgba(214, 51, 132, 0.2)',
                        borderColor: '#d63384',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Jumlah: ' + context.raw;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });

            // Chart untuk Ibu Hamil
            var ctxIbuHamil = document.getElementById('kunjunganChartIbuHamil').getContext('2d');
            new Chart(ctxIbuHamil, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov',
                        'Des'
                    ],
                    datasets: [{
                        label: 'Kunjungan Ibu Hamil',
                        data: @json($kunjunganData['1']),
                        backgroundColor: 'rgba(13, 110, 253, 0.2)',
                        borderColor: '#0d6efd',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true,
                    }]
                },
                options: getChartOptions('Kunjungan Ibu Hamil')
            });

            // Chart untuk Balita
            var ctxBalita = document.getElementById('kunjunganChartBalita').getContext('2d');
            new Chart(ctxBalita, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov',
                        'Des'
                    ],
                    datasets: [{
                        label: 'Kunjungan Balita',
                        data: @json($kunjunganData['2']),
                        backgroundColor: 'rgba(25, 135, 84, 0.2)',
                        borderColor: '#198754',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true,
                    }]
                },
                options: getChartOptions('Kunjungan Balita')
            });

            // Chart untuk Lansia
            var ctxLansia = document.getElementById('kunjunganChartLansia').getContext('2d');
            new Chart(ctxLansia, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov',
                        'Des'
                    ],
                    datasets: [{
                        label: 'Kunjungan Lansia',
                        data: @json($kunjunganData['3']),
                        backgroundColor: 'rgba(255, 193, 7, 0.2)',
                        borderColor: '#ffc107',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true,
                    }]
                },
                options: getChartOptions('Kunjungan Lansia')
            });

            // Chart distribusi posyandu untuk Ibu Hamil
            var ctxPosyanduIbuHamil = document.getElementById('posyanduChartIbuHamil').getContext('2d');
            new Chart(ctxPosyanduIbuHamil, {
                type: 'doughnut',
                data: {
                    labels: @json($posyanduData['ibu_hamil']['labels']),
                    datasets: [{
                        data: @json($posyanduData['ibu_hamil']['values']),
                        backgroundColor: @json($posyanduData['ibu_hamil']['colors']),
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: getDoughnutOptions()
            });

            // Chart distribusi posyandu untuk Balita
            var ctxPosyanduBalita = document.getElementById('posyanduChartBalita').getContext('2d');
            new Chart(ctxPosyanduBalita, {
                type: 'doughnut',
                data: {
                    labels: @json($posyanduData['balita']['labels']),
                    datasets: [{
                        data: @json($posyanduData['balita']['values']),
                        backgroundColor: @json($posyanduData['balita']['colors']),
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: getDoughnutOptions()
            });

            // Chart distribusi posyandu untuk Lansia
            var ctxPosyanduLansia = document.getElementById('posyanduChartLansia').getContext('2d');
            new Chart(ctxPosyanduLansia, {
                type: 'doughnut',
                data: {
                    labels: @json($posyanduData['lansia']['labels']),
                    datasets: [{
                        data: @json($posyanduData['lansia']['values']),
                        backgroundColor: @json($posyanduData['lansia']['colors']),
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: getDoughnutOptions()
            });

            function getChartOptions(title) {
                return {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 0
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: title,
                            font: {
                                size: 16
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Jumlah: ' + context.raw;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                };
            }

            function getDoughnutOptions(title) {
                return {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 0
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: title ? true : false,
                            text: title,
                            font: {
                                size: 16
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((value / total) * 100);
                                    return `${label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    },
                    cutout: '50%',
                };
            }
        });
    </script>
@endsection

@section('style')
    <style>
        /* Chart Styles */
        #kunjunganChartIbuHamil,
        #kunjunganChartBalita,
        #kunjunganChartLansia,
        #posyanduChartIbuHamil,
        #posyanduChartBalita,
        #posyanduChartLansia,
        #pasienChartAll,
        #posyanduAreaChartAll {
            width: 100% !important;
            height: 100% !important;
            display: block;
        }

        .chart-area {
            position: relative;
            width: 100% !important;
            height: 100% !important;
        }

        .chart-pie {
            position: relative;
            width: 100% !important;
            height: 100% !important;
        }

        .card {
            min-height: auto;
        }

        /* Tab Styles */
        .nav-tabs .nav-link {
            color: #495057;
            font-weight: 500;
        }

        .nav-tabs .nav-link.active {
            color: #d63384;
            font-weight: 600;
            border-bottom: 3px solid #d63384;
        }

        /* Dashboard Styles */
        .small-box {
            padding: 10px;
            margin-bottom: 20px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        }

        .small-box .inner {
            padding: 10px;
        }

        .small-box h3 {
            font-size: 24px;
            font-weight: bold;
            margin: 0 0 5px 0;
            color: #333;
        }

        .small-box p {
            font-size: 14px;
            color: #777;
            margin: 0;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
            background-color: #f8f9fa;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        /* Additional styles for the new layout */
        .distribution-container {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .chart-row {
            display: flex;
            flex: 1;
            margin-bottom: 15px;
        }

        .chart-container {
            flex: 1;
            padding: 5px;
        }

        .table-container {
            margin-top: 15px;
        }

        /* Custom colors for charts */
        .chart-legend {
            display: flex;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .chart-legend-item {
            display: flex;
            align-items: center;
            margin-right: 15px;
            margin-bottom: 5px;
        }

        .chart-legend-color {
            width: 12px;
            height: 12px;
            margin-right: 5px;
            border-radius: 3px;
        }
    </style>
@endsection
