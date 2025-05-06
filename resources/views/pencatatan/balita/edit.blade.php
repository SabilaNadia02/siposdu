@extends('layouts.master')

@section('title', 'Edit Data Balita')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="mb-0" style="color: #333333;">Edit Data Balita</h3>
                        <p style="color: #777777;">Halaman ini digunakan untuk mengubah data balita.</p>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="#" style="color: #28A745; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('pencatatan.balita.show', $data->id) }}"
                                    style="color: #28A745; font-size: 16px;">Data Balita</a>
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
                        <div class="card" style="border-top: 3px solid #28A745; border-radius: 0px">
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

                                <form action="{{ route('pencatatan.balita.update', $data->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">No Pendaftaran <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control"
                                                value="{{ str_pad($data->pendaftaran->id, 4, '0', STR_PAD_LEFT) }}" disabled>
                                            <input type="hidden" name="no_pendaftaran" value="{{ $data->pendaftaran->id }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Nama Balita <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="{{ $data->pendaftaran->nama }}" disabled>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Nama Ibu <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="nama_ibu" 
                                                value="{{ $data->nama_ibu }}" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Nama Ayah <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="nama_ayah" 
                                                value="{{ $data->nama_ayah }}" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Berat Badan Lahir (Kg) <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="berat_badan_lahir"
                                                value="{{ $data->berat_badan_lahir }}" required step="any">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Panjang Badan Lahir (cm) <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="panjang_badan_lahir"
                                                value="{{ $data->panjang_badan_lahir }}" required step="any">
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('pencatatan.balita.show', $data->id) }}"
                                            class="btn btn-secondary me-2">Batal</a>
                                        <button type="submit" class="btn text-light" style="background-color: #28A745;">
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
