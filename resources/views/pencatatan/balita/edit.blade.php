@extends('layouts.master')

@section('title', 'Edit Data Balita')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0" style="color: #333333; font-size: 1.5rem;">Edit Data Balita</h3>
                        <p style="color: #777777; font-size: 1rem;">Perbarui informasi data balita.</p>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end align-items-center">
                        <a href="{{ route('pencatatan.balita.show', $data->id) }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="card shadow-sm" style="border-radius: 0px; border-top: 3px solid #28A745;">
                    <div class="card-body">
                        <form action="{{ route('pencatatan.balita.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">No Pendaftaran</label>
                                <input type="text" class="form-control"
                                    value="{{ str_pad($data->pendaftaran->id, 4, '0', STR_PAD_LEFT) }}" disabled>
                                <input type="hidden" name="no_pendaftaran" value="{{ $data->pendaftaran->id }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Balita</label>
                                <input type="text" class="form-control" value="{{ $data->pendaftaran->nama }}" disabled >
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Ibu</label>
                                <input type="text" class="form-control" name="nama_ibu" value="{{ $data->nama_ibu }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Ayah</label>
                                <input type="text" class="form-control" name="nama_ayah" value="{{ $data->nama_ayah }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Berat Badan Lahir (Kg)</label>
                                <input type="number" class="form-control" name="berat_badan_lahir"
                                    value="{{ $data->berat_badan_lahir }}" required step="any">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Panjang Badan Lahir (cm)</label>
                                <input type="number" class="form-control" name="panjang_badan_lahir"
                                    value="{{ $data->panjang_badan_lahir }}" required step="any">
                            </div>

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
