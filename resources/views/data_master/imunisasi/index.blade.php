@extends('layouts.master')

@section('title', 'Data Imunisasi')

@section('content')

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0" style="color: #333333;">Data Imunisasi</h3>
                        <p style="color: #777777;">Halaman ini untuk mengelola data imunisasi.</p>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}" style="color: #d63384; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Data Imunisasi</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4" style="border-radius: 0px;">
                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="border-top: 3px solid #d63384; border-radius: 0px;">
                                <h3 class="card-title">Tabel Data Imunisasi</h3>
                                <button type="button" class="btn btn-sm ms-auto text-light"
                                    style="background-color: #d63384;" data-bs-toggle="modal"
                                    data-bs-target="#tambahImunisasiModal">
                                    <i class="bi bi-plus"></i> Tambah Imunisasi
                                </button>
                            </div>

                            <!-- Modal Tambah Imunisasi -->
                            @include('data_master.imunisasi.modal.tambah_imunisasi')

                            <div class="card-body">

                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Jenis Imunisasi</th>
                                            <th>Dari Umur (Bulan)</th>
                                            <th>Sampai Umur (Bulan)</th>
                                            <th>Keterangan</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($dataImunisasi as $index => $imunisasi)
                                            <tr class="align-middle">
                                                <td>{{ $loop->iteration + ($dataImunisasi->firstItem() - 1) }}</td>
                                                <td>{{ $imunisasi->nama }}</td>
                                                <td>{{ $imunisasi->dari_umur }}</td>
                                                <td>{{ $imunisasi->sampai_umur }}</td>
                                                <td>{{ $imunisasi->keterangan ?? '-' }}</td>
                                                <td class="text-center">
                                                    <!-- Tombol Edit -->
                                                    <a href="{{ route('data-master.imunisasi.edit', $imunisasi->id) }}"
                                                        class="btn btn-warning btn-sm" title="Edit"
                                                        style="width: 20px; height: 20px; font-size: 10px; padding: 1px;">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <!-- Tombol Hapus -->
                                                    <form
                                                        action="{{ route('data-master.imunisasi.destroy', $imunisasi->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm btn-hapus"
                                                            title="Hapus"
                                                            style="width: 20px; height: 20px; font-size: 10px; padding: 1px;">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">Tidak ada data imunisasi.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix" style="background-color: white">
                                    <ul class="pagination pagination-sm m-0 float-end">
                                        @if ($dataImunisasi->onFirstPage())
                                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                                        @else
                                            <li class="page-item"><a class="page-link"
                                                    style="background-color: #d63384; color: white; border: none;"
                                                    href="{{ $dataImunisasi->previousPageUrl() }}">&laquo;</a></li>
                                        @endif
                                        @for ($i = 1; $i <= $dataImunisasi->lastPage(); $i++)
                                            <li class="page-item {{ $dataImunisasi->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link"
                                                    style="background-color: {{ $dataImunisasi->currentPage() == $i ? '#d63384' : 'white' }}; color: {{ $dataImunisasi->currentPage() == $i ? 'white' : '#d63384' }}; border: none;"
                                                    href="{{ $dataImunisasi->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                        @if ($dataImunisasi->hasMorePages())
                                            <li class="page-item"><a class="page-link"
                                                    style="background-color: #d63384; color: white; border: none;"
                                                    href="{{ $dataImunisasi->nextPageUrl() }}">&raquo;</a></li>
                                        @else
                                            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.btn-hapus').on('click', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d63384',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
