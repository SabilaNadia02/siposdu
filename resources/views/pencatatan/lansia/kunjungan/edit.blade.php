@extends('layouts.master')

@section('title', 'Edit Kunjungan Lansia Hamil')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0" style="color: #333333; font-size: 1.5rem;">Edit Kunjungan Posyandu</h3>
                        <p style="color: #777777; font-size: 1rem;">Halaman ini untuk mengedit data pencatatan kunjungan pada
                            Peserta Usia Subur atau Lansia.</p>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end align-items-center">
                        <a href="{{ route('pencatatan.lansia.show', [$kunjungan->id]) }}" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="card shadow-sm" style="border-radius: 0px; border-top: 3px solid #FF8F00;"> 
                    <div class="card-body">
                        <form
                            action="{{ route('pencatatan.lansia.kunjungan.update', ['id_pencatatan_awal' => $kunjungan->id, 'id' => $data->id]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            {{-- @dd($data); --}}

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
                                        <input type="number" class="form-control" name="berat_badan" step=any
                                            value="{{ old('berat_badan', $data->berat_badan) }}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tinggi Badan (cm)</th>
                                    <td>
                                        <input type="number" class="form-control" name="tinggi_badan" step=any
                                            value="{{ old('tinggi_badan', $data->tinggi_badan) }}">
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
                                    <th>Lingkar Perut (cm)</th>
                                    <td>
                                        <input type="number" class="form-control" name="lingkar_perut" step=any
                                            value="{{ old('lingkar_perut', $data->lingkar_perut) }}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Gula Darah (mg/dL)</th>
                                    <td>
                                        <input type="number" class="form-control" name="gula_darah" step=any
                                            value="{{ old('gula_darah', $data->gula_darah) }}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Kolestrol (mg/dL)</th>
                                    <td>
                                        <input type="number" class="form-control" name="kolestrol" step=any
                                            value="{{ old('kolestrol', $data->kolestrol) }}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tes Hitung Jari (Mata Kanan)</th>
                                    <td>
                                        <select name="tes_mata_kanan" class="form-control">
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
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tes Hitung Jari (Mata Kiri)</th>
                                    <td>
                                        <select name="tes_mata_kiri" class="form-control">
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
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tes Berbisik (Telinga Kanan)</th>
                                    <td>
                                        <select name="tes_telinga_kanan" class="form-control">
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
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tes Berbisik (Telinga Kiri)</th>
                                    <td>
                                        <select name="tes_telinga_kiri" class="form-control">
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
                                <button type="submit" class="btn me-2 text-light" style="background-color: #FF8F00;"><i class="fas fa-save"></i> Simpan
                                    Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
