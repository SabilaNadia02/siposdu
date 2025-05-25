@extends('layouts.master')

@section('title', 'Edit Pendaftaran')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="mb-0" style="color: #333333;">Edit Pendaftaran Peserta Posyandu</h3>
                        <p style="color: #777777;">Halaman ini digunakan untuk mengubah data pendaftaran peserta posyandu.
                        </p>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}" style="color: #d63384; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('pendaftaran.index') }}"
                                    style="color: #d63384; font-size: 16px;">Pendaftaran</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-8" style="border-radius: 0px">
                        <div class="card" style="border-top: 3px solid #d63384; border-radius: 0px">
                            <div class="card-body" style="border-radius: 0px">

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('pendaftaran.update', $pendaftaran->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label for="nik" class="form-label">NIK <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="nik"
                                                value="{{ old('nik', $pendaftaran->nik) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="nama" class="form-label">Nama <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="nama"
                                                value="{{ old('nama', $pendaftaran->nama) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" name="jenis_kelamin">
                                                <option value="1"
                                                    {{ $pendaftaran->jenis_kelamin == 1 ? 'selected' : '' }}>Laki-laki
                                                </option>
                                                <option value="2"
                                                    {{ $pendaftaran->jenis_kelamin == 2 ? 'selected' : '' }}>Perempuan
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="status_perkawinan" class="form-label">Status Perkawinan <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" name="status_perkawinan">
                                                <option value="1"
                                                    {{ $pendaftaran->status_perkawinan == 1 ? 'selected' : '' }}>Tidak
                                                    Menikah</option>
                                                <option value="2"
                                                    {{ $pendaftaran->status_perkawinan == 2 ? 'selected' : '' }}>Menikah
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="tempat_lahir" class="form-label">Tempat Lahir <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="tempat_lahir"
                                                value="{{ old('tempat_lahir', $pendaftaran->tempat_lahir) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span
                                                    style="font-size: 11px; font-weight: normal;">(bulan/tanggal/tahun)</span>
                                                <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="tanggal_lahir"
                                                value="{{ old('tanggal_lahir', $pendaftaran->tanggal_lahir) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="pendidikan" class="form-label">Pendidikan <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" name="pendidikan">
                                                <option value="1"
                                                    {{ $pendaftaran->pendidikan == 1 ? 'selected' : '' }}>Tidak Sekolah
                                                </option>
                                                <option value="2"
                                                    {{ $pendaftaran->pendidikan == 2 ? 'selected' : '' }}>SD</option>
                                                <option value="3"
                                                    {{ $pendaftaran->pendidikan == 3 ? 'selected' : '' }}>SMP</option>
                                                <option value="4"
                                                    {{ $pendaftaran->pendidikan == 4 ? 'selected' : '' }}>SMA</option>
                                                <option value="5"
                                                    {{ $pendaftaran->pendidikan == 5 ? 'selected' : '' }}>Diploma/Sarjana
                                                </option>
                                                <option value="6"
                                                    {{ $pendaftaran->pendidikan == 6 ? 'selected' : '' }}>Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="pekerjaan" class="form-label">Pekerjaan <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" name="pekerjaan">
                                                <option value="1"
                                                    {{ $pendaftaran->pekerjaan == 1 ? 'selected' : '' }}>Tidak Bekerja
                                                </option>
                                                <option value="2"
                                                    {{ $pendaftaran->pekerjaan == 2 ? 'selected' : '' }}>PNS</option>
                                                <option value="3"
                                                    {{ $pendaftaran->pekerjaan == 3 ? 'selected' : '' }}>TNI/Polri</option>
                                                <option value="4"
                                                    {{ $pendaftaran->pekerjaan == 4 ? 'selected' : '' }}>Swasta</option>
                                                <option value="5"
                                                    {{ $pendaftaran->pekerjaan == 5 ? 'selected' : '' }}>Wirausaha</option>
                                                <option value="6"
                                                    {{ $pendaftaran->pekerjaan == 6 ? 'selected' : '' }}>Petani</option>
                                                <option value="7"
                                                    {{ $pendaftaran->pekerjaan == 7 ? 'selected' : '' }}>Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="alamat" class="form-label">Alamat <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control" name="alamat" rows="3">{{ old('alamat', $pendaftaran->alamat) }}</textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="no_hp" class="form-label">No HP <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="no_hp"
                                                value="{{ old('no_hp', $pendaftaran->no_hp) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="no_jkn" class="form-label">No JKN <span
                                                    style="font-size: 11px; font-weight: normal;">(opsional)</span></label>
                                            <input type="text" class="form-control" name="no_jkn"
                                                value="{{ old('no_jkn', $pendaftaran->no_jkn) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="jenis_sasaran" class="form-label">Jenis Sasaran <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" name="jenis_sasaran">
                                                <option value="1"
                                                    {{ $pendaftaran->jenis_sasaran == 1 ? 'selected' : '' }}>Ibu Hamil
                                                </option>
                                                <option value="2"
                                                    {{ $pendaftaran->jenis_sasaran == 2 ? 'selected' : '' }}>Balita
                                                </option>
                                                <option value="3"
                                                    {{ $pendaftaran->jenis_sasaran == 3 ? 'selected' : '' }}>Lansia
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="data_posyandu_id" class="form-label">Nama Posyandu <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" name="data_posyandu_id">
                                                @foreach ($posyandus as $posyandu)
                                                    <option value="{{ $posyandu->id }}"
                                                        {{ $pendaftaran->data_posyandu_id == $posyandu->id ? 'selected' : '' }}>
                                                        {{ $posyandu->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('pendaftaran.index') }}"
                                            class="btn btn-secondary me-2">Batal</a>
                                        <button type="submit" class="btn text-light"
                                            style="background-color: #d63384;">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
