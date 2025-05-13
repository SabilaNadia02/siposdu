@extends('layouts.master')

@section('title', 'Edit Kunjungan Balita')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="mb-0" style="color: #333333;">Edit Kunjungan Posyandu</h3>
                        <p style="color: #777777;">Halaman ini digunakan untuk mengubah data kunjungan balita.</p>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}" style="color: #198754; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('pencatatan.balita.show', $kunjungan->id) }}"
                                    style="color: #198754; font-size: 16px;">Kunjungan Balita</a>
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
                        <div class="card" style="border-top: 3px solid #198754; border-radius: 0px">
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

                                <form
                                    action="{{ route('pencatatan.balita.kunjungan.update', ['id_pencatatan_awal' => $pencatatanAwal->id, 'id' => $data->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Tanggal Kunjungan <span
                                                    class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="waktu_pencatatan"
                                                value="{{ old('waktu_pencatatan', $data->waktu_pencatatan ? \Carbon\Carbon::parse($data->waktu_pencatatan)->format('Y-m-d') : '') }}"
                                                required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Berat Badan (kg) <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="berat_badan" step="0.01"
                                                value="{{ old('berat_badan', $data->berat_badan) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Panjang Badan (cm) <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="panjang_badan" step="0.01"
                                                value="{{ old('panjang_badan', $data->panjang_badan) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Lingkar Lengan (cm) <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="lingkar_lengan" step="0.01"
                                                value="{{ old('lingkar_lengan', $data->lingkar_lengan) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Lingkar Kepala (cm) <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="lingkar_kepala" step="0.01"
                                                value="{{ old('lingkar_kepala', $data->lingkar_kepala) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">ASI Eksklusif</label>
                                            <select name="asi_eksklusif" class="form-select">
                                                <option value="">Pilih</option>
                                                <option value="1"
                                                    {{ old('asi_eksklusif', $data->asi_eksklusif) == 1 ? 'selected' : '' }}>
                                                    Ya</option>
                                                <option value="2"
                                                    {{ old('asi_eksklusif', $data->asi_eksklusif) == 2 ? 'selected' : '' }}>
                                                    Tidak</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">MP ASI</label>
                                            <select name="mp_asi" class="form-select">
                                                <option value="">Pilih</option>
                                                <option value="1"
                                                    {{ old('mp_asi', $data->mp_asi) == 1 ? 'selected' : '' }}>Ya</option>
                                                <option value="2"
                                                    {{ old('mp_asi', $data->mp_asi) == 2 ? 'selected' : '' }}>Tidak
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">MT Pangan Pemulihan</label>
                                            <select name="mt_pangan_pemulihan" class="form-select">
                                                <option value="">Pilih</option>
                                                <option value="1"
                                                    {{ old('mt_pangan_pemulihan', $data->mt_pangan_pemulihan) == 1 ? 'selected' : '' }}>
                                                    Ya</option>
                                                <option value="2"
                                                    {{ old('mt_pangan_pemulihan', $data->mt_pangan_pemulihan) == 2 ? 'selected' : '' }}>
                                                    Tidak</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Catatan Kesehatan</label>
                                            <textarea class="form-control" name="catatan_kesehatan" rows="2" maxlength="255">{{ old('catatan_kesehatan', $data->catatan_kesehatan) }}</textarea>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Keluhan</label>
                                            <textarea class="form-control" name="keluhan" rows="2" maxlength="255">{{ old('keluhan', $data->keluhan) }}</textarea>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Edukasi</label>
                                            <textarea class="form-control" name="edukasi" rows="2" maxlength="255">{{ old('edukasi', $data->edukasi) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('pencatatan.balita.show', $kunjungan->id) }}"
                                            class="btn btn-secondary me-2">Batal</a>
                                        <button type="submit" class="btn text-light" style="background-color: #198754;">
                                            <i class="fas fa-save"></i> Simpan Perubahan
                                        </button>
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
