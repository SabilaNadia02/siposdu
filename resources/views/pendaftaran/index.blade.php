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
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="small-box text-dark" style="background-color: #ffdeed; border-radius: 2px;">
                            <div class="inner">
                                <h3>{{ $totalPendaftaran }}</h3>
                                <p>Total Pendaftaran</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="small-box text-dark" style="background-color: #ffdeed; border-radius: 2px;">
                            <div class="inner">
                                <h3>{{ $totalIbuHamil }}</h3>
                                <p>Total Ibu Hamil, Menyusui, dan Nifas</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="small-box text-dark" style="background-color: #ffdeed; border-radius: 2px;">
                            <div class="inner">
                                <h3>{{ $totalBayiBalita }}</h3>
                                <p>Total Bayi, Balita, dan APRAS</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="small-box text-dark" style="background-color: #ffdeed; border-radius: 2px;">
                            <div class="inner">
                                <h3>{{ $totalUsiaSuburLansia }}</h3>
                                <p>Total Usia Subur atau Lansia</p>
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
                        </div>

                        <div class="card-body">
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
                                            <td>{{ $data->id }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>{{ $data->jenis_kelamin == '1' ? 'Laki-Laki' : 'Perempuan' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($data->tanggal_lahir)->age }} Tahun</td>
                                            <td>
                                                @if ($data->jenis_sasaran == 1)
                                                    Ibu Hamil
                                                @elseif ($data->jenis_sasaran == 2)
                                                    Balita
                                                @else
                                                    Usia Subur atau Lansia
                                                @endif
                                            </td>
                                            <td>{{ $data->posyandus->nama ?? '-' }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('pendaftaran.show', $data->id) }}"
                                                    class="btn btn-info btn-sm" title="Lihat"
                                                    style="width: 20px; height: 20px; font-size: 10px; padding: 1px;">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('pendaftaran.edit', $data->id) }}"
                                                    class="btn btn-warning btn-sm" title="Edit"
                                                    style="width: 20px; height: 20px; font-size: 10px; padding: 1px;">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm btn-hapus" title="Hapus"
                                                    style="width: 20px; height: 20px; font-size: 10px; padding: 1px;"
                                                    data-url="{{ route('pendaftaran.destroy', $data->id) }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
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

                            <div class="card-footer clearfix" style="background-color: white">
                                {{ $pendaftaran->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.querySelectorAll(".btn-hapus").forEach(button => {
            button.addEventListener("click", function(event) {
                event.preventDefault();
                let url = this.getAttribute("data-url");

                if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                    fetch(url, {
                            method: "DELETE",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert("Data berhasil dihapus!");
                                location.reload();
                            } else {
                                alert("Gagal menghapus data!");
                            }
                        })
                        .catch(error => console.error("Error:", error));
                }
            });
        });
    </script>
@endsection
