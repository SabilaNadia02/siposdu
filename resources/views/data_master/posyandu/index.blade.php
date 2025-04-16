@extends('layouts.master')

@section('title', 'Data Posyandu')

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
                        <h3 class="mb-0" style="color: #333333;">Data Posyandu</h3>
                        <p style="color: #777777;">Halaman ini untuk mengelola data posyandu.</p>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="#" style="color: #FF69B4; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Data Posyandu</li>
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
                                style="border-top: 3px solid #FF69B4; border-radius: 0px;">
                                <h3 class="card-title">Tabel Data Posyandu</h3>
                                <button type="button" class="btn btn-sm ms-auto text-light"
                                    style="background-color: #FF69B4;" data-bs-toggle="modal"
                                    data-bs-target="#tambahPosyanduModal">
                                    Tambah Posyandu
                                </button>
                            </div>

                            <!-- Modal Tambah Posyandu -->
                            @include('data_master.posyandu.modal.tambah_posyandu')

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
                                            <th style="font-size: 15px">Nama Posyandu</th>
                                            <th style="font-size: 15px">Alamat</th>
                                            <th style="width: 100" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($dataposyandu as $key => $posyandu)
                                            <tr class="align-middle">
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $posyandu->nama }}</td>
                                                <td>{{ $posyandu->alamat ?? '-' }}</td>
                                                <td class="text-center">
                                                    <!-- Tombol Edit -->
                                                    <a href="{{ route('data-master.posyandu.edit', $posyandu->id) }}"
                                                        class="btn btn-warning btn-sm" title="Edit"
                                                        style="width: 20px; height: 20px; font-size: 10px; padding: 1px;">
                                                         <i class="fas fa-edit"></i>
                                                     </a>

                                                    <!-- Tombol Hapus -->
                                                    <form
                                                        action="{{ route('data-master.posyandu.destroy', $posyandu->id) }}"
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
                                                <td colspan="4" class="text-center text-muted">Tidak ada data posyandu.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="card-footer clearfix" style="background-color: white">
                                    <ul class="pagination pagination-sm m-0 float-end">
                                        @if ($dataposyandu->onFirstPage())
                                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                                        @else
                                            <li class="page-item"><a class="page-link"
                                                    style="background-color: #FF69B4; color: white; border: none;"
                                                    href="{{ $dataposyandu->previousPageUrl() }}">&laquo;</a></li>
                                        @endif
                                        @for ($i = 1; $i <= $dataposyandu->lastPage(); $i++)
                                            <li
                                                class="page-item {{ $dataposyandu->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link"
                                                    style="background-color: {{ $dataposyandu->currentPage() == $i ? '#FF69B4' : 'white' }}; color: {{ $dataposyandu->currentPage() == $i ? 'white' : '#FF69B4' }}; border: none;"
                                                    href="{{ $dataposyandu->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                        @if ($dataposyandu->hasMorePages())
                                            <li class="page-item"><a class="page-link"
                                                    style="background-color: #FF69B4; color: white; border: none;"
                                                    href="{{ $dataposyandu->nextPageUrl() }}">&raquo;</a></li>
                                        @else
                                            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!--end::Row-->
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
