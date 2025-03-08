@extends('layouts.master')

@section('title', 'Edit Pendaftaran')

@section('content')
    <main class="app-main" style="background-color: white">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0" style="color: #333333;">Edit Pendaftaran Peserta Posyandu</h3>
                        <p style="color: #777777;">Perbarui data peserta posyandu.</p>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end align-items-center">
                        <button type="submit" form="editPendaftaranForm" class="btn text-light me-2"
                            style="background-color: #FF69B4;">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
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
                        <form id="editPendaftaranForm" action="{{ route('pendaftaran.update', $pendaftaran->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nik" class="form-label">NIK</label>
                                    <input type="text" class="form-control" name="nik"
                                        value="{{ old('nik', $pendaftaran->nik) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama"
                                        value="{{ old('nama', $pendaftaran->nama) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" name="jenis_kelamin" required>
                                        <option value="1" {{ $pendaftaran->jenis_kelamin == 1 ? 'selected' : '' }}>
                                            Laki-laki</option>
                                        <option value="2" {{ $pendaftaran->jenis_kelamin == 2 ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="status_perkawinan" class="form-label">Status Perkawinan</label>
                                    <select class="form-select" name="status_perkawinan" required>
                                        <option value="1" {{ $pendaftaran->status_perkawinan == 1 ? 'selected' : '' }}>
                                            Tidak Menikah</option>
                                        <option value="2" {{ $pendaftaran->status_perkawinan == 2 ? 'selected' : '' }}>
                                            Menikah</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tempat_lahir"
                                        value="{{ old('tempat_lahir', $pendaftaran->tempat_lahir) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tanggal_lahir"
                                        value="{{ old('tanggal_lahir', $pendaftaran->tanggal_lahir) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="pendidikan" class="form-label">Pendidikan</label>
                                    <select class="form-select" name="pendidikan" required>
                                        <option value="1" {{ $pendaftaran->pendidikan == 1 ? 'selected' : '' }}>Tidak
                                            Sekolah</option>
                                        <option value="2" {{ $pendaftaran->pendidikan == 2 ? 'selected' : '' }}>SD
                                        </option>
                                        <option value="3" {{ $pendaftaran->pendidikan == 3 ? 'selected' : '' }}>SMP
                                        </option>
                                        <option value="4" {{ $pendaftaran->pendidikan == 4 ? 'selected' : '' }}>SMA
                                        </option>
                                        <option value="5" {{ $pendaftaran->pendidikan == 5 ? 'selected' : '' }}>
                                            Diploma/Sarjana</option>
                                        <option value="6" {{ $pendaftaran->pendidikan == 6 ? 'selected' : '' }}>
                                            Lainnya</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                    <input type="text" class="form-control" name="pekerjaan"
                                        value="{{ old('pekerjaan', $pendaftaran->pekerjaan) }}" required>
                                </div>
                                <div class="col-12">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" name="alamat" rows="2" required>{{ old('alamat', $pendaftaran->alamat) }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="no_hp" class="form-label">No HP</label>
                                    <input type="text" class="form-control" name="no_hp"
                                        value="{{ old('no_hp', $pendaftaran->no_hp) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="no_jkn" class="form-label">No JKN (Opsional)</label>
                                    <input type="text" class="form-control" name="no_jkn"
                                        value="{{ old('no_jkn', $pendaftaran->no_jkn) }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="jenis_sasaran" class="form-label">Jenis Sasaran</label>
                                    <select class="form-select" name="jenis_sasaran" required>
                                        <option value="1" {{ $pendaftaran->jenis_sasaran == 1 ? 'selected' : '' }}>
                                            Ibu Hamil</option>
                                        <option value="2" {{ $pendaftaran->jenis_sasaran == 2 ? 'selected' : '' }}>
                                            Balita</option>
                                        <option value="3" {{ $pendaftaran->jenis_sasaran == 3 ? 'selected' : '' }}>
                                            Lansia</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="data_posyandu_id" class="form-label">Nama Posyandu</label>
                                    <select class="form-select" name="data_posyandu_id" required>
                                        @foreach ($posyandus as $posyandu)
                                            <option value="{{ $posyandu->id }}"
                                                {{ $pendaftaran->data_posyandu_id == $posyandu->id ? 'selected' : '' }}>
                                                {{ $posyandu->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
