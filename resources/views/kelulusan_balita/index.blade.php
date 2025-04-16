@extends('layouts.master')

@section('title', 'Kelulusan Balita')

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
                        <h3 class="mb-0" style="color: #333333;">Kelulusan Balita</h3>
                        <p style="color: #777777;">Halaman ini untuk mengelola data kelulusan balita posyandu.</p>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#" class="text-success">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Rujukan</li>
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

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!--begin::Row-->
                <div class="row justify-content-center">
                    <!--begin::Col-->
                    <div class="col-lg-4 col-md-6 col-12">
                        <!--begin::Small Box Widget 3-->
                        <a href="{{ route('kelulusan-balita.index') }}" class="text-decoration-none">
                            <div class="small-box text-dark text-center {{ $statusFilter === 'all' ? 'bg-success text-white' : 'bg-light' }}"
                                style="border-radius: 2px; cursor: pointer;">
                                <div class="inner">
                                    <h3>{{ $balitaAktif + $balitaLulus }}</h3>
                                    <p>Semua Balita</p>
                                </div>
                            </div>
                        </a>
                        <!--end::Small Box Widget 3-->
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-lg-4 col-md-6 col-12">
                        <!--begin::Small Box Widget 1-->
                        <a href="{{ route('kelulusan-balita.index', ['status' => 'active']) }}"
                            class="text-decoration-none">
                            <div class="small-box text-dark text-center {{ $statusFilter === 'active' ? 'bg-success text-white' : 'bg-light' }}"
                                style="border-radius: 2px; cursor: pointer;">
                                <div class="inner">
                                    <h3>{{ $balitaAktif }}</h3>
                                    <p>Total Balita Aktif</p>
                                </div>
                            </div>
                        </a>
                        <!--end::Small Box Widget 1-->
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-lg-4 col-md-6 col-12">
                        <!--begin::Small Box Widget 2-->
                        <a href="{{ route('kelulusan-balita.index', ['status' => 'graduated']) }}"
                            class="text-decoration-none">
                            <div class="small-box text-dark text-center {{ $statusFilter === 'graduated' ? 'bg-success text-white' : 'bg-light' }}"
                                style="border-radius: 2px; cursor: pointer;">
                                <div class="inner">
                                    <h3>{{ $balitaLulus }}</h3>
                                    <p>Total Balita Lulus</p>
                                </div>
                            </div>
                        </a>
                        <!--end::Small Box Widget 2-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

                <!--begin::Filter Row-->
                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text text-success"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" id="searchNamaBalita"
                                placeholder="Cari Nama Balita..">
                        </div>
                    </div>
                </div>
                <!--end::Filter Row-->

                <!--begin::Row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4" style="border-radius: 0px;">
                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="border-top: 3px solid #198754; border-radius: 0px;">
                                <h3 class="card-title">Tabel Data Kelulusan Balita</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataBalita">
                                        <thead>
                                            <tr>
                                                <th style="font-size: 15px; width: 30px">No Pendaftaran</th>
                                                <th style="font-size: 15px; width: 300px">Nama</th>
                                                <th style="font-size: 15px; width: 100px">Jenis Kelamin</th>
                                                <th style="font-size: 15px; width: 300px">Usia</th>
                                                <th style="font-size: 15px; width: 100px" class="text-center">Aksi</th>
                                            </tr>
                                        </thead>

                                        <tbody id="tableBody">
                                            @forelse ($balitas as $balita)
                                                <tr class="align-middle">
                                                    <td>{{ str_pad($balita->pendaftaran->id, 4, '0', STR_PAD_LEFT) }}</td>
                                                    <td>{{ $balita->pendaftaran->nama ?? '-' }}</td>
                                                    <td>{{ $balita->pendaftaran->jenis_kelamin == '1' ? 'L' : 'P' }}</td>
                                                    <td>{{ $balita->getAgeString() }}</td>
                                                    <td class="text-center">
                                                        @if ($balita->status_balita == 2)
                                                            <button class="btn btn-secondary btn-sm" disabled>
                                                                Sudah Lulus
                                                            </button>
                                                        @else
                                                            <form
                                                                action="{{ route('kelulusan-balita.update', $balita->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-success btn-sm"
                                                                    {{ !$balita->isEligibleForGraduation() ? 'disabled' : '' }}>
                                                                    Luluskan
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">Tidak ada data ditemukan</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Row-->
            </div>
        </div>
    </main>
    <!--end::App Main-->

    <script>
        document.getElementById("searchNamaBalita").addEventListener("keyup", function() {
            var input = this.value.toLowerCase();
            var rows = document.querySelectorAll("#tableBody tr");
            var noResults = true;

            // Show/hide rows based on search
            rows.forEach(function(row) {
                var nama = row.cells[1].textContent.toLowerCase();
                if (nama.includes(input)) {
                    row.style.display = "";
                    noResults = false;
                } else {
                    row.style.display = "none";
                }
            });

            // Show "No results" message if needed
            var noResultsRow = document.querySelector("#tableBody tr td[colspan='5']");
            if (noResults) {
                if (!noResultsRow) {
                    var tbody = document.getElementById("tableBody");
                    tbody.innerHTML = '<tr><td colspan="5" class="text-center">Tidak ada data yang cocok</td></tr>';
                }
            } else if (noResultsRow) {
                noResultsRow.parentNode.remove();
            }
        });
    </script>

    <!-- Keep your existing styles -->
    <style>
        .small-box {
            transition: all 0.3s ease;
            border: 1px solid #dee2e6;
        }

        .small-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .small-box.bg-success {
            background-color: #198754 !important;
        }

        .small-box .inner h3 {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .small-box .inner p {
            margin-bottom: 0;
        }

        .table-responsive {
            overflow-x: auto;
        }
    </style>

@endsection

@php
    function hitungUsiaBalita($htp)
    {
        $htpDate = new DateTime($htp);
        $now = new DateTime();
        $interval = $now->diff($htpDate);

        return $interval->y . ' Tahun ' . $interval->m . ' Bulan ' . $interval->d . ' Hari';
    }
@endphp
