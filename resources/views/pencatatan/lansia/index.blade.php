@extends('layouts.master')

@section('title', 'Pencatatan Lansia')

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
                        <h3 class="mb-0" style="color: #333333;">Pencatatan Lansia</h3>
                        <p style="color: #777777; white-space: normal;">Halaman ini untuk mengelola data pencatatan pada Usia
                            Produktif dan Lansia.</p>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Pencatatan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pencatatan Lansia</li>
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
                        <div class="small-box bg-white border border-warning text-dark">
                            <div class="inner">
                                <h3>0</h3>
                                <p>Total Pencatatan</p>
                            </div>
                        </div>
                        <!--end::Small Box Widget 1-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

                <!--begin::Filter Row-->
                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text text-warning"><i class="fas fa-calendar"></i></span>
                            <select class="form-control" id="tahunFilter">
                                <option value="">Semua Tahun</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                            </select>
                            <span class="input-group-text"><i class="fas fa-chevron-down"></i></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text text-warning"><i class="fas fa-calendar-alt"></i></span>
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
                            <span class="input-group-text"><i class="fas fa-chevron-down"></i></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text text-warning"><i class="fas fa-map-marker-alt"></i></span>
                            <select class="form-control" id="posyanduFilter">
                                <option value="">Semua Posyandu</option>
                                <option value="Posyandu A">Posyandu Anggrek</option>
                                <option value="Posyandu B">Posyandu Kenanga</option>
                                <option value="Posyandu B">Posyandu Matahari</option>
                                <option value="Posyandu B">Posyandu Mawar</option>
                                <option value="Posyandu B">Posyandu Melati</option>
                            </select>
                            <span class="input-group-text"><i class="fas fa-chevron-down"></i></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text text-warning"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" id="searchNoPeserta" placeholder="Cari No Peserta..">
                        </div>
                    </div>
                </div>
                <!--end::Filter Row-->

                <!--begin::Row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Data Lansia</h3>
                                <button type="button" class="btn btn-warning btn-sm ms-auto" data-bs-toggle="modal"
                                    data-bs-target="#cariPesertaModal">
                                    Tambah Pencatatan
                                </button>
                            </div>
                            @include('pencatatan.lansia.modal.cari_peserta')
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="font-size: 15px; width: 10px">#</th>
                                            <th style="font-size: 15px">Nama</th>
                                            <th style="font-size: 15px">Usia (Tahun)</th>
                                            <th style="font-size: 15px; width: 100px" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="align-middle">
                                            <td>1.</td>
                                            <td>Lorem ipsum dolor sit</td>
                                            <td>Lorem ipsum dolor sit</td>
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
                                    <li class="page-item"><a class="page-link text-warning" href="#">&laquo;</a>
                                    </li>
                                    <li class="page-item"><a class="page-link text-warning" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link text-warning" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link text-warning" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link text-warning" href="#">&raquo;</a>
                                    </li>
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

    <script>
        document.getElementById("searchNoPeserta").addEventListener("keyup", function() {
            var input = this.value.toLowerCase();
            var rows = document.querySelectorAll("#dataRujukan tr");

            rows.forEach(function(row) {
                var nama = row.cells[1].textContent.toLowerCase();
                if (nama.includes(input)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    </script>

@endsection
