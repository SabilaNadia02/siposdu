{{-- @extends('layouts.master')

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
                        <a href="#" class="btn me-2 text-light" style="background-color: #FF69B4;"
                            data-bs-toggle="modal" data-bs-target="#kartuPesertaModal">
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
                <div class="card shadow-sm" style="border-radius: 0px; border-top: 3px solid #FF69B4;">
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <strong>Nama:</strong>
                                <p style="font-size: 1rem;">{{ $pendaftaran->nama ?? '-' }}</p>
                            </div>
                            <div class="col-md-6">
                                <strong>NIK:</strong>
                                <p style="font-size: 1rem;">{{ $pendaftaran->nik ?? '-' }}</p>
                            </div>
                            <div class="col-md-6">
                                <strong>Jenis Kelamin:</strong>
                                <p style="font-size: 1rem;">
                                    {{ $pendaftaran->jenis_kelamin == 'L' || $pendaftaran->jenis_kelamin == '1' ? 'Laki-Laki' : 'Perempuan' }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <strong>Status Perkawinan:</strong>
                                <p style="font-size: 1rem;">
                                    @php
                                        $statusPerkawinanList = [
                                            1 => 'Tidak Menikah',
                                            2 => 'Menikah'
                                        ];
                                    @endphp
                                    {{ $statusPerkawinanList[$pendaftaran->status_perkawinan] ?? '-' }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <strong>Pendidikan:</strong>
                                <p style="font-size: 1rem;">
                                    @php
                                        $pendidikanList = [
                                            1 => 'Tidak Sekolah',
                                            2 => 'SD',
                                            3 => 'SMP',
                                            4 => 'SMU',
                                            5 => 'Akademi',
                                            6 => 'Perguruan Tinggi'
                                        ];
                                    @endphp
                                    {{ $pendidikanList[$pendaftaran->pendidikan] ?? '-' }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <strong>Pekerjaan:</strong>
                                <p style="font-size: 1rem;">{{ ucfirst($pendaftaran->pekerjaan ?? '-') }}</p>
                            </div>
                            <div class="col-md-6">
                                <strong>Tempat Lahir:</strong>
                                <p style="font-size: 1rem;">{{ $pendaftaran->tempat_lahir ?? '-' }}</p>
                            </div>
                            <div class="col-md-6">
                                <strong>Tanggal Lahir:</strong>
                                <p style="font-size: 1rem;">
                                    {{ \Carbon\Carbon::parse($pendaftaran->tanggal_lahir)->translatedFormat('j F Y') }}
                                </p>
                            </div>                            
                            <div class="col-md-6">
                                <strong>No. Handphone:</strong>
                                <p style="font-size: 1rem;">{{ $pendaftaran->no_hp ?? '-' }}</p>
                            </div>
                            <div class="col-md-6">
                                <strong>No. JKN:</strong>
                                <p style="font-size: 1rem;">{{ $pendaftaran->no_jkn ?? '-' }}</p>
                            </div>
                            <div class="col-md-6">
                                <strong>Jenis Sasaran:</strong>
                                <p style="font-size: 1rem;">
                                    @php
                                        $jenisSasaranList = [
                                            1 => 'Ibu Hamil',
                                            2 => 'Balita',
                                            3 => 'Lansia'
                                        ];
                                    @endphp
                                    {{ $jenisSasaranList[$pendaftaran->jenis_sasaran] ?? '-' }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <strong>Nama Posyandu:</strong>
                                <p style="font-size: 1rem;">
                                    {{ $pendaftaran->posyandus->nama ?? '-' }}
                                </p>
                            </div>
                            <div class="col-12">
                                <strong>Alamat:</strong>
                                <p class="text-wrap" style="font-size: 1rem;">{{ $pendaftaran->alamat ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
 --}}

 @extends('layouts.master')

@section('title', 'Detail Pendaftaran')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0" style="color: #333333;">Detail Pendaftaran</h3>
                    <p style="color: #777777;">Halaman ini menampilkan detail data pendaftaran peserta posyandu.</p>
                </div>
                <div class="col-sm-6 d-flex justify-content-end align-items-center">
                        <a href="#" class="btn me-2 text-light" style="background-color: #FF69B4;"
                            data-bs-toggle="modal" data-bs-target="#kartuPesertaModal">
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
            <div class="row justify-content-center">
                <div class="col-md-8" style="border-radius: 0px">
                    <div class="card" style="border-top: 3px solid #FF69B4; border-radius: 0px">
                        <div class="card-body" style="border-radius: 0px">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <strong>Nama:</strong>
                                    <p style="font-size: 1rem;">{{ $pendaftaran->nama ?? '-' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>NIK:</strong>
                                    <p style="font-size: 1rem;">{{ $pendaftaran->nik ?? '-' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Jenis Kelamin:</strong>
                                    <p style="font-size: 1rem;">
                                        {{ $pendaftaran->jenis_kelamin == 'L' || $pendaftaran->jenis_kelamin == '1' ? 'Laki-Laki' : 'Perempuan' }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Status Perkawinan:</strong>
                                    <p style="font-size: 1rem;">
                                        @php
                                            $statusPerkawinanList = [
                                                1 => 'Tidak Menikah',
                                                2 => 'Menikah'
                                            ];
                                        @endphp
                                        {{ $statusPerkawinanList[$pendaftaran->status_perkawinan] ?? '-' }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Pendidikan:</strong>
                                    <p style="font-size: 1rem;">
                                        @php
                                            $pendidikanList = [
                                                1 => 'Tidak Sekolah',
                                                2 => 'SD',
                                                3 => 'SMP',
                                                4 => 'SMU',
                                                5 => 'Akademi',
                                                6 => 'Perguruan Tinggi'
                                            ];
                                        @endphp
                                        {{ $pendidikanList[$pendaftaran->pendidikan] ?? '-' }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Pekerjaan:</strong>
                                    <p style="font-size: 1rem;">{{ $pendaftaran->pekerjaan_text ?? '-' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Tempat Lahir:</strong>
                                    <p style="font-size: 1rem;">{{ $pendaftaran->tempat_lahir ?? '-' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Tanggal Lahir:</strong>
                                    <p style="font-size: 1rem;">
                                        {{ \Carbon\Carbon::parse($pendaftaran->tanggal_lahir)->translatedFormat('m-d-Y') }} 
                                    </p>
                                </div>                            
                                <div class="col-md-6">
                                    <strong>No. Handphone:</strong>
                                    <p style="font-size: 1rem;">{{ $pendaftaran->no_hp ?? '-' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>No. JKN:</strong>
                                    <p style="font-size: 1rem;">{{ $pendaftaran->no_jkn ?? '-' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Jenis Sasaran:</strong>
                                    <p style="font-size: 1rem;">
                                        @php
                                            $jenisSasaranList = [
                                                1 => 'Ibu Hamil',
                                                2 => 'Balita',
                                                3 => 'Lansia'
                                            ];
                                        @endphp
                                        {{ $jenisSasaranList[$pendaftaran->jenis_sasaran] ?? '-' }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Nama Posyandu:</strong>
                                    <p style="font-size: 1rem;">
                                        {{ $pendaftaran->posyandus->nama ?? '-' }}
                                    </p>
                                </div>
                                <div class="col-12">
                                    <strong>Alamat:</strong>
                                    <p class="text-wrap" style="font-size: 1rem;">{{ $pendaftaran->alamat ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection