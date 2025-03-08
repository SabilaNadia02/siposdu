@extends('layouts.master')

@section('title', 'Edit Data Ibu Hamil')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0" style="color: #333333; font-size: 1.5rem;">Edit Data Ibu Hamil</h3>
                        <p style="color: #777777; font-size: 1rem;">Perbarui informasi data ibu hamil.</p>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end align-items-center">
                        <button type="submit" class="btn btn-primary me-2"><i class="fas fa-save"></i> Simpan Perubahan</button>
                        <a href="{{ route('pencatatan.ibu.show', $data->id) }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="card shadow-sm" style="border-radius: 0px; border-top: 3px solid #007BFF;">
                    <div class="card-body">
                        <form action="{{ route('pencatatan.ibu.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">No Pendaftaran</label>
                                <input type="text" class="form-control"
                                    value="{{ str_pad($data->pendaftaran->id, 4, '0', STR_PAD_LEFT) }}" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Ibu</label>
                                <input type="text" class="form-control" value="{{ $data->pendaftaran->nama }}" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Suami</label>
                                <input type="text" class="form-control" name="nama_suami" value="{{ $data->nama_suami }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Hamil Ke</label>
                                <input type="number" class="form-control" name="hamil_ke" value="{{ $data->hamil_ke }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jarak Anak (tahun)</label>
                                <input type="number" class="form-control" name="jarak_anak" value="{{ $data->jarak_anak }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tinggi Badan (cm)</label>
                                <input type="number" class="form-control" name="tinggi_badan"
                                    value="{{ $data->tinggi_badan }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Hari Pertama Haid Terakhir (HPHT)</label>
                                <input type="date" class="form-control" name="hpht" value="{{ $data->hpht }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Hari Taksiran Persalinan (HTP)</label>
                                <input type="date" class="form-control" name="htp" value="{{ $data->htp }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Usia Kehamilan (minggu)</label>
                                <input type="number" class="form-control" name="usia_kehamilan"
                                    value="{{ $data->usia_kehamilan }}" required>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
