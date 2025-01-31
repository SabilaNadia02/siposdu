@extends('layouts.master')

@section('title', 'Detail Pendaftaran')

@section('content')
    <main class="app-main">

        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0" style="color: #333333; font-size: 1.5rem;">Detail Pendaftaran</h3>
                        <p style="color: #777777; font-size: 1rem;">Halaman ini menampilkan detail data pendaftaran peserta posyandu.</p>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end align-items-center">
                        <a href="#" class="btn btn-info me-3" data-bs-toggle="modal" data-bs-target="#kartuPesertaModal">
                            <i class="fas fa-id-card"></i> Lihat Kartu Peserta
                        </a>
                        @include('pendaftaran.modal.kartu_peserta')
                        <a href="{{ route('pendaftaran.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title" style="font-size: 1.25rem;">Data Peserta</h3>
                    </div>                    
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <strong>Nama:</strong>
                                <p style="font-size: 1rem;">{{ $pendaftaran->nama }}</p>
                            </div>
                            <div class="col-md-6">
                                <strong>NIK:</strong>
                                <p style="font-size: 1rem;">{{ $pendaftaran->nik }}</p>
                            </div>
                            <div class="col-md-6">
                                <strong>Jenis Kelamin:</strong>
                                <p style="font-size: 1rem;">{{ ucfirst($pendaftaran->jenis_kelamin) }}</p>
                            </div>
                            <div class="col-md-6">
                                <strong>Status Perkawinan:</strong>
                                <p style="font-size: 1rem;">{{ ucfirst($pendaftaran->status_perkawinan) }}</p>
                            </div>
                            <div class="col-md-6">
                                <strong>Pendidikan:</strong>
                                <p style="font-size: 1rem;">{{ ucfirst($pendaftaran->pendidikan) }}</p>
                            </div>
                            <div class="col-md-6">
                                <strong>Pekerjaan:</strong>
                                <p style="font-size: 1rem;">{{ ucfirst($pendaftaran->pekerjaan) }}</p>
                            </div>
                            <div class="col-md-6">
                                <strong>Tempat Lahir:</strong>
                                <p style="font-size: 1rem;">{{ $pendaftaran->tempat_lahir }}</p>
                            </div>
                            <div class="col-md-6">
                                <strong>Tanggal Lahir:</strong>
                                <p style="font-size: 1rem;">{{ date('d-m-Y', strtotime($pendaftaran->tanggal_lahir)) }}</p>
                            </div>
                            <div class="col-md-6">
                                <strong>No. Handphone:</strong>
                                <p style="font-size: 1rem;">{{ $pendaftaran->no_hp }}</p>
                            </div>
                            <div class="col-md-6">
                                <strong>No. JKN:</strong>
                                <p style="font-size: 1rem;">{{ $pendaftaran->no_jkn }}</p>
                            </div>
                            <div class="col-12">
                                <strong>Alamat:</strong>
                                <p style="font-size: 1rem;">{{ $pendaftaran->alamat }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </main>
@endsection
