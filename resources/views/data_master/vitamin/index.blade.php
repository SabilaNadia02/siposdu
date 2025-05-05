@extends('layouts.master')

@section('title', 'Data Vitamin')

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
                        <h3 class="mb-0" style="color: #333333;">Data Vitamin</h3>
                        <p style="color: #777777;">Halaman ini untuk mengelola data vitamin.</p>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="#" style="color: #d63384; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Data Vitamin</li>
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
                    <div class="col-md-12">
                        <div class="card mb-4" style="border-radius: 0px;">
                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="border-top: 3px solid #d63384; border-radius: 0px;">
                                <h3 class="card-title">Tabel Data Vitamin</h3>
                                <button type="button" class="btn btn-sm ms-auto text-light"
                                    style="background-color: #d63384;" data-bs-toggle="modal"
                                    data-bs-target="#tambahVitaminModal">
                                    Tambah Vitamin
                                </button>
                            </div>

                            <!-- Modal Tambah Vitamin -->
                            @include('data_master.vitamin.modal.tambah_vitamin')
                            
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
                                            <th style="width: 50px">#</th>
                                            <th style="font-size: 15px">Nama Vitamin</th>
                                            <th style="font-size: 15px">Keterangan</th>
                                            <th style="width: 100" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($dataVitamin as $key => $vitamin)
                                            <tr class="align-middle">
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $vitamin->nama }}</td>
                                                <td>{{ $vitamin->keterangan ?? '-'}}</td>
                                                <td class="text-center">
                                                    <!-- Tombol Edit -->
                                                    <a href="{{ route('data-master.vitamin.edit', $vitamin->id) }}"
                                                        class="btn btn-warning btn-sm" title="Edit"
                                                        style="width: 20px; height: 20px; font-size: 10px; padding: 1px;">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <!-- Tombol Hapus -->
                                                    <form
                                                        action="{{ route('data-master.vitamin.destroy', $vitamin->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm btn-hapus"
                                                            title="Hapus"
                                                            style="width: 20px; height: 20px; font-size: 10px; padding: 1px;">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">Tidak ada data vitamin.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix" style="background-color: white">
                                    <ul class="pagination pagination-sm m-0 float-end">
                                        @if ($dataVitamin->onFirstPage())
                                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                                        @else
                                            <li class="page-item"><a class="page-link"
                                                    style="background-color: #d63384; color: white; border: none;"
                                                    href="{{ $dataVitamin->previousPageUrl() }}">&laquo;</a></li>
                                        @endif
                                        @for ($i = 1; $i <= $dataVitamin->lastPage(); $i++)
                                            <li class="page-item {{ $dataVitamin->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link"
                                                    style="background-color: {{ $dataVitamin->currentPage() == $i ? '#d63384' : 'white' }}; color: {{ $dataVitamin->currentPage() == $i ? 'white' : '#d63384' }}; border: none;"
                                                    href="{{ $dataVitamin->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                        @if ($dataVitamin->hasMorePages())
                                            <li class="page-item"><a class="page-link"
                                                    style="background-color: #d63384; color: white; border: none;"
                                                    href="{{ $dataVitamin->nextPageUrl() }}">&raquo;</a></li>
                                        @else
                                            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!--end::Row-->
                </div>
            </div>
        </div>
        <!--end::App Content-->
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
@endsection
