@extends('layouts.master')

@section('title', 'Pencatatan Lansia')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="mb-0" style="color: #333333;">Pencatatan Lansia</h3>
                        <p style="color: #777777; white-space: normal;">
                            Halaman ini untuk mengelola data pencatatan pada Usia Produktif dan Lansia.
                        </p>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="#" style="color: #FF8F00; font-size: 16px;">Pencatatan</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Pencatatan Lansia</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="small-box bg-white text-dark" style="border: 1px solid #FF8F00; border-radius: 2px;">
                            <div class="inner">
                                <h3>{{ $jumlahPencatatan }}</h3>
                                <p>Total Pencatatan</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text" style="border-radius: 2px; color: #FF8F00;">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" class="form-control" id="searchNamaLansia"
                                placeholder="Cari Nama Lansia.." style="border-radius: 2px;">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4" style="border-radius: 0px;">
                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="border-top: 3px solid #FF8F00; border-radius: 0px;">
                                <h5 class="card-title">Tabel Data Ibu Balita</h5>
                                <button type="button" class="btn btn-sm ms-auto text-light"
                                    style="background-color: #FF8F00;" data-bs-toggle="modal"
                                    data-bs-target="#tambahPencatatanBaruModal">
                                    <i class="bi bi-plus"></i> Tambah Data
                                </button>
                            </div>
                            @include('pencatatan.lansia.modal.tambah_pencatatan_baru')

                            <div class="card-body overflow-x-scroll">

                                @foreach (['success' => 'success', 'error' => 'danger'] as $msg => $type)
                                    @if (session($msg))
                                        <div class="alert alert-{{ $type }} alert-dismissible fade show"
                                            role="alert">
                                            {{ session($msg) }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                @endforeach

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 150px">No Pendaftaran</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Usia</th>
                                            <th>Posyandu</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($pencatatanAwal as $index => $data)
                                            <tr class="align-middle">
                                                <td>{{ str_pad($data->pendaftaran->id, 4, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ $data->pendaftaran->nama }}</td>
                                                <td>{{ $data->pendaftaran->jenis_kelamin == '1' ? 'Laki-Laki' : 'Perempuan' }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($data->pendaftaran->tanggal_lahir)->age }}
                                                    Tahun</td>
                                                <td>{{ $data->pendaftaran->posyandus->nama }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('pencatatan.lansia.show', $data->id) }}"
                                                        class="btn" title="Tambah Pencatatan"
                                                        style="background-color: #FF8F00; color: white; width: 20px; height: 20px; font-size: 10px; padding: 1px; border-radius: 2px;">
                                                        <i class="fas fa-plus"></i>
                                                    </a>
                                                    <!-- Tombol Hapus -->
                                                    <form action="{{ route('pencatatan.lansia.destroy', $data->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm btn-hapus"
                                                            style="width: 20px; height: 20px; font-size: 10px; padding: 1px;"
                                                            title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">Tidak ada data pencatatan
                                                    lansia.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix" style="background-color: white">
                                {{ $pencatatanAwal->links() }}
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
        document.getElementById("searchNamaLansia").addEventListener("keyup", function() {
            var input = this.value.toLowerCase();
            var rows = document.querySelectorAll("tbody tr");

            rows.forEach(function(row) {
                var nama = row.cells[1].textContent.toLowerCase();
                if (nama.includes(input)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });

        $(document).ready(function() {
            $('.btn-hapus').on('click', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#FF8F00',
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
