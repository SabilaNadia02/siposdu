@extends('layouts.master')

@section('title', 'Pencatatan Balita')

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
                        <h3 class="mb-0" style="color: #333333;">Pencatatan Balita</h3>
                        <p style="color: #777777; white-space: normal;">Halaman ini untuk mengelola data pencatatan pada
                            Bayi, Balita, dan APRAS.</p>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Pencatatan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pencatatan Balita</li>
                        </ol>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">

                <!--begin::Row-->
                <div class="row">
                    <!--begin::Col-->
                    <div class="col-lg-3 col-md-6 col-12">
                        <!--begin::Small Box Widget 1-->
                        <div class="small-box bg-white border border-success link-success">
                            <div class="inner">
                                <h3>0</h3>
                                <p>Total Pencatatan</p>
                            </div>
                            <a href="#"
                                class="small-box-footer bg-success link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                Tambah Pencatatan <i class="bi bi-plus"></i>
                            </a>
                        </div>
                        <!--end::Small Box Widget 1-->
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-lg-3 col-md-6 col-12">
                        <!--begin::Small Box Widget 1-->
                        <div class="small-box bg-white border border-success link-success">
                            <div class="inner">
                                <h3>0</h3>
                                <p>Pemberian Imunisasi</p>
                            </div>
                            <a href="#"
                                class="small-box-footer bg-success link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                Kelola Imunisasi <i class="bi bi-pencil-square"></i>
                            </a>
                        </div>
                        <!--end::Small Box Widget 1-->
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-lg-3 col-md-6 col-12">
                        <!--begin::Small Box Widget 1-->
                        <div class="small-box bg-white border border-success link-success">
                            <div class="inner">
                                <h3>0</h3>
                                <p>Pemberian Vitamin</p>
                            </div>
                            <a href="#"
                                class="small-box-footer bg-success link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                Kelola Vitamin <i class="bi bi-pencil-square"></i>
                            </a>
                        </div>
                        <!--end::Small Box Widget 1-->
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-lg-3 col-md-6 col-12">
                        <!--begin::Small Box Widget 1-->
                        <div class="small-box bg-white border border-success link-success">
                            <div class="inner">
                                <h3>0</h3>
                                <p>Total Gejala TBC</p>
                            </div>
                            <a href="#"
                                class="small-box-footer bg-success link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                Kelola Gejala <i class="bi bi-pencil-square"></i>
                            </a>
                        </div>
                        <!--end::Small Box Widget 1-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

                <!--begin::Row-->
                <div class="row">
                    <!--begin::Col-->
                    <div class="col-lg-3 col-md-6 col-12">
                        <!--begin::Small Box Widget 1-->
                        <div class="small-box bg-white border border-success link-success">
                            <div class="inner">
                                <h3>0</h3>
                                <p>Total Kelulusan Balita</p>
                            </div>
                            <a href="#"
                                class="small-box-footer bg-success link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                Kelola Kelulusan <i class="bi bi-pencil-square"></i>
                            </a>
                        </div>
                        <!--end::Small Box Widget 1-->
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-lg-3 col-md-6 col-12">
                        <!--begin::Small Box Widget 1-->
                        <div class="small-box bg-white border border-success link-success">
                            <div class="inner">
                                <h3>0</h3>
                                <p>Total Rujukan</p>
                            </div>
                            <a href="#"
                                class="small-box-footer bg-success link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                Kelola Rujukan <i class="bi bi-pencil-square"></i>
                            </a>
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
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Data Balita</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Nama</th>
                                            <th>Usia (Bulan)</th>
                                            <th style="width: 80px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="align-middle">
                                            <td>1.</td>
                                            <td>Lorem ipsum dolor sit</td>
                                            <td>Lorem ipsum dolor sit</td>
                                            <td></td>
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
    </main>
@endsection
