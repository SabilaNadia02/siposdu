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
                                <a href="#" style="color: #FF69B4; font-size: 16px;">Dashboard</a>
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
                                style="border-top: 3px solid #FF69B4; border-radius: 0px;">
                                <h3 class="card-title">Tabel Data Imunisasi</h3>
                                <button type="button" class="btn btn-sm ms-auto text-light"
                                    style="background-color: #FF69B4;" data-bs-toggle="modal"
                                    data-bs-target="#tambahImunisasiModal">
                                    <i class="bi bi-plus"></i> Tambah Imunisasi
                                </button>
                            </div>

                            <!-- Modal Tambah Imunisasi -->
                            @include('data_master.imunisasi.modal.tambah_imunisasi')

                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
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
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $imunisasi->nama }}</td>
                                                <td>{{ $imunisasi->dari_umur }}</td>
                                                <td>{{ $imunisasi->sampai_umur }}</td>
                                                <td>{{ $imunisasi->keterangan ?? '-' }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('data-master.imunisasi.show', $imunisasi->id) }}"
                                                        class="btn btn-info btn-sm" title="Lihat">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('data-master.imunisasi.edit', $imunisasi->id) }}"
                                                        class="btn btn-warning btn-sm" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form
                                                        action="{{ route('data-master.imunisasi.destroy', $imunisasi->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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
                            </div>

                            <div class="card-footer clearfix" style="background-color: white">
                                @if ($dataImunisasi->hasPages())
                                    {{ $dataImunisasi->links() }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
