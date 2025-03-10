@extends('layouts.master')

@section('title', 'Edit Kunjungan Ibu Hamil')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0" style="color: #333333; font-size: 1.5rem;">Edit Kunjungan Posyandu</h3>
                        <p style="color: #777777; font-size: 1rem;">Halaman ini untuk mengedit data pencatatan kunjungan pada
                            Ibu Hamil.</p>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end align-items-center">
                        <a href="{{ route('pencatatan.ibu.show', [$kunjungan->id]) }}" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="card shadow-sm" style="border-radius: 0px; border-top: 3px solid #007BFF;">
                    <div class="card-body">
                        <form
                            action="{{ route('pencatatan.ibu.kunjungan.update', [$kunjungan->id, $data->id]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <table class="table">
                                <tr>
                                    <th>Tanggal Kunjungan</th>
                                    <td>
                                        <input type="date" class="form-control" name="waktu_pencatatan"
                                            value="{{ old('waktu_pencatatan', $data->waktu_pencatatan) }}" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Berat Badan (kg)</th>
                                    <td>
                                        <input type="number" class="form-control" name="berat_badan" step="0.01"
                                            value="{{ old('berat_badan', $data->berat_badan) }}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Lingkar Lengan (cm)</th>
                                    <td>
                                        <input type="number" class="form-control" name="lingkar_lengan" step="0.01"
                                            value="{{ old('lingkar_lengan', $data->lingkar_lengan) }}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tekanan Darah (mmHg)</th>
                                    <td>
                                        <div class="d-flex">
                                            <input type="number" class="form-control me-2" name="tekanan_darah_sistolik"
                                                placeholder="Sistolik"
                                                value="{{ old('tekanan_darah_sistolik', $data->tekanan_darah_sistolik) }}">
                                            /
                                            <input type="number" class="form-control ms-2" name="tekanan_darah_diastolik"
                                                placeholder="Diastolik"
                                                value="{{ old('tekanan_darah_diastolik', $data->tekanan_darah_diastolik) }}">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>MT Bumil KEK</th>
                                    <td>
                                        <select name="mt_bumil_kek" class="form-control">
                                            <option value="">Pilih</option>
                                            <option value="1"
                                                {{ old('mt_bumil_kek', $data->mt_bumil_kek) == 1 ? 'selected' : '' }}>Ya
                                            </option>
                                            <option value="2"
                                                {{ old('mt_bumil_kek', $data->mt_bumil_kek) == 2 ? 'selected' : '' }}>Tidak
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Kelas Ibu Hamil</th>
                                    <td>
                                        <select name="kelas_ibu_hamil" class="form-control">
                                            <option value="">Pilih</option>
                                            <option value="1"
                                                {{ old('kelas_ibu_hamil', $data->kelas_ibu_hamil) == 1 ? 'selected' : '' }}>
                                                Ya</option>
                                            <option value="2"
                                                {{ old('kelas_ibu_hamil', $data->kelas_ibu_hamil) == 2 ? 'selected' : '' }}>
                                                Tidak</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Keluhan</th>
                                    <td>
                                        <textarea class="form-control" name="keluhan" maxlength="255">{{ old('keluhan', $data->keluhan) }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Edukasi</th>
                                    <td>
                                        <textarea class="form-control" name="edukasi" maxlength="255">{{ old('edukasi', $data->edukasi) }}</textarea>
                                    </td>
                                </tr>
                            </table>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-2"><i class="fas fa-save"></i> Simpan
                                    Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
