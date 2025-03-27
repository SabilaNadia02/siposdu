@extends('layouts.master')

@section('title', 'Data Skrining')

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
                        <h3 class="mb-0" style="color: #333333;">Data Skrining</h3>
                        <p style="color: #777777;">Halaman ini untuk mengelola data skrining.</p>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="#" style="color: #FF69B4; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Data Skrining</li>
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
                                <h3 class="card-title">Tabel Data Skrining</h3>
                                <button type="button" class="btn btn-sm ms-auto text-light"
                                    style="background-color: #FF69B4;" data-bs-toggle="modal"
                                    data-bs-target="#tambahSkriningModal">
                                    Tambah Skrining
                                </button>
                            </div>
                            @include('data_master.skrining.modal.tambah_skrining')
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 50px">#</th>
                                            <th style="font-size: 15px">Nama Skrining</th>
                                            <th style="font-size: 15px">Keterangan</th>
                                            <th style="width: 100" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($dataskrining as $key => $skrining)
                                            <tr class="align-middle">
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $skrining->nama_skrining ?? '-' }}</td>
                                                <td>{{ $skrining->keterangan ?? '-' }}</td>
                                                <td class="text-center">
                                                    {{-- <a href="{{ route('data-master.skrining.show', $skrining->id) }}" class="btn btn-info" title="Lihat"
                                                        style="width: 20px; height: 20px; font-size: 10px; padding: 1px; display: inline-flex; justify-content: center; align-items: center;">
                                                        <i class="fas fa-eye"></i>
                                                    </a> --}}
                                                    <a href="{{ route('data-master.skrining.edit', $skrining->id) }}"
                                                        class="btn btn-warning" title="Edit"
                                                        style="width: 20px; height: 20px; font-size: 10px; padding: 1px; display: inline-flex; justify-content: center; align-items: center;">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form
                                                        action="{{ route('data-master.skrining.destroy', $skrining->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" title="Hapus"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                                                            style="width: 20px; height: 20px; font-size: 10px; padding: 1px; display: inline-flex; justify-content: center; align-items: center;">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">Tidak ada data skrining.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix" style="background-color: white">
                                <ul class="pagination pagination-sm m-0 float-end">
                                    <li class="page-item"><a class="page-link" style="color: #FF69B4;"
                                            href="#">&laquo;</a></li>
                                    <li class="page-item"><a class="page-link" style="color: #FF69B4;" href="#">1</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" style="color: #FF69B4;" href="#">2</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" style="color: #FF69B4;" href="#">3</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" style="color: #FF69B4;"
                                            href="#">&raquo;</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!--end::Row-->
            </div>
            <!--end::App Content-->
        </div>
    </main>
    <!--end::App Main-->
@endsection
