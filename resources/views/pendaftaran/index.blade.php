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
                            <a href="#" style="color: #FF69B4; font-size: 16px;">Dashboard</a>
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
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="small-box text-dark" style="background-color: #ffdeed; border-radius: 2px;">
                        <div class="inner">
                            <h3>{{ $totalPendaftaran }}</h3>
                            <p>Total Pendaftaran</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="small-box text-dark" style="background-color: #ffdeed; border-radius: 2px;">
                        <div class="inner">
                            <h3>{{ $totalLaki }}</h3>
                            <p>Total Laki-Laki</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="small-box text-dark" style="background-color: #ffdeed; border-radius: 2px;">
                        <div class="inner">
                            <h3>{{ $totalPerempuan }}</h3>
                            <p>Total Perempuan</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4" style="border-radius: 0px;">
                        <div class="card-header d-flex justify-content-between align-items-center"
                            style="border-top: 3px solid #FF69B4; border-radius: 0px;">
                            <h5 class="card-title">Tabel Data Pendaftaran</h5>
                            <button type="button" class="btn btn-sm ms-auto text-light"
                                style="background-color: #FF69B4;" data-bs-toggle="modal"
                                data-bs-target="#addDataModal">
                                <i class="bi bi-plus"></i> Tambah Pendaftaran
                            </button>
                        </div>
                        @include('pendaftaran.modal.tambah_pendaftaran')
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Usia</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pendaftaran as $key => $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>{{ $data->jenis_kelamin == '1' ? 'Laki-Laki' : 'Perempuan' }}</td>
                                            <td>{{ date('d-m-Y', strtotime($data->tanggal_lahir)) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($data->tanggal_lahir)->age }} Tahun</td>
                                            <td class="text-center">
                                                <a href="{{ route('pendaftaran.show', $data->id) }}"
                                                    class="btn btn-info btn-sm" title="Lihat">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="#" class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#" class="btn btn-danger btn-sm" title="Hapus"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">Tidak ada data pendaftaran.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix" style="background-color: white">
                            {{ $pendaftaran->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
