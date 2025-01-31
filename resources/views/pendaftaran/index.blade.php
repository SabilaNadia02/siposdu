@extends('layouts.master')

@section('title', 'Pendaftaran')

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
                        <h3 class="mb-0" style="color: #333333;">Pendaftaran</h3>
                        <p style="color: #777777;">Halaman ini untuk mengelola data pendaftaran peserta posyandu.</p>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pendaftaran</li>
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
                        <div class="small-box bg-primary text-light">
                            <div class="inner">
                                <h3>0</h3>
                                <p>Total Pendaftaran</p>
                            </div>
                        </div>
                        <!--end::Small Box Widget 1-->
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-lg-4 col-md-6 col-12">
                        <!--begin::Small Box Widget 1-->
                        <div class="small-box bg-primary text-light">
                            <div class="inner">
                                <h3>0</h3>
                                <p>Total Laki-Laki </p>
                            </div>
                        </div>
                        <!--end::Small Box Widget 1-->
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-lg-4 col-md-6 col-12">
                        <!--begin::Small Box Widget 1-->
                        <div class="small-box bg-primary text-light">
                            <div class="inner">
                                <h3>0</h3>
                                <p>Total Perempuan</p>
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
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="border-top: 3px solid #0d6efd;">
                                <h3 class="card-title">Tabel Data Pendaftaran</h3>
                                <button type="button" class="btn btn-primary btn-sm ms-auto" data-bs-toggle="modal"
                                    data-bs-target="#addDataModal">
                                    Tambah Pendaftaran
                                </button>
                            </div>
                            @include('pendaftaran.modal.create')
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 80px">No Peserta</th>
                                            <th>Nama</th>
                                            <th style="width: 90px">Jenis Kelamin</th>
                                            <th style="width: 100px">Tanggal Lahir</th>
                                            <th style="width: 90px">Usia</th>
                                            <th style="width: 130px">Status Perkawinan</th>
                                            <th style="width: 130px">Alamat <br>
                                                <span style="font-size: smaller; font-weight: normal;">(Dusun
                                                    RT/RW)</span>
                                            </th>
                                            <th style="width: 100" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="align-middle">
                                            <td>0001</td>
                                            <td>Sabila Nadia Islamia</td>
                                            <td>P</td>
                                            <td>02-09-2002</td>
                                            <td>22 Tahun</td>
                                            <td>Tidak Menikah</td>
                                            <td>Jambean 2/1</td>
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
                                        <tr class="align-middle">
                                            <td>0002</td>
                                            <td>Musriati</td>
                                            <td>P</td>
                                            <td>22-07-1971</td>
                                            <td>53 Tahun</td>
                                            <td>Menikah</td>
                                            <td>Jambean 2/1</td>
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
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-end">
                                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
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
