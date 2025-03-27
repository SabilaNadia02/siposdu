@extends('layouts.master')

@section('title', 'Edit Skrining')

@section('content')
    <main class="app-main" style="background-color: white">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0" style="color: #333333;">Edit Skrining Peserta Posyandu</h3>
                        <p style="color: #777777;">Perbarui data peserta posyandu.</p>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end align-items-center">
                        <button type="submit" form="editSkriningForm" class="btn text-light me-2"
                            style="background-color: #FF69B4;">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('data-master.skrining.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="card shadow-sm" style="border-radius: 0px; border-top: 3px solid #FF69B4;">
                    <div class="card-body">
                        <form id="editSkriningForm" action="{{ route('data-master.skrining.update', $dataskrining->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <table class="table">
                                <tr>
                                    <th>Nama Skrining</th>
                                    <td>
                                        <input type="text" class="form-control" name="nama_skrining"
                                            value="{{ old('nama_skrining', $dataskrining->nama_skrining) }}" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <td>
                                        <textarea class="form-control" name="keterangan" rows="3" required>{{ old('keterangan', $dataskrining->keterangan) }}</textarea>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
