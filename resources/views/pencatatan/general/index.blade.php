@extends('layouts.master')

@section('title', 'Pencatatan')

@section('content')
    <!--begin::App Main-->
    <main class="app-main">

        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-9">
                        <h3 class="mb-0" style="color: #333333;">Pencatatan</h3>
                        <p style="color: #777777; white-space: normal;">Halaman ini untuk mengelola data pencatatan
                            penimbangan/pengukuran/pemeriksaan peserta posyandu.</p>
                    </div>
                    <div class="col-sm-3">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="#" style="color: #FF69B4; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Pencatatan</li>
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

                <div class="row">
                    <!--begin::Col-->
                    <div class="col-lg-4 col-md-6 col-12">
                        <!--begin::Small Box Widget 1-->
                        <div class="small-box text-bg-primary" style="border-radius: 2px;">
                            <div class="inner">
                                <h3>0</h3>
                                <p>Ibu Hamil, Menyusui, dan Nifas</p>
                            </div>

                            <a href="{{ route('pencatatan.ibu.index') }}"
                                class="btn btn-primary btn-sm d-block text-center">
                                Tambah Pencatatan <i class="bi bi-plus"></i>
                            </a>

                            {{-- <button type="button" class="btn btn-primary btn-sm w-100 text-center" data-bs-toggle="modal"
                                data-bs-target="#cariPesertaModal">
                                Tambah Pencatatan <i class="bi bi-plus"></i>
                            </button> --}}
                        </div>
                        @include('pencatatan.general.modal.cari_peserta')
                        <!--end::Small Box Widget 1-->
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-lg-4 col-md-6 col-12">
                        <!--begin::Small Box Widget 2-->
                        <div class="small-box text-bg-success" style="border-radius: 2px;">
                            <div class="inner">
                                <h3>0</h3>
                                <p>Bayi, Balita, dan APRAS</p>
                            </div>
                            <a href="/pencatatan/balita" class="btn btn-success btn-sm d-block text-center">
                                Tambah Pencatatan <i class="bi bi-plus"></i>
                            </a>

                            {{-- <a href="/pencatatan/balita"
                                class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                Tambah Pencatatan <i class="bi bi-plus"></i>
                            </a> --}}

                            {{-- <button type="button" class="btn btn-success btn-sm w-100 text-center" data-bs-toggle="modal"
                                data-bs-target="#cariPesertaModal">
                                Tambah Pencatatan <i class="bi bi-plus"></i>
                            </button> --}}
                        </div>
                        <!--end::Small Box Widget 2-->
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-lg-4 col-md-6 col-12">
                        <!--begin::Small Box Widget 3-->
                        <div class="small-box text-bg-warning" style="border-radius: 2px;">
                            <div class="inner">
                                <h3>0</h3>
                                <p>Usia Produktif dan Lansia</p>
                            </div>
                            <a href="/pencatatan/lansia" class="btn btn-warning btn-sm d-block text-center">
                                Tambah Pencatatan <i class="bi bi-plus"></i>
                            </a>

                            {{-- <a href="/pencatatan/lansia"
                                class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                                Tambah Pencatatan <i class="bi bi-plus"></i>
                            </a> --}}

                            {{-- <button type="button" class="btn btn-warning btn-sm w-100 text-center" data-bs-toggle="modal"
                                data-bs-target="#cariPesertaModal">
                                Tambah Pencatatan <i class="bi bi-plus"></i>
                            </button> --}}
                        </div>
                        <!--end::Small Box Widget 3-->
                    </div>
                    <!--end::Col-->
                </div>

            </div>
        </div>
        <!--end::App Content-->
    </main>
@endsection
