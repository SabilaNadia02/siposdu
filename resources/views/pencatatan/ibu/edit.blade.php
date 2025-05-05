@extends('layouts.master')

@section('title', 'Edit Data Ibu Hamil')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="mb-0" style="color: #333333;">Edit Data Ibu Hamil</h3>
                        <p style="color: #777777;">Halaman ini digunakan untuk mengubah data ibu hamil.</p>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="#" style="color: #007BFF; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('pencatatan.ibu.show', $data->id) }}"
                                    style="color: #007BFF; font-size: 16px;">Data Ibu Hamil</a>
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

                                <form action="{{ route('pencatatan.ibu.update', $data->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">No Pendaftaran <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control"
                                                value="{{ str_pad($data->pendaftaran->id, 4, '0', STR_PAD_LEFT) }}"
                                                disabled>
                                            <input type="hidden" name="no_pendaftaran"
                                                value="{{ $data->pendaftaran->id }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Nama Ibu <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control"
                                                value="{{ $data->pendaftaran->nama }}" disabled>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Nama Suami <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="nama_suami"
                                                value="{{ $data->nama_suami }}" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Hamil Ke <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="hamil_ke"
                                                value="{{ $data->hamil_ke }}" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Jarak Anak (tahun) <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="jarak_anak"
                                                value="{{ $data->jarak_anak }}" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Tinggi Badan (cm) <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="tinggi_badan"
                                                value="{{ $data->tinggi_badan }}" required step="any">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">HPHT <span
                                                    style="font-size: 11px; font-weight: normal;">(Hari Pertama Haid
                                                    Terakhir)</span> <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="hpht"
                                                value="{{ $data->hpht }}" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">HTP <span
                                                    style="font-size: 11px; font-weight: normal;">(Hari Taksiran
                                                    Persalinan)</span> <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="htp"
                                                value="{{ $data->htp }}" disabled>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Usia Kehamilan (minggu) <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="usia_kehamilan"
                                                value="{{ $data->usia_kehamilan }}" disabled>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('pencatatan.ibu.show', $data->id) }}"
                                            class="btn btn-secondary me-2">Batal</a>
                                        <button type="submit" class="btn text-light" style="background-color: #007BFF;">
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
