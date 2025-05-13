@extends('layouts.master')

@section('title', 'Edit Kunjungan Lansia')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="mb-0" style="color: #333333;">Edit Kunjungan Posyandu</h3>
                        <p style="color: #777777;">Halaman ini untuk mengedit data pencatatan kunjungan pada Lansia.</p>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}" style="color: #FF8F00; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('pencatatan.lansia.show', $kunjungan->id) }}"
                                    style="color: #FF8F00; font-size: 16px;">Kunjungan Lansia</a>
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
                        <div class="card" style="border-top: 3px solid #FF8F00; border-radius: 0px">
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

                                <form action="{{ route('pencatatan.lansia.kunjungan.update', ['id_pencatatan_awal' => $kunjungan->id, 'id' => $data->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label for="waktu_pencatatan" class="form-label">Tanggal Kunjungan <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="waktu_pencatatan"
                                                value="{{ old('waktu_pencatatan', $data->waktu_pencatatan ? \Carbon\Carbon::parse($data->waktu_pencatatan)->format('Y-m-d') : '') }}"
                                                required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="berat_badan" class="form-label">Berat Badan (kg) <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="berat_badan" step="0.01"
                                                value="{{ old('berat_badan', $data->berat_badan) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Tekanan Darah (mmHg) <span class="text-danger">*</span></label>
                                            <div class="d-flex">
                                                <input type="number" class="form-control me-2"
                                                    name="tekanan_darah_sistolik" placeholder="Sistolik"
                                                    value="{{ old('tekanan_darah_sistolik', $data->tekanan_darah_sistolik) }}">
                                                /
                                                <input type="number" class="form-control ms-2"
                                                    name="tekanan_darah_diastolik" placeholder="Diastolik"
                                                    value="{{ old('tekanan_darah_diastolik', $data->tekanan_darah_diastolik) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lingkar_perut" class="form-label">Lingkar Perut (cm) <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="lingkar_perut" step="0.01"
                                                value="{{ old('lingkar_perut', $data->lingkar_perut) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="gula_darah" class="form-label">Gula Darah (mg/dL)</label>
                                            <input type="number" class="form-control" name="gula_darah" step="0.01"
                                                value="{{ old('gula_darah', $data->gula_darah) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="kolestrol" class="form-label">Kolesterol (mg/dL)</label>
                                            <input type="number" class="form-control" name="kolestrol" step="0.01"
                                                value="{{ old('kolestrol', $data->kolestrol) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="tes_mata_kanan" class="form-label">Tes Hitung Jari (Mata Kanan)</label>
                                            <select name="tes_mata_kanan" class="form-select">
                                                <option value="">Pilih</option>
                                                <option value="1"
                                                    {{ old('tes_mata_kanan', $data->tes_mata_kanan) == 1 ? 'selected' : '' }}>
                                                    Normal (N)
                                                </option>
                                                <option value="2"
                                                    {{ old('tes_mata_kanan', $data->tes_mata_kanan) == 2 ? 'selected' : '' }}>
                                                    Tidak Normal (TN)
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="tes_mata_kiri" class="form-label">Tes Hitung Jari (Mata Kiri)</label>
                                            <select name="tes_mata_kiri" class="form-select">
                                                <option value="">Pilih</option>
                                                <option value="1"
                                                    {{ old('tes_mata_kiri', $data->tes_mata_kiri) == 1 ? 'selected' : '' }}>
                                                    Normal (N)
                                                </option>
                                                <option value="2"
                                                    {{ old('tes_mata_kiri', $data->tes_mata_kiri) == 2 ? 'selected' : '' }}>
                                                    Tidak Normal (TN)
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="tes_telinga_kanan" class="form-label">Tes Berbisik (Telinga Kanan)</label>
                                            <select name="tes_telinga_kanan" class="form-select">
                                                <option value="">Pilih</option>
                                                <option value="1"
                                                    {{ old('tes_telinga_kanan', $data->tes_telinga_kanan) == 1 ? 'selected' : '' }}>
                                                    Normal (N)
                                                </option>
                                                <option value="2"
                                                    {{ old('tes_telinga_kanan', $data->tes_telinga_kanan) == 2 ? 'selected' : '' }}>
                                                    Tidak Normal (TN)
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="tes_telinga_kiri" class="form-label">Tes Berbisik (Telinga Kiri)</label>
                                            <select name="tes_telinga_kiri" class="form-select">
                                                <option value="">Pilih</option>
                                                <option value="1"
                                                    {{ old('tes_telinga_kiri', $data->tes_telinga_kiri) == 1 ? 'selected' : '' }}>
                                                    Normal (N)
                                                </option>
                                                <option value="2"
                                                    {{ old('tes_telinga_kiri', $data->tes_telinga_kiri) == 2 ? 'selected' : '' }}>
                                                    Tidak Normal (TN)
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="keluhan" class="form-label">Keluhan</label>
                                            <textarea class="form-control" name="keluhan" rows="2" maxlength="255">{{ old('keluhan', $data->keluhan) }}</textarea>
                                        </div>
                                        <div class="col-12">
                                            <label for="edukasi" class="form-label">Edukasi</label>
                                            <textarea class="form-control" name="edukasi" rows="2" maxlength="255">{{ old('edukasi', $data->edukasi) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('pencatatan.lansia.show', $kunjungan->id) }}"
                                            class="btn btn-secondary me-2">Batal</a>
                                        <button type="submit" class="btn text-light" style="background-color: #FF8F00;">
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
