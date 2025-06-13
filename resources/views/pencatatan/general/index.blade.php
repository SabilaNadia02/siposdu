@extends('layouts.master')

@section('title', 'Pencatatan')

@section('content')
    <!--begin::App Main-->
    <main class="app-main">

        <!--begin::App Content Header-->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-9">
                        <h3 class="mb-0" style="color: #333333;">Pencatatan</h3>
                        <p style="color: #777777; white-space: normal;">Halaman ini untuk mengelola data pencatatan
                            penimbangan/pengukuran/pemeriksaan peserta posyandu.</p>
                    </div>
                    <div class="col-sm-3">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}" style="color: #d63384; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Pencatatan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!--end::App Content Header-->

        <!--begin::App Content-->
        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="small-box text-bg-primary" style="border-radius: 2px;">
                            <div class="inner">
                                <h3>{{ $jumlahIbu }}</h3>
                                <p>Ibu Hamil, Menyusui, dan Nifas</p>
                            </div>
                            <a href="{{ route('pencatatan.ibu.index') }}"
                                class="btn btn-primary btn-sm d-block text-center">
                                Tambah Pencatatan <i class="bi bi-plus"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="small-box text-bg-success" style="border-radius: 2px;">
                            <div class="inner">
                                <h3>{{ $jumlahBalita }}</h3>
                                <p>Bayi, Balita, dan APRAS</p>
                            </div>
                            <a href="{{ route('pencatatan.balita.index') }}" class="btn btn-success btn-sm d-block text-center">
                                Tambah Pencatatan <i class="bi bi-plus"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="small-box text-bg-warning" style="border-radius: 2px;">
                            <div class="inner">
                                <h3>{{ $jumlahLansia }}</h3>
                                <p>Usia Produktif dan Lansia</p>
                            </div>
                            <a href="{{ route('pencatatan.lansia.index') }}" class="btn btn-warning btn-sm d-block text-center">
                                Tambah Pencatatan <i class="bi bi-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::App Content-->
    </main>
@endsection
