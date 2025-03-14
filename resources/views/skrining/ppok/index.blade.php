@extends('layouts.master')

@section('title', 'Skrining PPOK')

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
                        <h3 class="mb-0" style="color: #333333;">Skrining PPOK</h3>
                        <p style="color: #777777;">Halaman ini untuk mengelola data Skrining PPOK peserta posyandu.</p>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#"
                                    style="color: #FF8F00; font-size: 16px;">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Skrining PPOK</li>
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
                <div class="row justify-content-center">
                    <!--begin::Col-->
                    <div class="col-lg-4 col-md-6 col-12">
                        <!--begin::Small Box Widget 1-->
                        <div class="small-box text-dark text-center" style="background-color: #FFE0B2; border-radius: 2px;">
                            <div class="inner">
                                <h3>0</h3>
                                <p>Total Dengan Gejala</p>
                            </div>
                        </div>
                        <!--end::Small Box Widget 1-->
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-lg-4 col-md-6 col-12">
                        <!--begin::Small Box Widget 2-->
                        <div class="small-box text-dark text-center" style="background-color: #FFE0B2; border-radius: 2px;">
                            <div class="inner">
                                <h3>0</h3>
                                <p>Total Tanpa Gejala</p>
                            </div>
                        </div>
                        <!--end::Small Box Widget 2-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

                <!--begin::Filter Row-->
                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text text-warning"><i class="fas fa-calendar"
                                    style="border-radius: 2px; color: #FF8F00;"></i></span>
                            <select class="form-control" id="tahunFilter" style="border-radius: 2px;">
                                <option value="">Semua Tahun</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                            </select>
                            <span class="input-group-text" style="border-radius: 2px;"><i
                                    class="fas fa-chevron-down"></i></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text text-warning"><i class="fas fa-calendar-alt"
                                    style="border-radius: 2px; color: #FF8F00;"></i></span>
                            <select class="form-control" id="bulanFilter" style="border-radius: 2px;">
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
                            <span class="input-group-text" style="border-radius: 2px;"><i
                                    class="fas fa-chevron-down"></i></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text text-warning"><i class="fas fa-map-marker-alt"
                                    style="border-radius: 2px; color: #FF8F00;"></i></span>
                            <select class="form-control" id="posyanduFilter" style="border-radius: 2px;">
                                <option value="">Semua Posyandu</option>
                                <option value="Posyandu A">Posyandu Anggrek</option>
                                <option value="Posyandu B">Posyandu Kenanga</option>
                                <option value="Posyandu B">Posyandu Matahari</option>
                                <option value="Posyandu B">Posyandu Mawar</option>
                                <option value="Posyandu B">Posyandu Melati</option>
                            </select>
                            <span class="input-group-text" style="border-radius: 2px;"><i
                                    class="fas fa-chevron-down"></i></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text text-warning"><i class="fas fa-bullseye"
                                    style="border-radius: 2px; color: #FF8F00;"></i></span>
                            <select class="form-control" id="sasaranFilter" style="border-radius: 2px;">
                                <option value="">Semua Sasaran</option>
                                <option value="Balita">Ibu Hamil</option>
                                <option value="Ibu Hamil">Balita</option>
                                <option value="Lansia">Lansia</option>
                            </select>
                            <span class="input-group-text" style="border-radius: 2px;"><i
                                    class="fas fa-chevron-down"></i></span>
                        </div>
                    </div>
                </div>
                <!--end::Filter Row-->

                <!--begin::Row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4" style="border-radius: 2px;">
                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="border-top: 3px solid #FF8F00; border-radius: 2px;">
                                <h3 class="card-title">Tabel Data Skrining PPOK</h3>
                                <button type="button" class="btn btn-sm ms-auto text-light"
                                    style="background-color: #FF8F00;" data-bs-toggle="modal"
                                    {{-- data-bs-target="#cariPesertaModal"> --}}
                                    data-bs-target="#tambahSkringPPOKModal">
                                    Tambah Skrining PPOK
                                </button>
                            </div>
                            @include('skrining.ppok.modal.cari_peserta')
                            @include('skrining.ppok.modal.tambah_skrining_ppok')
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="font-size: 15px; width: 160px">Waktu Skrining <span
                                                    style="font-size: smaller; font-weight: normal;">(tanggal/bulan/tahun)</span>
                                            </th>
                                            <th style="font-size: 15px; width: 300px">Nama</th>
                                            <th style="font-size: 15px; width: 160px">Hasil Skrining</th>
                                            <th style="font-size: 15px; width: 260px">Keterangan</th>
                                            <th style="font-size: 15px; width: 100px" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="align-middle">
                                            <td>31-01-2025</td>
                                            <td>Lorem ipsum dolor sit</td>
                                            <td>Positif</td>
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
                                            <td>Lorem ipsum dolor sit</td>
                                            <td>Negatif</td>
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
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix" style="background-color: white">
                                <ul class="pagination pagination-sm m-0 float-end">
                                    <li class="page-item"><a class="page-link" style="color: #FF8F00;"
                                            href="#">&laquo;</a></li>
                                    <li class="page-item"><a class="page-link" style="color: #FF8F00;"
                                            href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" style="color: #FF8F00;"
                                            href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" style="color: #FF8F00;"
                                            href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" style="color: #FF8F00;"
                                            href="#">&raquo;</a></li>
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
