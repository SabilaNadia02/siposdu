@extends('layouts.master')

@section('title', 'Data Pertanyaan')

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
                        <h3 class="mb-0" style="color: #333333;">Data Pertanyaan</h3>
                        <p style="color: #777777;">Halaman ini untuk mengelola data pertanyaan.</p>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="#" style="color: #FF69B4; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Data Pertanyaan</li>
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
                                <h3 class="card-title">Tabel Data Pertanyaan</h3>
                                <button type="button" class="btn btn-sm ms-auto text-light"
                                    style="background-color: #FF69B4;" data-bs-toggle="modal"
                                    data-bs-target="#tambahPertanyaanModal">
                                    Tambah Pertanyaan
                                </button>
                            </div>
                            @include('data_master.pertanyaan.modal.tambah_pertanyaan')
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 50px">#</th>
                                            <th style="font-size: 15px">Pertanyaan Skrining</th>
                                            <th style="width: 100" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($datapertanyaan as $key => $pertanyaan)
                                            <tr class="align-middle">
                                                <td>{{ $pertanyaan->id }}</td>
                                                <td>{{ $pertanyaan->nama_pertanyaan ?? '-' }}</td>
                                                <td class="text-center">
                                                    {{-- <a href="{{ route('data-master.pertanyaan.show', $pertanyaan->id) }}" class="btn btn-info" title="Lihat"
                                                        style="width: 20px; height: 20px; font-size: 10px; padding: 1px; display: inline-flex; justify-content: center; align-items: center;">
                                                        <i class="fas fa-eye"></i>
                                                    </a> --}}
                                                    <a href="{{ route('data-master.pertanyaan.edit', $pertanyaan->id) }}"
                                                        class="btn btn-warning" title="Edit"
                                                        style="width: 20px; height: 20px; font-size: 10px; padding: 1px; display: inline-flex; justify-content: center; align-items: center;">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form
                                                        action="{{ route('data-master.pertanyaan.destroy', $pertanyaan->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" title="Hapus"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                                                            style="width: 20px; height: 20px; font-size: 10px; padding: 1px; display: inline-flex; justify-content: center; align-items: center;">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">Tidak ada data pertanyaan.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix" style="background-color: white">
                                <ul class="pagination pagination-sm m-0 float-end">
                                    @if ($datapertanyaan->onFirstPage())
                                        <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link"
                                                style="background-color: #FF69B4; color: white; border: none;"
                                                href="{{ $datapertanyaan->previousPageUrl() }}">&laquo;</a></li>
                                    @endif
                                    @for ($i = 1; $i <= $datapertanyaan->lastPage(); $i++)
                                        <li
                                            class="page-item {{ $datapertanyaan->currentPage() == $i ? 'active' : '' }}">
                                            <a class="page-link"
                                                style="background-color: {{ $datapertanyaan->currentPage() == $i ? '#FF69B4' : 'white' }}; color: {{ $datapertanyaan->currentPage() == $i ? 'white' : '#FF69B4' }}; border: none;"
                                                href="{{ $datapertanyaan->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    @if ($datapertanyaan->hasMorePages())
                                        <li class="page-item"><a class="page-link"
                                                style="background-color: #FF69B4; color: white; border: none;"
                                                href="{{ $datapertanyaan->nextPageUrl() }}">&raquo;</a></li>
                                    @else
                                        <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!--end::Row-->
            </div>
            <!--end::App Content-->
        </div>
    </main>
    <!--end::App Main-->
@endsection
