@extends('layouts.master')

@section('title', 'Edit Pendaftaran')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="mb-0" style="color: #333333;">Edit Data Vitamin</h3>
                        <p style="color: #777777;">Halaman ini digunakan untuk mengubah data vitamin posyandu.
                        </p>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}" style="color: #d63384; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('data-master.vitamin.index') }}"
                                    style="color: #d63384; font-size: 16px;">Data Vitamin</a>
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
                        <div class="card" style="border-top: 3px solid #d63384; border-radius: 0px">
                            <div class="card-body" style="border-radius: 0px">
                                <form action="{{ route('data-master.vitamin.update', $vitamin->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row g-3 mb-3" style="font-size: 14px;">
                                        <div class="col-md-12">
                                            <label for="nama" class="form-label" style="font-size: 14px;">Nama
                                                Vitamin <span
                                                class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" id="nama"
                                                name="nama" value="{{ old('nama', $vitamin->nama) }}" required
                                                style="font-size: 14px;">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="keterangan" class="form-label"
                                                style="font-size: 14px;">Keterangan</label>
                                            <textarea class="form-control form-control-sm" id="keterangan" name="keterangan" rows="3"
                                                placeholder="Masukkan Keterangan" style="font-size: 14px;">{{ old('keterangan', $vitamin->keterangan) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('data-master.vitamin.index') }}"
                                            class="btn btn-secondary me-2">Batal</a>
                                        <button type="submit" class="btn text-light"
                                            style="background-color: #d63384;">Simpan Perubahan</button>
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
