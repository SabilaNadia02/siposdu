@extends('layouts.master')

@section('title', 'Edit Kunjungan Ibu Hamil')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="mb-0" style="color: #333333;">Edit Kunjungan Posyandu</h3>
                        <p style="color: #777777;">Halaman ini untuk mengedit data pencatatan kunjungan pada Ibu Hamil.</p>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}" style="color: #007BFF; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('pencatatan.ibu.show', [$kunjungan->id]) }}"
                                    style="color: #007BFF; font-size: 16px;">Kunjungan Ibu Hamil</a>
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
                        <div class="card" style="border-top: 3px solid #007BFF; border-radius: 0px">
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
                                    action="{{ route('pencatatan.ibu.kunjungan.update', ['id_pencatatan_awal' => $pencatatanAwal->id, 'id' => $data->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')

                                    {{-- @dd($kunjungan) --}}

                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label for="waktu_pencatatan" class="form-label">Tanggal Kunjungan <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="waktu_pencatatan"
                                                value="{{ old('waktu_pencatatan', $data->waktu_pencatatan ? \Carbon\Carbon::parse($data->waktu_pencatatan)->format('Y-m-d') : '') }}"
                                                required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="berat_badan" class="form-label">Berat Badan (kg) <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="berat_badan" step="0.01"
                                                value="{{ old('berat_badan', $data->berat_badan) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lingkar_lengan" class="form-label">Lingkar Lengan (cm) <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="lingkar_lengan" step="0.01"
                                                value="{{ old('lingkar_lengan', $data->lingkar_lengan) }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Tekanan Darah (mmHg) <span
                                                    class="text-danger">*</span></label>
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
                                            <label for="mt_bumil_kek" class="form-label">MT Bumil KEK</label>
                                            <select name="mt_bumil_kek" class="form-select">
                                                <option value="">Pilih</option>
                                                <option value="1"
                                                    {{ old('mt_bumil_kek', $data->mt_bumil_kek) == 1 ? 'selected' : '' }}>
                                                    Ya
                                                </option>
                                                <option value="2"
                                                    {{ old('mt_bumil_kek', $data->mt_bumil_kek) == 2 ? 'selected' : '' }}>
                                                    Tidak</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="kelas_ibu_hamil" class="form-label">Kelas Ibu Hamil</label>
                                            <select name="kelas_ibu_hamil" class="form-select">
                                                <option value="">Pilih</option>
                                                <option value="1"
                                                    {{ old('kelas_ibu_hamil', $data->kelas_ibu_hamil) == 1 ? 'selected' : '' }}>
                                                    Ya</option>
                                                <option value="2"
                                                    {{ old('kelas_ibu_hamil', $data->kelas_ibu_hamil) == 2 ? 'selected' : '' }}>
                                                    Tidak</option>
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
                                        <a href="{{ route('pencatatan.ibu.show', $pencatatanAwal->id) }}"
                                            class="btn btn-secondary me-2">Batal</a>
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan
                                            Perubahan</button>
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
