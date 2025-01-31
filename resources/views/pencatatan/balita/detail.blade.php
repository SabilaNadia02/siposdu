@extends('layouts.master')

@section('title', 'Riwayat Pencatatan Balita')

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
                        <h3 class="mb-0" style="color: #333333;">Pencatatan Penimbangan dan Pengukuran</h3>
                        <p style="color: #777777; white-space: normal;">Halaman ini untuk mengelola data riwayat pencatatan.
                        </p>
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

                <!--end::Row-->

                <!--begin::Row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Tabel Riwayat Pencatatan</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Usia (Bulan)</th>
                                            <th>Waktu Datang ke Posyandu</th>
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

                <!--begin::Row-->
                <!-- begin:: Tabbed Widget -->
                <div class="card mb-4">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1"
                                    type="button" role="tab" aria-controls="tab1" aria-selected="true">Grafik Berat
                                    Badan Menurut Panjang Badan</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2"
                                    type="button" role="tab" aria-controls="tab2" aria-selected="false">Grafik IMT
                                    Menurut Umur</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab3"
                                    type="button" role="tab" aria-controls="tab3" aria-selected="false">Grafik Panjang
                                    Badan Menurut Umur</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tab4-tab" data-bs-toggle="tab" data-bs-target="#tab4"
                                    type="button" role="tab" aria-controls="tab3" aria-selected="false">Grafik Lingkar
                                    Kepala</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <!-- Tab 1 Content -->
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel"
                                aria-labelledby="tab1-tab">
                                <h5>Grafik Berat Badan Menurut Panjang Badan</h5>
                                <p>Ini adalah konten untuk tab pertama.</p>

                                <!--begin::Row-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Kategori</th>
                                                            <th>Keterangan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th>
                                                                < -3 SD</th>
                                                            <td>Sangat Kurus</td>
                                                        </tr>
                                                        <tr>
                                                            <th>-3 SD sampai dengan < -2 SD</th>
                                                            <td>Kurus</td>
                                                        </tr>
                                                        <tr>
                                                            <th>-2 SD sampai dengan 2 SD</th>
                                                            <td>Normal</td>
                                                        </tr>
                                                        <tr>
                                                            <th>> 2 SD</th>
                                                            <td>Gemuk</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!--end::Row-->

                                <!--begin::Row-->
                                <div class="row">
                                    <!-- Start col -->
                                    <div class="col-lg-12">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <h5 class="card-title">Grafik pertumbuhan Sejak Lahir - 2 Tahun (z-scores)
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <div id="revenue-chart"></div>
                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <!-- /.Start col -->
                                </div>
                                <!--end::Row-->

                                <!--begin::Row-->
                                <div class="row">
                                    <!-- Start col -->
                                    <div class="col-lg-12">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <h5 class="card-title">Grafik pertumbuhan 2 Tahun - 5 Tahun (z-scores)</h5>
                                            </div>
                                            <div class="card-body">
                                                <div id="revenue-chart"></div>
                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <!-- /.Start col -->
                                </div>
                                <!--end::Row-->

                                {{-- <!-- Tab 2 Content -->
                                <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                                    <h5>Grafik Index Massa Tubuh (IMT) Menurut Umur</h5>
                                    <p>Ini adalah konten untuk tab kedua.</p>
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!-- Start col -->
                                        <div class="col-lg-12">
                                            <div class="card mb-4">
                                                <div class="card-header">
                                                    <h5 class="card-title">Grafik pertumbuhan 5 Tahun - 6 Tahun (z-scores)
                                                    </h5>
                                                </div>
                                                <div class="card-body">
                                                    <div id="revenue-chart"></div>
                                                </div>
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        <!-- /.Start col -->
                                    </div>
                                    <!--end::Row-->

                                </div>

                                <!-- Tab 3 Content -->
                                <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                                    <h5>Grafik Panjang Badan Menurut Umur</h5>
                                    <p>Ini adalah konten untuk tab ketiga.</p>

                                    <!--begin::Row-->
                                    <div class="row">
                                        <!-- Start col -->
                                        <div class="col-lg-12">
                                            <div class="card mb-4">
                                                <div class="card-header">
                                                    <h5 class="card-title">Grafik pertumbuhan Sejak Lahir - 6 Bulan
                                                        (z-scores)</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div id="revenue-chart"></div>
                                                </div>
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        <!-- /.Start col -->
                                    </div>
                                    <!--end::Row-->

                                    <!--begin::Row-->
                                    <div class="row">
                                        <!-- Start col -->
                                        <div class="col-lg-12">
                                            <div class="card mb-4">
                                                <div class="card-header">
                                                    <h5 class="card-title">Grafik pertumbuhan 6 Bulan - 2 Tahun (z-scores)
                                                    </h5>
                                                </div>
                                                <div class="card-body">
                                                    <div id="revenue-chart"></div>
                                                </div>
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        <!-- /.Start col -->
                                    </div>
                                    <!--end::Row-->

                                    <!--begin::Row-->
                                    <div class="row">
                                        <!-- Start col -->
                                        <div class="col-lg-12">
                                            <div class="card mb-4">
                                                <div class="card-header">
                                                    <h5 class="card-title">Grafik pertumbuhan 2 Tahun - 5 Tahun (z-scores)
                                                    </h5>
                                                </div>
                                                <div class="card-body">
                                                    <div id="revenue-chart"></div>
                                                </div>
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        <!-- /.Start col -->
                                    </div>
                                    <!--end::Row-->
                                </div>

                                <!-- Tab 4 Content -->
                                <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">
                                    <h5>Grafik Lingkar Kepala</h5>
                                    <p>Ini adalah konten untuk tab keempat.</p>

                                    <!--begin::Row-->
                                    <div class="row">
                                        <!-- Start col -->
                                        <div class="col-lg-12">
                                            <div class="card mb-4">
                                                <div class="card-header">
                                                    <h5 class="card-title">Grafik pertumbuhan Sejak Lahir - 5 Tahun</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div id="revenue-chart"></div>
                                                </div>
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        <!-- /.Start col -->
                                    </div>
                                    <!--end::Row-->
                                </div> --}}

                            </div>
                        </div>
                    </div>
                    <!-- end:: Tabbed Widget -->
                    <!--end::Row-->

                </div>
            </div>
    </main>
@endsection
