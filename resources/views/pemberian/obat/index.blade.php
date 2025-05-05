@extends('layouts.master')

@section('title', 'Pemberian Obat')

@php
    use Carbon\Carbon;
@endphp

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="mb-0" style="color: #333333;">Pemberian Obat</h3>
                        <p style="color: #777777; white-space: normal;">Halaman ini untuk mengelola data pemberian obat pada
                            peserta posyandu.</p>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="#" style="color: #d63384; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Pemberian Obat</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="small-box text-light" style="background-color: #d63384; border-radius: 2px;">
                            <div class="inner">
                                <h3>{{ $totalPemberian }}</h3>
                                <p>Total Pemberian Obat</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="small-box text-dark" style="background-color: #ffdeed; border-radius: 2px;">
                            <div class="inner">
                                <h3>{{ $totalLaki }}</h3>
                                <p>Jumlah Pemberian Obat pada Laki-Laki</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="small-box text-dark" style="background-color: #ffdeed; border-radius: 2px;">
                            <div class="inner">
                                <h3>{{ $totalPerempuan }}</h3>
                                <p>Jumlah Pemberian Obat pada Perempuan</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4" style="border-radius: 0px;">
                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="border-top: 3px solid #d63384; border-radius: 0px;">
                                <h3 class="card-title">Data Pemberian Obat</h3>
                                <button type="button" class="btn btn-sm ms-auto text-light"
                                    style="background-color: #d63384;" data-bs-toggle="modal"
                                    data-bs-target="#tambahPemberianObatModal">
                                    Tambah Pemberian Obat
                                </button>
                            </div>

                            <!-- Modal Tambah Obat -->
                            @include('pemberian.obat.modal.tambah_pemberian_obat')

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
                                            <th style="font-size: 15px">Waktu Pemberian</th>
                                            <th style="font-size: 15px">Nama</th>
                                            <th style="font-size: 15px">Usia (Tahun)</th>
                                            <th style="font-size: 15px">Daftar Obat</th>
                                            <th style="font-size: 15px">Keterangan</th>
                                            <th style="font-size: 15px; width: 100px" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($pemberianObat as $item)
                                            @php
                                                $obatData = json_decode($item->data, true) ?? [];
                                                $usia = Carbon::parse($item->pendaftaran->tanggal_lahir)->age;
                                            @endphp
                                            <tr>
                                                <td>{{ $item->waktu_pemberian->format('m/d/Y') }}</td>
                                                <td>{{ $item->pendaftaran->nama }}</td>
                                                <td>{{ $usia }}</td>
                                                <td>
                                                    @foreach ($obatData as $obat)
                                                        @php
                                                            $namaObat =
                                                                $dataObat[$obat['id_obat']]->nama ??
                                                                'Obat tidak ditemukan';
                                                        @endphp
                                                        <div>{{ $namaObat }}: {{ $obat['dosis'] }}</div>
                                                    @endforeach
                                                </td>
                                                <td>{{ $item->keterangan ?? '-' }}</td>
                                                <td class="text-center">
                                                    <!-- Tombol Edit -->
                                                    <a href="{{ route('pemberian.obat.edit', $item) }}"
                                                        class="btn btn-warning btn-sm" title="Edit"
                                                        style="width: 20px; height: 20px; font-size: 10px; padding: 1px;">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <!-- Tombol Hapus -->
                                                    <form action="{{ route('pemberian.obat.destroy', $item->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm btn-hapus"
                                                            title="Hapus"
                                                            style="width: 20px; height: 20px; font-size: 10px; padding: 1px;">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">Tidak ada data pemberian
                                                    obat.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix" style="background-color: white">
                                    <ul class="pagination pagination-sm m-0 float-end">
                                        @if ($pemberianObat->onFirstPage())
                                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                                        @else
                                            <li class="page-item"><a class="page-link"
                                                    style="background-color: #d63384; color: white; border: none;"
                                                    href="{{ $pemberianObat->previousPageUrl() }}">&laquo;</a></li>
                                        @endif
                                        @for ($i = 1; $i <= $pemberianObat->lastPage(); $i++)
                                            <li
                                                class="page-item {{ $pemberianObat->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link"
                                                    style="background-color: {{ $pemberianObat->currentPage() == $i ? '#d63384' : 'white' }}; color: {{ $pemberianObat->currentPage() == $i ? 'white' : '#d63384' }}; border: none;"
                                                    href="{{ $pemberianObat->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                        @if ($pemberianObat->hasMorePages())
                                            <li class="page-item"><a class="page-link"
                                                    style="background-color: #d63384; color: white; border: none;"
                                                    href="{{ $pemberianObat->nextPageUrl() }}">&raquo;</a></li>
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

@section('scripts')
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
@endsection
