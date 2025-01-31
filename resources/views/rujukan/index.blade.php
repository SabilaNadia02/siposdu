@extends('layouts.master')

@section('title', 'Rujukan')

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
                        <h3 class="mb-0" style="color: #333333;">Rujukan</h3>
                        <p style="color: #777777;">Halaman ini untuk mengelola data rujukan peserta posyandu.</p>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Rujukan</li>
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
                                <p>Total Rujukan</p>
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
                                <p>Total Rujukan Laki-Laki </p>
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
                                <p>Total Rujukan Perempuan</p>
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
                            <span class="input-group-text text-primary"><i class="fas fa-calendar"></i></span>
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
                            <span class="input-group-text text-primary"><i class="fas fa-calendar-alt"></i></span>
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
                            <span class="input-group-text text-primary"><i class="fas fa-map-marker-alt"></i></span>
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
                            <span class="input-group-text text-primary"><i class="fas fa-bullseye"></i></span>
                            <select class="form-control" id="sasaranFilter">
                                <option value="">Semua Sasaran</option>
                                <option value="Balita">Ibu Hamil</option>
                                <option value="Ibu Hamil">Balita</option>
                                <option value="Lansia">Lansia</option>
                            </select>
                            <span class="input-group-text"><i class="fas fa-chevron-down"></i></span>
                        </div>
                    </div>
                </div>
                <!--end::Filter Row-->

                <!--begin::Row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="border-top: 3px solid #0d6efd;">
                                <h3 class="card-title">Tabel Data Rujukan</h3>
                                <button type="button" class="btn btn-primary btn-sm ms-auto" data-bs-toggle="modal"
                                    data-bs-target="#cariPesertaModal">
                                    Tambah Rujukan
                                </button>
                            </div>
                            @include('general_modal.cari_peserta')
                            {{-- @include('rujukan.modal.tambah_rujukan') --}}
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="font-size: 15px; width: 160px">Waktu Rujukan <span
                                                    style="font-size: smaller; font-weight: normal;">(tanggal/bulan/tahun)</span>
                                            </th>
                                            <th style="font-size: 15px; width: 300px">Nama</th>
                                            <th style="font-size: 15px; width: 160px">Jenis Rujukan</th>
                                            <th style="font-size: 15px; width: 260px">Keterangan</th>
                                            <th style="font-size: 15px; width: 100" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="align-middle">
                                            <td>31-01-2025</td>
                                            <td>Sabila Nadia Islamia</td>
                                            <td>Rumah Sakit</td>
                                            <td>-</td>
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
                                            <td>31-01-2025</td>
                                            <td>Nilea Larasati Putri Kahiyang</td>
                                            <td>Puskesmas</td>
                                            <td>Demam tidak kunjung turun. Sudah habis diberikan obat satu botol sirup
                                                paracetamol.</td>
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
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
                <!--end::Row-->
                
            </div>
        </div>
    </main>
    <!--end::App Main-->
@endsection
