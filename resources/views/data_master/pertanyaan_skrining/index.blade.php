@extends('layouts.master')

@section('title', 'Data Pertanyaan Skrining')

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
                        <h3 class="mb-0" style="color: #333333;">Data Pertanyaan Skrining</h3>
                        <p style="color: #777777;">Halaman ini untuk mengelola data pertanyaan skrining.</p>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="#" style="color: #FF69B4; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Data Pertanyaan Skrining</li>
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
                                <h3 class="card-title">Tabel Data Pertanyaan Skrining</h3>
                                <button type="button" class="btn btn-sm ms-auto text-light"
                                    style="background-color: #FF69B4;" data-bs-toggle="modal"
                                    data-bs-target="#tambahPertanyaanSkriningModal">
                                    Tambah Pertanyaan Skrining
                                </button>
                            </div>
                            @include('data_master.pertanyaan_skrining.modal.tambah_pertanyaan_skrining')
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 50px">#</th>
                                            <th style="font-size: 15px">Nama Skrining</th>
                                            <th style="font-size: 15px">Pertanyaan</th>
                                            <th style="width: 100" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($pertanyaanskrining as $key => $data)
                                            <tr class="align-middle">
                                                <td>{{ $data->id }}</td>
                                                <td>{{ $data->dataSkrining->nama_skrining ?? '-' }}</td>
                                                <td>{{ $data->dataPertanyaan->nama_pertanyaan ?? '-' }}</td>
                                                <td class="text-center">
                                                    {{-- <a href="{{ route('data-master.skrining.show', $skrining->id) }}" class="btn btn-info" title="Lihat"
                                                        style="width: 20px; height: 20px; font-size: 10px; padding: 1px; display: inline-flex; justify-content: center; align-items: center;">
                                                        <i class="fas fa-eye"></i>
                                                    </a> --}}
                                                    {{-- <a href="{{ route('data-master.pertanyaan-skrining.edit', $data->id) }}"
                                                        class="btn btn-warning" title="Edit"
                                                        style="width: 20px; height: 20px; font-size: 10px; padding: 1px; display: inline-flex; justify-content: center; align-items: center;">
                                                        <i class="fas fa-edit"></i>
                                                    </a> --}}
                                                    <form
                                                        action="{{ route('data-master.pertanyaan-skrining.destroy', $data->id) }}"
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
                                                <td colspan="4" class="text-center text-muted">Tidak ada data pertanyaan
                                                    skrining.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix" style="background-color: white">
                                <ul class="pagination pagination-sm m-0 float-end">
                                    @if ($pertanyaanskrining->onFirstPage())
                                        <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link"
                                                style="background-color: #FF69B4; color: white; border: none;"
                                                href="{{ $pertanyaanskrining->previousPageUrl() }}">&laquo;</a></li>
                                    @endif
                                    @for ($i = 1; $i <= $pertanyaanskrining->lastPage(); $i++)
                                        <li
                                            class="page-item {{ $pertanyaanskrining->currentPage() == $i ? 'active' : '' }}">
                                            <a class="page-link"
                                                style="background-color: {{ $pertanyaanskrining->currentPage() == $i ? '#FF69B4' : 'white' }}; color: {{ $pertanyaanskrining->currentPage() == $i ? 'white' : '#FF69B4' }}; border: none;"
                                                href="{{ $pertanyaanskrining->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    @if ($pertanyaanskrining->hasMorePages())
                                        <li class="page-item"><a class="page-link"
                                                style="background-color: #FF69B4; color: white; border: none;"
                                                href="{{ $pertanyaanskrining->nextPageUrl() }}">&raquo;</a></li>
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
