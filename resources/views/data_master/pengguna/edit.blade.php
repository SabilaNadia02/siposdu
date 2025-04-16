@extends('layouts.master')

@section('title', 'Edit Pengguna')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="mb-0" style="color: #333333;">Edit Data Pengguna</h3>
                        <p style="color: #777777;">Halaman ini digunakan untuk mengubah data pengguna posyandu.
                        </p>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="#" style="color: #FF69B4; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('data-master.pengguna.index') }}"
                                    style="color: #FF69B4; font-size: 16px;">Data Pengguna</a>
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
                            <div class="card-body" style="border-radius: 0px">
                                <form id="editPenggunaForm" action="{{ route('data-master.pengguna.update', $pengguna) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row g-3 mb-3" style="font-size: 14px;">
                                        <div class="col-md-12">
                                            <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" id="nama" name="nama" 
                                                   placeholder="Masukkan nama" value="{{ $pengguna->nama }}" required>
                                        </div>
                                    
                                        <div class="col-md-12">
                                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control form-control-sm" id="email" name="email" 
                                                   placeholder="Masukkan email" value="{{ $pengguna->email }}" required>
                                        </div>
                                    
                                        <div class="col-md-12">
                                            <label for="peran" class="form-label">Peran <span class="text-danger">*</span></label>
                                            <select class="form-select form-select-sm" id="peran" name="peran" required>
                                                <option value="">Pilih peran</option>
                                                <option value=1 {{ $pengguna->peran == 1 ? 'selected' : '' }}>Admin</option>
                                                <option value=2 {{ $pengguna->peran == 2 ? 'selected' : '' }}>Kader</option>
                                                <option value=3 {{ $pengguna->peran == 3 ? 'selected' : '' }}>Nakes (Bidan/Perawat)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('data-master.pengguna.index') }}"
                                            class="btn btn-secondary me-2">Batal</a>
                                        <button type="submit" class="btn text-light"
                                            style="background-color: #FF69B4;">Simpan Perubahan</button>
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
