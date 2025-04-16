@extends('layouts.master')

@section('title', 'Edit Pemberian Vitamin')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="mb-0" style="color: #333333;">Edit Pemberian Vitamin</h3>
                        <p style="color: #777777;">Halaman ini digunakan untuk mengubah data pemberian vitamin peserta posyandu.</p>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href=# style="color: #FF69B4; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('pemberian.vitamin.index') }}" style="color: #FF69B4; font-size: 16px;">Pemberian Vitamin</a>
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
                        <div class="card" style="border-top: 3px solid #FF69B4; border-radius: 0px">
                            <div class="card-header bg-white" style="border-radius: 0px">
                                <h3 class="card-title">Form Edit Pemberian Vitamin</h3>
                            </div>
                            <div class="card-body" style="border-radius: 0px">
                                <form action="{{ route('pemberian.vitamin.update', $pemberianVitamin->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Peserta</label>
                                        <input type="text" class="form-control" id="nama"
                                            value="{{ $pemberianVitamin->pendaftaran->nama ?? '-' }}" disabled>
                                    </div>

                                    <div class="mb-3">
                                        <label for="id_vitamin" class="form-label">Nama Vitamin</label>
                                        <select class="form-control" name="id_vitamin" id="id_vitamin" required>
                                            <option value="">-- Pilih Vitamin --</option>
                                            @foreach ($vitamins as $vitamin)
                                                <option value="{{ $vitamin->id }}"
                                                    {{ $vitamin->id == $pemberianVitamin->id_vitamin ? 'selected' : '' }}>
                                                    {{ $vitamin->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="dosis" class="form-label">Jumlah/Dosis</label>
                                        <input type="text" name="dosis" id="dosis" class="form-control"
                                            value="{{ $pemberianVitamin->dosis }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <textarea name="keterangan" id="keterangan" class="form-control" rows="3">{{ $pemberianVitamin->keterangan }}</textarea>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('pemberian.vitamin.index') }}" class="btn btn-secondary me-2">Batal</a>
                                        <button type="submit" class="btn text-light" style="background-color: #FF69B4;">Simpan Perubahan</button>
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
