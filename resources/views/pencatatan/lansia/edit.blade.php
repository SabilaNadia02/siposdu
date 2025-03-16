@extends('layouts.master')

@section('title', 'Edit Data Lansia')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0" style="color: #333333; font-size: 1.5rem;">Edit Data Lansia</h3>
                        <p style="color: #777777; font-size: 1rem;">Perbarui informasi data lansia.</p>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end align-items-center">
                        <a href="{{ route('pencatatan.lansia.show', $data->id) }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="card shadow-sm" style="border-radius: 0px; border-top: 3px solid #FF8F00;">
                    <div class="card-body">
                        <form action="{{ route('pencatatan.lansia.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">No Pendaftaran</label>
                                <input type="text" class="form-control"
                                    value="{{ str_pad($data->pendaftaran->id, 4, '0', STR_PAD_LEFT) }}" disabled>
                                <input type="hidden" name="no_pendaftaran" value="{{ $data->pendaftaran->id }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Lansia</label>
                                <input type="text" class="form-control" value="{{ $data->pendaftaran->nama }}" disabled>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Riwayat Keluarga</label>
                                <div class="row">
                                    @foreach (['Hipertensi', 'DM', 'Stroke', 'Jantung', 'Kanker', 'Kolesterol Tinggi'] as $value)
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="riwayat_keluarga_{{ $value }}"
                                                    name="riwayat_keluarga[]" value="{{ $value }}"
                                                    {{ in_array($value, json_decode($data->riwayat_keluarga) ?? []) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="riwayat_keluarga_{{ $value }}">{{ $value }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Riwayat Diri Sendiri</label>
                                <div class="row">
                                    @foreach (['Hipertensi', 'DM', 'Stroke', 'Jantung', 'Kanker', 'Kolesterol Tinggi'] as $value)
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="riwayat_diri_{{ $value }}"
                                                    name="riwayat_diri[]" value="{{ $value }}"
                                                    {{ in_array($value, json_decode($data->riwayat_diri_sendiri) ?? []) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="riwayat_diri_{{ $value }}">{{ $value }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Perilaku Berisiko</label>
                                <div class="row">
                                    @foreach (['Merokok', 'Konsumsi Tinggi Gula', 'Konsumsi Tinggi Garam', 'Konsumsi Tinggi Lemak'] as $value)
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="perilaku_berisiko_{{ $value }}"
                                                    name="perilaku_berisiko[]" value="{{ $value }}"
                                                    {{ in_array($value, json_decode($data->perilaku_berisiko) ?? []) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="perilaku_berisiko_{{ $value }}">{{ $value }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn me-2 text-light" style="background-color: #FF8F00;"><i class="fas fa-save"></i> Simpan
                                    Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection 