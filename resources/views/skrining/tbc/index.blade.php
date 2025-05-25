@extends('layouts.master')

@section('title', 'Skrining TBC')

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
                        <h3 class="mb-0" style="color: #333333;">Skrining TBC</h3>
                        <p style="color: #777777;">Halaman ini untuk mengelola data Skrining TBC peserta posyandu.</p>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}" style="color: #d63384; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Skrining TBC</li>
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
                        <div class="small-box text-light text-center"
                            style="background-color: #d63384; border-radius: 2px;">
                            <div class="inner">
                                <h3>{{ $totalDenganGejala }}</h3>
                                <p>Total Dengan Gejala</p>
                            </div>
                        </div>
                        <!--end::Small Box Widget 1-->
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-lg-4 col-md-6 col-12">
                        <!--begin::Small Box Widget 2-->
                        <div class="small-box text-dark text-center" style="background-color: #ffdeed; border-radius: 2px;">
                            <div class="inner">
                                <h3>{{ $totalTanpaGejala }}</h3>
                                <p>Total Tanpa Gejala</p>
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
                            <span class="input-group-text" style="border-radius: 2px; color: #d63384;">
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
                                style="border-top: 3px solid #d63384; border-radius: 0px;">
                                <h3 class="card-title">Tabel Data Skrining TBC</h3>
                                <button type="button" class="btn btn-sm ms-auto text-light"
                                    style="background-color: #d63384;" data-bs-toggle="modal"
                                    data-bs-target="#tambahSkringTBCModal">
                                    Tambah Skrining TBC
                                </button>
                            </div>

                            <!-- Modal Tambah Skrining -->
                            @include('skrining.tbc.modal.tambah_skrining_tbc')

                            <div class="card-body">

                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 50px; text-align: center">No</th>
                                            <th style="width: 120px;">Waktu Skrining</th>
                                            <th style="width: 200px;">Nama Peserta</th>
                                            <th style="width: 250px;">Pertanyaan</th>
                                            <th style="width: 100px; text-align: center">Hasil</th>
                                            <th style="width: 120px; text-align: center">Diagnosa</th>
                                            <th style="width: 120px; text-align: center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($skriningTBC as $skrining)
                                            @php
                                                $jumlahYa = $skrining->detailPencatatanSkrining
                                                    ->where('hasil_skrining', 1)
                                                    ->count();
                                                $diagnosa = $jumlahYa > 1 ? 'Ya' : 'Tidak';
                                                $rowspan = $skrining->detailPencatatanSkrining->count();
                                            @endphp

                                            @foreach ($skrining->detailPencatatanSkrining as $index => $detail)
                                                <tr>
                                                    @if ($index === 0)
                                                        <td rowspan="{{ $rowspan }}" style="text-align: center">
                                                            {{ $loop->parent->iteration }}</td>
                                                        <td rowspan="{{ $rowspan }}">
                                                            {{ date('d/m/Y', strtotime($skrining->waktu_skrining)) }}</td>
                                                        <td rowspan="{{ $rowspan }}">
                                                            {{ $skrining->pendaftaran->nama }}</td>
                                                    @endif

                                                    <td>{{ $detail->pertanyaanSkrining->dataPertanyaan->nama_pertanyaan ?? 'N/A' }}
                                                    </td>
                                                    <td style="text-align: center">
                                                        {{ $detail->hasil_skrining == 1 ? 'Y' : 'T' }}</td>

                                                    @if ($index === 0)
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
                                                                <a href="{{ route('skrining.tbc.edit', $skrining->id) }}"
                                                                    class="btn btn-warning btn-sm d-flex justify-content-center align-items-center"
                                                                    title="Edit"
                                                                    style="width: 20px; height: 20px; font-size: 10px; padding: 0px;">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>

                                                                <!-- Tombol Hapus -->
                                                                <form
                                                                    action="{{ route('skrining.tbc.destroy', $skrining->id) }}"
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
                                    @if ($skriningTBC->onFirstPage())
                                        <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link"
                                                style="background-color: #d63384; color: white; border: none;"
                                                href="{{ $skriningTBC->previousPageUrl() }}">&laquo;</a></li>
                                    @endif
                                    @for ($i = 1; $i <= $skriningTBC->lastPage(); $i++)
                                        <li class="page-item {{ $skriningTBC->currentPage() == $i ? 'active' : '' }}">
                                            <a class="page-link"
                                                style="background-color: {{ $skriningTBC->currentPage() == $i ? '#d63384' : 'white' }}; color: {{ $skriningTBC->currentPage() == $i ? 'white' : '#d63384' }}; border: none;"
                                                href="{{ $skriningTBC->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    @if ($skriningTBC->hasMorePages())
                                        <li class="page-item"><a class="page-link"
                                                style="background-color: #d63384; color: white; border: none;"
                                                href="{{ $skriningTBC->nextPageUrl() }}">&raquo;</a></li>
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
                    confirmButtonColor: '#d63384',
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
