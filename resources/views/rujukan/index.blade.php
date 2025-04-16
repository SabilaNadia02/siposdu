@extends('layouts.master')

@section('title', 'Rujukan')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0" style="color: #333333;">Rujukan</h3>
                        <p style="color: #777777;">Halaman ini untuk mengelola data rujukan peserta posyandu.</p>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href=# style="color: #FF69B4; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Rujukan</li>
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
                                <h3>{{ $totalRujukan }}</h3>
                                <p>Total Rujukan</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="small-box text-dark" style="background-color: #ffdeed; border-radius: 2px;">
                            <div class="inner">
                                <h3>{{ $totalLaki }}</h3>
                                <p>Total Rujukan Laki-Laki</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="small-box text-dark" style="background-color: #ffdeed; border-radius: 2px;">
                            <div class="inner">
                                <h3>{{ $totalPerempuan }}</h3>
                                <p>Total Rujukan Perempuan</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text" style="color: #FF69B4"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" id="searchInput"
                                placeholder="Cari nama peserta, jenis rujukan, atau keterangan...">
                        </div>
                    </div>
                </div> --}}

                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4" style="border-radius: 0px;">
                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="border-top: 3px solid #FF69B4; border-radius: 0px;">
                                <h3 class="card-title">Tabel Data Rujukan</h3>
                                <button type="button" class="btn btn-sm ms-auto text-light"
                                    style="background-color: #FF69B4;" data-bs-toggle="modal"
                                    data-bs-target="#tambahRujukanModal">
                                    Tambah Rujukan
                                </button>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="font-size: 15px; width: 160px">Waktu Rujukan <span
                                                        style="font-size: smaller; font-weight: normal;">(bulan/tanggal/tahun)</span>
                                                </th>
                                                <th style="font-size: 15px; width: 300px">Nama</th>
                                                <th style="font-size: 15px; width: 160px">Jenis Rujukan</th>
                                                <th style="font-size: 15px; width: 260px">Keterangan</th>
                                                <th style="font-size: 15px; width: 100px" class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableBody">
                                            @forelse ($rujukan as $item)
                                                <tr class="align-middle searchable-row"
                                                    data-search="{{ strtolower($item->pendaftaran->nama ?? '') }} {{ strtolower($item->jenis_rujukan_text) }} {{ strtolower($item->keterangan ?? '') }}">
                                                    <td>{{ $item->waktu_rujukan->format('m-d-Y') }}</td>
                                                    <td>{{ $item->pendaftaran->nama ?? 'Data tidak tersedia' }}</td>
                                                    <td>{{ $item->jenis_rujukan_text }}</td>
                                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('rujukan.edit', $item->id) }}"
                                                            class="btn btn-warning" title="Edit"
                                                            style="width: 20px; height: 20px; font-size: 10px; padding: 1px; display: inline-flex; justify-content: center; align-items: center;">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('rujukan.destroy', $item->id) }}"
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
                                                    <td colspan="5" class="text-center">Tidak ada data rujukan</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-flex justify-content-center">
                                    {{ $rujukan->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('rujukan.modal.tambah_rujukan')
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const rows = document.querySelectorAll('.searchable-row');

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.trim().toLowerCase();
                let hasVisibleRows = false;

                rows.forEach(row => {
                    const searchData = row.getAttribute('data-search');
                    const shouldShow = searchData.includes(searchTerm);

                    row.style.display = shouldShow ? '' : 'none';
                    if (shouldShow) hasVisibleRows = true;
                });

                // Handle no results
                const noResults = document.getElementById('noResults');
                if (noResults) noResults.remove();

                if (!hasVisibleRows && searchTerm.length > 0) {
                    const tbody = document.querySelector('#tableBody');
                    const tr = document.createElement('tr');
                    tr.id = 'noResults';
                    tr.innerHTML = '<td colspan="5" class="text-center">Tidak ada data yang cocok</td>';
                    tbody.appendChild(tr);
                }
            });
        });
    </script>
@endpush
