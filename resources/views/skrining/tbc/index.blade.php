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
                                <a href="#" style="color: #FF69B4; font-size: 16px;">Dashboard</a>
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
                        <div class="small-box text-dark text-center" style="background-color: #ffdeed; border-radius: 2px;">
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

                {{-- <!--begin::Filter Row-->
                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text" style="color: #FF69B4; border-radius: 2px;"><i
                                    class="fas fa-calendar"></i></span>
                            <select class="form-control" id="tahunFilter">
                                <option value="">Semua Tahun</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text" style="color: #FF69B4; border-radius: 2px;"><i
                                    class="fas fa-calendar-alt"></i></span>
                            <select class="form-control" id="bulanFilter">
                                <option value="">Semua Bulan</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text" style="color: #FF69B4; border-radius: 2px;"><i
                                    class="fas fa-map-marker-alt"></i></span>
                            <select class="form-control" id="posyanduFilter">
                                <option value="">Semua Posyandu</option>
                                <option value="Posyandu A">Posyandu Anggrek</option>
                                <option value="Posyandu B">Posyandu Kenanga</option>
                                <option value="Posyandu B">Posyandu Matahari</option>
                                <option value="Posyandu B">Posyandu Mawar</option>
                                <option value="Posyandu B">Posyandu Melati</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text" style="color: #FF69B4; border-radius: 2px;"><i
                                    class="fas fa-bullseye"></i></span>
                            <select class="form-control" id="sasaranFilter" style="border-radius: 2px;">
                                <option value="">Semua Sasaran</option>
                                <option value="Balita">Ibu Hamil</option>
                                <option value="Ibu Hamil">Balita</option>
                                <option value="Lansia">Lansia</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!--end::Filter Row--> --}}

                <!--begin::Row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4" style="border-radius: 0px;">
                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="border-top: 3px solid #FF69B4; border-radius: 0px;">
                                <h3 class="card-title">Tabel Data Skrining TBC</h3>
                                <button type="button" class="btn btn-sm ms-auto text-light"
                                    style="background-color: #FF69B4;" data-bs-toggle="modal"
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
                                                style="background-color: #FF69B4; color: white; border: none;"
                                                href="{{ $skriningTBC->previousPageUrl() }}">&laquo;</a></li>
                                    @endif
                                    @for ($i = 1; $i <= $skriningTBC->lastPage(); $i++)
                                        <li class="page-item {{ $skriningTBC->currentPage() == $i ? 'active' : '' }}">
                                            <a class="page-link"
                                                style="background-color: {{ $skriningTBC->currentPage() == $i ? '#FF69B4' : 'white' }}; color: {{ $skriningTBC->currentPage() == $i ? 'white' : '#FF69B4' }}; border: none;"
                                                href="{{ $skriningTBC->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    @if ($skriningTBC->hasMorePages())
                                        <li class="page-item"><a class="page-link"
                                                style="background-color: #FF69B4; color: white; border: none;"
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

@section('scripts')
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
                    confirmButtonColor: '#FF69B4',
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
@endsection
