@extends('layouts.master')

@section('title', 'Edit Kunjungan Balita')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0" style="color: #333333; font-size: 1.5rem;">Edit Kunjungan Posyandu</h3>
                        <p style="color: #777777; font-size: 1rem;">Halaman ini untuk mengedit data pencatatan kunjungan pada
                            Balita.</p>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end align-items-center">
                        <a href="{{ route('pencatatan.balita.show', [$kunjungan->id]) }}" class="btn btn-secondary">
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
                            action="{{ route('pencatatan.balita.kunjungan.update', ['id_pencatatan_awal' => $kunjungan->id, 'id' => $data->id]) }}"
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
                                    <th>Panjang Badan (cm)</th>
                                    <td>
                                        <input type="number" class="form-control" name="panjang_badan" step=any
                                            value="{{ old('panjang_badan', $data->panjang_badan) }}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Lingkar Lengan (cm)</th>
                                    <td>
                                        <input type="number" class="form-control" name="lingkar_lengan" step=any
                                            value="{{ old('lingkar_lengan', $data->lingkar_lengan) }}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Lingkar Kepala (cm)</th>
                                    <td>
                                        <input type="number" class="form-control" name="lingkar_kepala" step=any
                                            value="{{ old('lingkar_kepala', $data->lingkar_kepala) }}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>ASI Eksklusif?</th>
                                    <td>
                                        <select name="asi_eksklusif" class="form-control">
                                            <option value="">Pilih</option>
                                            <option value="1"
                                                {{ old('asi_eksklusif', $data->asi_eksklusif) == 1 ? 'selected' : '' }}>Ya
                                            </option>
                                            <option value="2"
                                                {{ old('asi_eksklusif', $data->asi_eksklusif) == 2 ? 'selected' : '' }}>Tidak
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>MP ASI?</th>
                                    <td>
                                        <select name="mp_asi" class="form-control">
                                            <option value="">Pilih</option>
                                            <option value="1"
                                                {{ old('mp_asi', $data->mp_asi) == 1 ? 'selected' : '' }}>Ya
                                            </option>
                                            <option value="2"
                                                {{ old('mp_asi', $data->mp_asi) == 2 ? 'selected' : '' }}>Tidak
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>MT Pangan Pemulihan?</th>
                                    <td>
                                        <select name="mt_pangan_pemulihan" class="form-control">
                                            <option value="">Pilih</option>
                                            <option value="1"
                                                {{ old('mt_pangan_pemulihan', $data->mt_pangan_pemulihan) == 1 ? 'selected' : '' }}>Ya
                                            </option>
                                            <option value="2"
                                                {{ old('mt_pangan_pemulihan', $data->mt_pangan_pemulihan) == 2 ? 'selected' : '' }}>Tidak
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Catatan Kesehatan</th>
                                    <td>
                                        <textarea class="form-control" name="catatan_kesehatan" maxlength="255">{{ old('catatan_kesehatan', $data->catatan_kesehatan) }}</textarea>
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
