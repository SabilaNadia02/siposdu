@extends('layouts.master')

@section('title', 'Pemberian Obat')

@php
    use Carbon\Carbon;
@endphp

@section('content')
    <!--begin::App Main-->
    <main class="app-main">

        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="mb-0" style="color: #333333;">Pemberian Obat</h3>
                        <p style="color: #777777; white-space: normal;">Halaman ini untuk mengelola data pemberian obat
                            pada peserta posyandu.</p>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="#" style="color: #FF69B4; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Pemberian Obat</li>
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
                    <!--begin::Col-->
                    <div class="col-lg-4 col-md-6 col-12">
                        <!--begin::Small Box Widget 1-->
                        <div class="small-box text-dark" style="background-color: #ffdeed; border-radius: 2px;">
                            <div class="inner">
                                <h3>{{ $totalPemberian }}</h3>
                                <p>Total Pemberian Obat</p>
                            </div>
                        </div>
                        <!--end::Small Box Widget 1-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->

                <!--begin::Filter Row-->
                {{-- <div class="row mb-3">
                    <form id="filterForm" method="GET" action="{{ route('pemberian.obat.index') }}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text" style="color: #FF69B4;"><i class="fas fa-calendar"></i></span>
                                    <select class="form-control" name="tahun" id="tahunFilter">
                                        <option value="">Semua Tahun</option>
                                        @for ($year = date('Y'); $year >= 2020; $year--)
                                            <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                        @endfor
                                    </select>
                                    <span class="input-group-text"><i class="fas fa-chevron-down"></i></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text" style="color: #FF69B4;"><i class="fas fa-calendar-alt"></i></span>
                                    <select class="form-control" name="bulan" id="bulanFilter">
                                        <option value="">Semua Bulan</option>
                                        @foreach(range(1, 12) as $month)
                                            <option value="{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}" {{ request('bulan') == str_pad($month, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                                                {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-text"><i class="fas fa-chevron-down"></i></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text" style="color: #FF69B4;"><i class="fas fa-map-marker-alt"></i></span>
                                    <select class="form-control" name="posyandu" id="posyanduFilter">
                                        <option value="">Semua Posyandu</option>
                                        @foreach($posyandus as $posyandu)
                                            <option value="{{ $posyandu->id }}" {{ request('posyandu') == $posyandu->id ? 'selected' : '' }}>
                                                {{ $posyandu->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-text"><i class="fas fa-chevron-down"></i></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text" style="color: #FF69B4;"><i class="fas fa-bullseye"></i></span>
                                    <select class="form-control" name="sasaran" id="sasaranFilter">
                                        <option value="">Semua Sasaran</option>
                                        <option value="Ibu Hamil" {{ request('sasaran') == 'Ibu Hamil' ? 'selected' : '' }}>Ibu Hamil</option>
                                        <option value="Balita" {{ request('sasaran') == 'Balita' ? 'selected' : '' }}>Balita</option>
                                        <option value="Lansia" {{ request('sasaran') == 'Lansia' ? 'selected' : '' }}>Lansia</option>
                                    </select>
                                    <span class="input-group-text"><i class="fas fa-chevron-down"></i></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div> --}}
                <!--end::Filter Row-->

                <!--begin::Row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4" style="border-radius: 0px;">
                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="border-top: 3px solid #FF69B4; border-radius: 0px;">
                                <h3 class="card-title">Data Pemberian Obat</h3>
                                <button type="button" class="btn btn-sm ms-auto text-light"
                                    style="background-color: #FF69B4;" data-bs-toggle="modal"
                                    data-bs-target="#tambahPemberianObatModal">
                                    Tambah Pemberian Obat
                                </button>
                            </div>
                            
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            {{-- <th style="font-size: 15px; width: 10px">#</th> --}}
                                            <th style="font-size: 15px">Waktu Pemberian</th>
                                            <th style="font-size: 15px">Nama</th>
                                            <th style="font-size: 15px">Usia (Tahun)</th>
                                            <th style="font-size: 15px">Nama Obat</th>
                                            <th style="font-size: 15px">Dosis</th>
                                            <th style="font-size: 15px; width: 100px" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pemberianObat as $index => $item)
                                        <tr class="align-middle">
                                            {{-- <td>{{ $index + $pemberianObat->firstItem() }}</td> --}}
                                            <td>{{ $item->waktu_pemberian->format('d/m/Y') }}</td>
                                            <td>{{ $item->pendaftaran->nama }}</td>
                                            <td>{{ Carbon::parse($item->pendaftaran->tanggal_lahir)->age }}</td>
                                            <td>{{ $item->obat->nama }}</td>
                                            <td>{{ $item->dosis }}</td>
                                            <td class="text-center">
                                                {{-- <a href="{{ route('pemberian.obat.show', $item->id) }}"
                                                    class="btn btn-info" title="Lihat"
                                                    style="width: 20px; height: 20px; font-size: 10px; padding: 1px; display: inline-flex; justify-content: center; align-items: center;">
                                                    <i class="fas fa-eye"></i>
                                                </a> --}}
                                                <a href="{{ route('pemberian.obat.edit', $item->id) }}"
                                                    class="btn btn-warning" title="Edit"
                                                    style="width: 20px; height: 20px; font-size: 10px; padding: 1px; display: inline-flex; justify-content: center; align-items: center;">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('pemberian.obat.destroy', $item->id) }}"
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
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix" style="background-color: white">
                                <div class="float-end">
                                    {{ $pemberianObat->links() }}
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
                <!--end::Row-->

            </div>
        </div>
        <!--end::App Content-->
    </main>

    @include('pemberian.obat.modal.tambah_pemberian_obat')
    @include('pemberian.obat.edit')
    @include('pemberian.obat.show')

    <script>
        // Filter form submission
        document.getElementById('tahunFilter').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
        document.getElementById('bulanFilter').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
        document.getElementById('posyanduFilter').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
        document.getElementById('sasaranFilter').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });

        // View button click handler
        document.querySelectorAll('.view-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                fetch(`/pemberian-obat/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('viewNama').textContent = data.pendaftaran.nama;
                        document.getElementById('viewUsia').textContent = calculateAge(data.pendaftaran.tanggal_lahir);
                        document.getElementById('viewObat').textContent = data.obat.nama;
                        document.getElementById('viewDosis').textContent = data.dosis;
                        document.getElementById('viewWaktu').textContent = formatDateTime(data.waktu_pemberian);
                        document.getElementById('viewKeterangan').textContent = data.keterangan || '-';
                        
                        // Show modal
                        new bootstrap.Modal(document.getElementById('viewPemberianObatModal')).show();
                    });
            });
        });

        // Edit button click handler
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                fetch(`/pemberian-obat/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('edit_id').value = data.id;
                        document.getElementById('edit_id_obat').value = data.id_obat;
                        document.getElementById('edit_dosis').value = data.dosis;
                        document.getElementById('edit_waktu_pemberian').value = data.waktu_pemberian.split(' ')[0];
                        document.getElementById('edit_keterangan').value = data.keterangan;
                        
                        // Show modal
                        new bootstrap.Modal(document.getElementById('editPemberianObatModal')).show();
                    });
            });
        });

        // Helper functions
        function calculateAge(birthdate) {
            const birthDate = new Date(birthdate);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            
            return age;
        }

        function formatDateTime(dateTimeString) {
            const date = new Date(dateTimeString);
            return date.toLocaleDateString('id-ID') + ' ' + date.toLocaleTimeString('id-ID');
        }
    </script>

@endsection
