@extends('layouts.master')

@section('title', 'Pencatatan Balita')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="mb-0" style="color: #333333;">Pencatatan Balita</h3>
                        <p style="color: #777777; white-space: normal;">
                            Halaman ini untuk mengelola data pencatatan pada Usia Produktif dan Balita.
                        </p>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="#" style="color: #28A745; font-size: 16px;">Pencatatan</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Pencatatan Balita</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="small-box bg-white text-dark" style="border: 1px solid #28A745; border-radius: 2px;">
                            <div class="inner">
                                <h3>{{ $jumlahBalita }}</h3>
                                <p>Total Pencatatan</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="input-group">
                            <span class="input-group-text" style="border-radius: 2px; color: #28A745;">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" class="form-control" id="searchNamaBalita"
                                placeholder="Cari Nama Balita.." style="border-radius: 2px;">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4" style="border-radius: 0px;">
                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="border-top: 3px solid #28A745; border-radius: 0px;">
                                <h3 class="card-title">Data Balita</h3>
                            </div>

                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 150px">No Pendaftaran</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Usia</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dataBalita as $index => $balita)
                                            <tr class="align-middle">
                                                <td>{{ str_pad($balita->id, 4, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ $balita->nama }}</td>
                                                <td>{{ $balita->jenis_kelamin == '1' ? 'Laki-Laki' : 'Perempuan' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($balita->tanggal_lahir)->age }} Tahun</td>
                                                <td class="text-center">
                                                    <a href="{{ route('pendaftaran.show', $balita->id) }}" class="btn"
                                                        title="Tambah Data"
                                                        style="background-color: #28A745; color: white; width: 20px; height: 20px; font-size: 10px; padding: 1px; border-radius: 2px;">
                                                        <i class="fas fa-plus"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-danger" title="Hapus"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                                                        style="width: 20px; height: 20px; font-size: 10px; padding: 1px;">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-footer clearfix" style="background-color: white">
                                {{ $dataBalita->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.getElementById("searchNamaBalita").addEventListener("keyup", function() {
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
    </script>

@endsection
