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
                                <a href="{{ route('dashboard') }}" style="color: #FF8F00; font-size: 16px;">Dashboard</a>
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
                        <div class="small-box text-dark text-center" style="background-color: #ffc107; border-radius: 2px;">
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

                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text" style="border-radius: 2px; color: #FF8F00;">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" class="form-control" id="searchNamaPeserta"
                                placeholder="Cari Nama Peserta.." style="border-radius: 2px;">
                        </div>
                    </div>
                </div>

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

                            <!-- Modal Tambah Skrining -->
                            @include('skrining.ppok.modal.tambah_skrining_ppok')

                            <div class="card-body">

                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

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
                                        @forelse ($skriningPPOK as $skrining)
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
                                                            <div
                                                                class="d-flex justify-content-center align-items-center gap-1">
                                                                <!-- Tombol Edit -->
                                                                <a href="{{ route('skrining.ppok.edit', $skrining->id) }}"
                                                                    class="btn btn-warning btn-sm d-flex justify-content-center align-items-center"
                                                                    title="Edit"
                                                                    style="width: 20px; height: 20px; font-size: 10px; padding: 0px;">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>

                                                                <!-- Tombol Hapus -->
                                                                <form
                                                                    action="{{ route('skrining.ppok.destroy', $skrining->id) }}"
                                                                    method="POST" style="margin: 0;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-sm btn-hapus d-flex justify-content-center align-items-center"
                                                                        title="Hapus"
                                                                        style="width: 20px; height: 20px; font-size: 10px; padding: 0px;">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">Tidak ada data skrining.
                                                </td>
                                            </tr>
                                        @endforelse
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
@endsection

@push('scripts')
    <script>
        document.getElementById("searchNamaPeserta").addEventListener("keyup", function() {
            var input = this.value.toLowerCase();
            var rows = document.querySelectorAll("tbody tr");
            var visibleRows = 0;

            // Pertama, sembunyikan semua baris
            rows.forEach(function(row) {
                row.style.display = "none";
            });

            // Kemudian tampilkan hanya yang sesuai
            rows.forEach(function(row) {
                // Cari sel nama peserta (indeks 2)
                var namaCell = row.cells[2];
                if (namaCell) {
                    var nama = namaCell.textContent.toLowerCase();
                    if (nama.includes(input)) {
                        // Tampilkan baris ini dan semua baris terkait (karena rowspan)
                        var rowspan = parseInt(namaCell.getAttribute('rowspan')) || 1;
                        for (var i = 0; i < rowspan; i++) {
                            if (rows[row.rowIndex - 1 + i]) {
                                rows[row.rowIndex - 1 + i].style.display = "";
                            }
                        }
                        visibleRows++;
                    }
                }
            });

            // Jika tidak ada hasil, tampilkan pesan
            if (visibleRows === 0) {
                // Tambahkan logika untuk menampilkan pesan "tidak ditemukan" jika perlu
            }
        });
        
        $(document).ready(function() {
            $('.btn-hapus').on('click', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#FF8F00',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush

@section('style')
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
