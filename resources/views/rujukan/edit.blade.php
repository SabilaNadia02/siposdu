@extends('layouts.master')

@section('title', 'Edit Rujukan')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8">
                    <h3 class="mb-0" style="color: #333333;">Edit Data Rujukan</h3>
                    <p style="color: #777777;">Halaman ini digunakan untuk mengubah data rujukan peserta posyandu.</p>
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="#" style="color: #d63384; font-size: 16px;">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('rujukan.index') }}" style="color: #d63384; font-size: 16px;">Rujukan</a>
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
                        <div class="card-header bg-white" style="border-radius: 0px">
                            <h3 class="card-title">Form Edit Data Rujukan</h3>
                        </div>
                        <div class="card-body" style="border-radius: 0px">
                            <form action="{{ route('rujukan.update', $rujukan->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="waktu_rujukan" class="form-label">
                                        Waktu Rujukan <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" id="waktu_rujukan" name="waktu_rujukan" class="form-control"
                                        value="{{ old('waktu_rujukan', \Carbon\Carbon::parse($rujukan->waktu_rujukan)->format('Y-m-d')) }}" disabled>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="no_pendaftaran" class="form-label">
                                        Nama Peserta <span class="text-danger">*</span>
                                    </label>
                                    <select name="no_pendaftaran" id="no_pendaftaran" class="form-select" disabled>
                                        <option disabled selected>Pilih Peserta</option>
                                        @foreach ($pendaftarans as $pendaftaran)
                                            <option value="{{ $pendaftaran->id }}"
                                                {{ $rujukan->no_pendaftaran == $pendaftaran->id ? 'selected' : '' }}>
                                                {{ $pendaftaran->nama }} 
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="jenis_rujukan" class="form-label">
                                        Jenis Rujukan <span class="text-danger">*</span>
                                    </label>
                                    <select name="jenis_rujukan" id="jenis_rujukan" class="form-select" required>
                                        <option disabled selected>Pilih Rujukan</option>
                                        <option value=1 {{ $rujukan->jenis_rujukan == 1 ? 'selected' : '' }}>Pustu</option>
                                        <option value=2 {{ $rujukan->jenis_rujukan == 2 ? 'selected' : '' }}>Puskesmas</option>
                                        <option value=3 {{ $rujukan->jenis_rujukan == 3 ? 'selected' : '' }}>Rumah Sakit</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" rows="4" class="form-control" placeholder="Masukkan Keterangan">{{ old('keterangan', $rujukan->keterangan) }}</textarea>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('rujukan.index') }}" class="btn btn-secondary me-2">Batal</a>
                                    <button type="submit" class="btn text-light" style="background-color: #d63384;">Simpan Perubahan</button>
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
