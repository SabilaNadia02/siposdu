@extends('layouts.master')

@section('title', 'Data Pengguna')

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
                        <h3 class="mb-0" style="color: #333333;">Data Pengguna</h3>
                        <p style="color: #777777;">Halaman ini untuk mengelola data pengguna.</p>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="#" style="color: #FF69B4; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Data Pengguna</li>
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
                                <h3 class="card-title">Tabel Data Pengguna</h3>
                                <button type="button" class="btn btn-sm ms-auto text-light"
                                    style="background-color: #FF69B4;" data-bs-toggle="modal"
                                    data-bs-target="#tambahPenggunaModal">
                                    Tambah Pengguna
                                </button>
                            </div>
                            @include('data_master.pengguna.modal.tambah_pengguna')
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 50px">#</th>
                                            <th style="font-size: 15px">Nama Pengguna</th>
                                            <th style="font-size: 15px">Email</th>
                                            <th style="font-size: 15px">Peran</th>
                                            <th style="width: 100" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($penggunas as $index => $pengguna)
                                            <tr class="align-middle">
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $pengguna->nama }}</td>
                                                <td>{{ $pengguna->email }}</td>
                                                <td>
                                                    @if ($pengguna->peran == 1)
                                                        Admin
                                                    @elseif($pengguna->peran == 2)
                                                        Nakes (Bidan/Perawat)
                                                    @else
                                                        Kader
                                                    @endif
                                                </td>
                                                {{-- <td class="text-center">
                                                    <a href="{{ route('pengguna.show', $pengguna->id) }}"
                                                        class="btn btn-info" title="Lihat">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('pengguna.edit', $pengguna->id) }}"
                                                        class="btn btn-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('pengguna.destroy', $pengguna->id) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td> --}}
                                                <td class="text-center">
                                                    <a href="#" class="btn btn-info" title="Lihat"
                                                        style="width: 20px; height: 20px; font-size: 10px; padding: 1px; display: inline-flex; justify-content: center; align-items: center;">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-warning" title="Edit"
                                                        style="width: 20px; height: 20px; font-size: 10px; padding: 1px; display: inline-flex; justify-content: center; align-items: center;">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-danger" title="Hapus"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                                                        style="width: 20px; height: 20px; font-size: 10px; padding: 1px; display: inline-flex; justify-content: center; align-items: center;">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
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
        </div>
        <!--end::App Content-->
    </main>
    <!--end::App Main-->
@endsection
