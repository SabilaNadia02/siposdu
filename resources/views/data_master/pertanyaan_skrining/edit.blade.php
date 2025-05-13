@extends('layouts.master')

@section('title', 'Edit Pertanyaan')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="mb-0" style="color: #333333;">Edit Data Pertanyaan Skrining</h3>
                        <p style="color: #777777;">Halaman ini digunakan untuk mengubah data pertanyaan skrining posyandu.</p>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}" style="color: #d63384; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('data-master.pertanyaan-skrining.index') }}"
                                    style="color: #d63384; font-size: 16px;">Data Pertanyaan Skrining</a>
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
                                <form id="editPertanyaanForm"
                                    action="{{ route('data-master.pertanyaan-skrining.update', $pertanyaanSkrining->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row g-3 mb-3" style="font-size: 14px;">
                                        <div class="col-md-12">
                                            <label for="id_skrining" class="form-label">Nama Skrining <span
                                                class="text-danger">*</span></label>
                                            <select class="form-select form-select-sm" id="id_skrining" name="id_skrining"
                                                required>
                                                <option value="" hidden>Pilih Nama Skrining</option>
                                                @foreach ($dataSkrining as $data)
                                                    <option value="{{ $data->id }}"
                                                        {{ $data->id == $pertanyaanSkrining->id_skrining ? 'selected' : '' }}>
                                                        {{ $data->nama_skrining }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="id_pertanyaan" class="form-label">Pertanyaan Skrining <span
                                                class="text-danger">*</span></label>
                                            <select class="form-select form-select-sm" id="id_pertanyaan"
                                                name="id_pertanyaan" required>
                                                <option value="" hidden>Pilih Pertanyaan Skrining</option>
                                                @foreach ($dataPertanyaan as $data)
                                                    <option value="{{ $data->id }}"
                                                        {{ $data->id == $pertanyaanSkrining->id_pertanyaan ? 'selected' : '' }}>
                                                        {{ $data->nama_pertanyaan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('data-master.pertanyaan-skrining.index') }}"
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
