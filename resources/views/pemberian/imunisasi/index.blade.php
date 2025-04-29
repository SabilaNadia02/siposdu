@extends('layouts.master')

@section('title', 'Pemberian Imunisasi')

@php
    use Carbon\Carbon;
@endphp

@section('content')
    <!--begin::App Main-->
    <main class="app-main">

        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="mb-0" style="color: #333333;">Pemberian Imunisasi</h3>
                        <p style="color: #777777; white-space: normal;">Halaman ini untuk mengelola data pemberian imunisasi
                            pada peserta posyandu.</p>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="#" style="color: #28A745; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Pemberian Imunisasi</li>
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
                <div class="row">
                    <!--begin::Col-->
                    <div class="col-lg-4 col-md-6 col-12">
                        <!--begin::Small Box Widget 1-->
                        <div class="small-box text-dark" style="background-color: #e9ffe9; border-radius: 2px;">
                            <div class="inner">
                                <h3>{{ $totalPemberian }}</h3>
                                <p>Total Pemberian Imunisasi</p>
                            </div>
                        </div>
                        <!--end::Small Box Widget 1-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

                <!--begin::Row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4" style="border-radius: 0px;">
                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="border-top: 3px solid #28A745; border-radius: 0px;">
                                <h5 class="card-title">Data Pemberian Imunisasi</h5>
                                <button type="button" class="btn btn-success btn-sm ms-auto text-light"
                                    onclick="window.location='{{ route('pemberian.imunisasi.create') }}'">
                                    <i class="bi bi-plus"></i> Tambah Pemberian Imunisasi
                                </button>
                            </div>

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
                                            <th>#</th>
                                            <th>Tanggal Imunisasi</th>
                                            <th>Nama</th>
                                            <th>Usia (Bulan)</th>
                                            <th>Jenis Imunisasi</th>
                                            <th>Keterangan</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($pemberianImunisasi as $key => $item)
                                            @php
                                                $usiaBulan = (int) Carbon::parse(
                                                    $item->pendaftaran->tanggal_lahir,
                                                )->diffInMonths(Carbon::parse($item->waktu_pemberian));
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->waktu_pemberian->format('m/d/Y') }}</td>
                                                <td>{{ $item->pendaftaran->nama }}</td>
                                                <td>{{ $usiaBulan }}</td>
                                                <td>{{ $item->imunisasi->nama ?? '-' }}</td>
                                                <td>{{ $item->keterangan ?? '-' }}</td>
                                                </td>
                                                <td class="text-center">
                                                    <!-- Tombol Edit -->
                                                    <a href="{{ route('pemberian.imunisasi.edit', $item->id) }}"
                                                        class="btn btn-warning btn-sm" title="Edit"
                                                        style="width: 20px; height: 20px; font-size: 10px; padding: 1px;">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <!-- Tombol Hapus -->
                                                    <form action="{{ route('pemberian.imunisasi.destroy', $item->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm btn-hapus"
                                                            title="Hapus"
                                                            style="width: 20px; height: 20px; font-size: 10px; padding: 1px;">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">Tidak ada data pemberian
                                                    imunisasi.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix" style="background-color: white">
                                    <ul class="pagination pagination-sm m-0 float-end">
                                        @if ($pemberianImunisasi->onFirstPage())
                                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                                        @else
                                            <li class="page-item"><a class="page-link"
                                                    style="background-color: #28A745; color: white; border: none;"
                                                    href="{{ $pemberianImunisasi->previousPageUrl() }}">&laquo;</a></li>
                                        @endif
                                        @for ($i = 1; $i <= $pemberianImunisasi->lastPage(); $i++)
                                            <li
                                                class="page-item {{ $pemberianImunisasi->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link"
                                                    style="background-color: {{ $pemberianImunisasi->currentPage() == $i ? '#28A745' : 'white' }}; color: {{ $pemberianImunisasi->currentPage() == $i ? 'white' : '#FF69B4' }}; border: none;"
                                                    href="{{ $pemberianImunisasi->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                        @if ($pemberianImunisasi->hasMorePages())
                                            <li class="page-item"><a class="page-link"
                                                    style="background-color: #28A745; color: white; border: none;"
                                                    href="{{ $pemberianImunisasi->nextPageUrl() }}">&raquo;</a></li>
                                        @else
                                            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Row-->
            </div>
        </div>
        <!--end::App Content-->
    </main>
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
