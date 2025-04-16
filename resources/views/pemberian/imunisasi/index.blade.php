@extends('layouts.master')

@section('title', 'Pemberian Imunisasi')

@php
    use Carbon\Carbon;
@endphp

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
                        <h3 class="mb-0" style="color: #333333;">Pemberian Imunisasi</h3>
                        <p style="color: #777777; white-space: normal;">Halaman ini untuk mengelola data pemberian imunisasi
                            pada peserta posyandu.</p>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="#" style="color: #28A745; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Pemberian Imunisasi</li>
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
                        <div class="small-box text-dark" style="background-color: #e9ffe9; border-radius: 2px;">
                            <div class="inner">
                                <h3>0</h3>
                                <p>Total Pemberian Imunisasi</p>
                            </div>
                        </div>
                        <!--end::Small Box Widget 1-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

                <!--begin::Filter Row-->
                {{-- <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text" style="color: #28A745;"><i class="fas fa-calendar"></i></span>
                            <select class="form-control" id="tahunFilter">
                                <option value="">Semua Tahun</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text" style="color: #28A745;"><i
                                    class="fas fa-calendar-alt"></i></span>
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
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text" style="color: #28A745;"><i
                                    class="fas fa-map-marker-alt"></i></span>
                            <select class="form-control" id="posyanduFilter">
                                <option value="">Semua Posyandu</option>
                                <option value="Posyandu A">Posyandu Anggrek</option>
                                <option value="Posyandu B">Posyandu Kenanga</option>
                                <option value="Posyandu B">Posyandu Matahari</option>
                                <option value="Posyandu B">Posyandu Mawar</option>
                                <option value="Posyandu B">Posyandu Melati</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text" style="color: #28A745;"><i class="fas fa-bullseye"></i></span>
                            <select class="form-control" id="sasaranFilter">
                                <option value="">Semua Sasaran</option>
                                <option value="Balita">Ibu Hamil</option>
                                <option value="Ibu Hamil">Balita</option>
                                <option value="Lansia">Lansia</option>
                            </select>
                        </div>
                    </div>
                </div> --}}
                <!--end::Filter Row-->

                <!--begin::Row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4" style="border-radius: 0px;">
                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="border-top: 3px solid #28A745; border-radius: 0px;">
                                <h5 class="card-title">Data Pemberian Imunisasi</h5>
                                <button type="button" class="btn btn-success btn-sm ms-auto text-light"
                                    onclick="window.location='{{ route('pemberian.imunisasi.create') }}'">
                                    <i class="bi bi-plus"></i> Tambah Pemberian Imunisasi
                                </button>
                            </div>

                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Usia (Bulan)</th>
                                            <th>Jenis Imunisasi</th>
                                            <th>Tanggal</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pemberianImunisasi as $key => $item)
                                            @php
                                                $usiaBulan = (int) Carbon::parse(
                                                    $item->pendaftaran->tanggal_lahir,
                                                )->diffInMonths(Carbon::parse($item->waktu_pemberian));
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->pendaftaran->nama }}</td>
                                                <td>{{ $usiaBulan }}</td>
                                                <td>{{ $item->imunisasi->nama ?? '-' }}</td>
                                                <td>{{ Carbon::parse($item->waktu_pemberian)->translatedFormat('j F Y') }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('pemberian.imunisasi.show', $item->id) }}"
                                                        class="btn btn-info btn-sm" title="Lihat"
                                                        style="width: 20px; height: 20px; font-size: 10px; padding: 1px;">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('pemberian.imunisasi.edit', $item->id) }}"
                                                        class="btn btn-warning btn-sm" title="Edit"
                                                        style="width: 20px; height: 20px; font-size: 10px; padding: 1px;">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button class="btn btn-danger btn-sm btn-hapus" title="Hapus"
                                                        style="width: 20px; height: 20px; font-size: 10px; padding: 1px;"
                                                        data-url="{{ route('pemberian.imunisasi.destroy', $item->id) }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-footer">
                                {{ $pemberianImunisasi->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Row-->
            </div>
        </div>
        <!--end::App Content-->
    </main>
@endsection
