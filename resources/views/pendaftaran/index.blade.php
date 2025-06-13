@extends('layouts.master')

@section('title', 'Pendaftaran')

@section('content')
    <main class="app-main" style="background-color: white">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0" style="color: #333333;">Pendaftaran</h3>
                        <p style="color: #777777;">Halaman ini untuk mengelola data pendaftaran peserta posyandu.</p>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}" style="color: #d63384; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Pendaftaran</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Total Pendaftaran (pink) -->
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="small-box text-light"
                            style="background-color: #d63384; border: 1px solid #d63384; border-radius: 2px;">
                            <div class="inner">
                                <h3>{{ $totalPendaftaran }}</h3>
                                <p>Total Pendaftaran</p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Ibu Hamil (primary / biru) -->
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="small-box text-light"
                            style="background-color: #0d6efd; border: 1px solid #0d6efd; border-radius: 2px;">
                            <div class="inner">
                                <h3>{{ $totalIbuHamil }}</h3>
                                <p>Total Ibu Hamil</p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Balita (success / hijau) -->
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="small-box text-light"
                            style="background-color: #198754; border: 1px solid #198754; border-radius: 2px;">
                            <div class="inner">
                                <h3>{{ $totalBayiBalita }}</h3>
                                <p>Total Balita</p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Lansia (warning / kuning) -->
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="small-box text-dark"
                            style="background-color: #ffc107; border: 1px solid #ffc107; border-radius: 2px;">
                            <div class="inner">
                                <h3>{{ $totalUsiaSuburLansia }}</h3>
                                <p>Total Lansia</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!--<div class="row mb-3">-->
                <!--    <div class="col-md-3">-->
                <!--        <div class="input-group">-->
                <!--            <span class="input-group-text" style="border-radius: 2px; color: #d63384;">-->
                <!--                <i class="fas fa-search"></i>-->
                <!--            </span>-->
                <!--            <input type="text" class="form-control" id="searchNamaPeserta"-->
                <!--                placeholder="Cari Nama Peserta.." style="border-radius: 2px;">-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                
                <div class="row mb-3">
                    <div class="col-md-3">
                        <form action="{{ route('pendaftaran.index') }}" method="GET">
                            <div class="input-group">
                                <span class="input-group-text" style="border-radius: 2px; color: #d63384;">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" class="form-control" name="search" id="searchNamaPeserta"
                                    placeholder="Cari Nama Peserta.." style="border-radius: 2px;"
                                    value="{{ request('search') }}">
                                <button type="submit" class="btn ms-auto text-light"
                                    style="background-color: #d63384;">
                                    Cari
                                </button>
                                @if(request('search'))
                                <a href="{{ route('pendaftaran.index') }}" class="btn btn-outline-danger" style="border-radius: 2px;">
                                    Reset
                                </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4" style="border-radius: 0px;">
                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="border-top: 3px solid #d63384; border-radius: 0px;">
                                <h5 class="card-title">Tabel Data Pendaftaran</h5>
                                <button type="button" class="btn btn-sm ms-auto text-light"
                                    style="background-color: #d63384;" data-bs-toggle="modal"
                                    data-bs-target="#addDataModal">
                                    <i class="bi bi-plus"></i> Tambah Pendaftaran
                                </button>
                            </div>
                            @include('pendaftaran.modal.tambah_pendaftaran')
                        </div>

                        <div class="card-body overflow-x-scroll">

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Usia</th>
                                        <th>Jenis Sasaran</th>
                                        <th>Nama Posyandu</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pendaftaran as $data)
                                        <tr>
                                            {{-- <td>{{ $loop->iteration }}</td> --}}
                                            <td>{{ ($pendaftaran->currentPage() - 1) * $pendaftaran->perPage() + $loop->iteration }}
                                            </td>
                                            <td>{{ $data->nama }}</td>
                                            <td>
                                                @if ($data->jenis_kelamin == '1')
                                                    Laki-Laki
                                                @elseif ($data->jenis_kelamin == '2')
                                                    Perempuan
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($data->tanggal_lahir)->age }} Tahun</td>
                                            <td>
                                                @if ($data->jenis_sasaran == 1)
                                                    Ibu Hamil
                                                @elseif ($data->jenis_sasaran == 2)
                                                    Balita
                                                @elseif ($data->jenis_sasaran == 3)
                                                    Usia Subur atau Lansia
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $data->posyandus->nama ?? '-' }}</td>
                                            <td class="text-center">
                                                <!-- Tombol Detail -->
                                                <a href="{{ route('pendaftaran.show', $data->id) }}"
                                                    class="btn btn-info btn-sm" title="Lihat"
                                                    style="width: 20px; height: 20px; font-size: 10px; padding: 1px;">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                <!-- Tombol Edit -->
                                                <a href="{{ route('pendaftaran.edit', $data->id) }}"
                                                    class="btn btn-warning btn-sm" title="Edit"
                                                    style="width: 20px; height: 20px; font-size: 10px; padding: 1px;">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <!-- Tombol Hapus -->
                                                <form action="{{ route('pendaftaran.destroy', $data->id) }}" method="POST"
                                                    class="d-inline">
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
                                            <td colspan="7" class="text-center text-muted">Tidak ada data pendaftaran.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- /.card-body -->
                        <div class="card-footer clearfix" style="background-color: white">
                            <ul class="pagination pagination-sm m-0 float-end">
                                {{-- Previous Page Link --}}
                                @if ($pendaftaran->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" style="background-color: #d63384; color: white; border: none;" href="{{ $pendaftaran->previousPageUrl() }}" rel="prev">&laquo;</a>
                                    </li>
                                @endif
                        
                                {{-- Show page numbers only if less than or equal to 10 pages --}}
                                @if ($pendaftaran->lastPage() <= 10)
                                    @for ($i = 1; $i <= $pendaftaran->lastPage(); $i++)
                                        <li class="page-item {{ $pendaftaran->currentPage() == $i ? 'active' : '' }}">
                                            <a class="page-link" style="background-color: {{ $pendaftaran->currentPage() == $i ? '#d63384' : 'white' }}; color: {{ $pendaftaran->currentPage() == $i ? 'white' : '#d63384' }}; border: none;" href="{{ $pendaftaran->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                @else
                                    {{-- Show current page with ellipsis --}}
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                    <li class="page-item active">
                                        <span class="page-link" style="background-color: #d63384; color: white; border: none;">{{ $pendaftaran->currentPage() }}</span>
                                    </li>
                                    <li class="page-item disabled"><span class="page-link">...</span></li>
                                @endif
                        
                                {{-- Next Page Link --}}
                                @if ($pendaftaran->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" style="background-color: #d63384; color: white; border: none;" href="{{ $pendaftaran->nextPageUrl() }}" rel="next">&raquo;</a>
                                    </li>
                                @else
                                    <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        // document.getElementById("searchNamaPeserta").addEventListener("keyup", function() {
        //     var input = this.value.toLowerCase();
        //     var rows = document.querySelectorAll("tbody tr");

        //     rows.forEach(function(row) {
        //         var nama = row.cells[1].textContent.toLowerCase();
        //         if (nama.includes(input)) {
        //             row.style.display = "";
        //         } else {
        //             row.style.display = "none";
        //         }
        //     });
        // });

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
