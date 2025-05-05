@extends('layouts.master')

@section('title', 'Edit Skrining TBC')

@section('content')
    <main class="app-main" style="background-color: white">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0" style="color: #333333;">Edit Skrining TBC</h3>
                        <p style="color: #777777;">Perbarui data skrining TBC peserta Posyandu.</p>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end align-items-center">
                        <button type="submit" form="editSkriningForm" class="btn text-light me-2"
                            style="background-color: #d63384;">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('skrining.tbc.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="card shadow-sm" style="border-radius: 0px; border-top: 3px solid #d63384;">
                    <div class="card-body">
                        <form id="editSkriningForm" action="{{ route('skrining.tbc.update', $pencatatanSkrining->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Peserta <span
                                        class="text-danger">*</span></label>
                                    <input type="text" class="form-control"
                                        value="{{ $pencatatanSkrining->pendaftaran->nama }}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="waktu_skrining" class="form-label">Waktu Skrining <span
                                        class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="waktu_skrining"
                                        value="{{ old('waktu_skrining', $pencatatanSkrining->waktu_skrining) }}" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-3"
                                    style="border-bottom: 1px solid #eee; padding-bottom: 10px;">
                                    <h5 class="mb-0" style="color: #333333;">Pertanyaan Skrining TBC</h5>
                                </div>

                                <div class="question-container">
                                    <!-- Pertanyaan 1: Batuk terus menerus -->
                                    <div class="question-item mb-4">
                                        <label class="form-label fw-medium">Batuk terus menerus? <span
                                            class="text-danger">*</span></label>
                                        <div class="d-flex gap-4 mt-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="pertanyaan[1]"
                                                    id="pertanyaan_1_ya" value="1"
                                                    {{ $pencatatanSkrining->detailPencatatanSkrining->where('id_pertanyaan_skrining', 1)->first()->hasil_skrining == 1 ? 'checked' : '' }}
                                                    required>
                                                <label class="form-check-label" for="pertanyaan_1_ya">Ya</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="pertanyaan[1]"
                                                    id="pertanyaan_1_tidak" value="2"
                                                    {{ $pencatatanSkrining->detailPencatatanSkrining->where('id_pertanyaan_skrining', 1)->first()->hasil_skrining == 2 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="pertanyaan_1_tidak">Tidak</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pertanyaan 2: Demam lebih dari 2 minggu -->
                                    <div class="question-item mb-4">
                                        <label class="form-label fw-medium">Demam lebih dari 2 minggu? <span
                                            class="text-danger">*</span></label>
                                        <div class="d-flex gap-4 mt-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="pertanyaan[2]"
                                                    id="pertanyaan_2_ya" value="1"
                                                    {{ $pencatatanSkrining->detailPencatatanSkrining->where('id_pertanyaan_skrining', 2)->first()->hasil_skrining == 1 ? 'checked' : '' }}
                                                    required>
                                                <label class="form-check-label" for="pertanyaan_2_ya">Ya</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="pertanyaan[2]"
                                                    id="pertanyaan_2_tidak" value="2"
                                                    {{ $pencatatanSkrining->detailPencatatanSkrining->where('id_pertanyaan_skrining', 2)->first()->hasil_skrining == 2 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="pertanyaan_2_tidak">Tidak</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pertanyaan 3: Berat Badan naik/turun -->
                                    <div class="question-item mb-4">
                                        <label class="form-label fw-medium">Berat Badan (BB) naik atau turun dalam 2 bulan
                                            berturut-turut? <span
                                            class="text-danger">*</span></label>
                                        <div class="d-flex gap-4 mt-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="pertanyaan[3]"
                                                    id="pertanyaan_3_ya" value="1"
                                                    {{ $pencatatanSkrining->detailPencatatanSkrining->where('id_pertanyaan_skrining', 3)->first()->hasil_skrining == 1 ? 'checked' : '' }}
                                                    required>
                                                <label class="form-check-label" for="pertanyaan_3_ya">Ya</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="pertanyaan[3]"
                                                    id="pertanyaan_3_tidak" value="2"
                                                    {{ $pencatatanSkrining->detailPencatatanSkrining->where('id_pertanyaan_skrining', 3)->first()->hasil_skrining == 2 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="pertanyaan_3_tidak">Tidak</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pertanyaan 4: Kontak erat dengan pasien TBC -->
                                    <div class="question-item mb-4">
                                        <label class="form-label fw-medium">Kontak erat dengan pasien TBC? <span
                                            class="text-danger">*</span></label>
                                        <div class="d-flex gap-4 mt-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="pertanyaan[4]"
                                                    id="pertanyaan_4_ya" value="1"
                                                    {{ $pencatatanSkrining->detailPencatatanSkrining->where('id_pertanyaan_skrining', 4)->first()->hasil_skrining == 1 ? 'checked' : '' }}
                                                    required>
                                                <label class="form-check-label" for="pertanyaan_4_ya">Ya</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="pertanyaan[4]"
                                                    id="pertanyaan_4_tidak" value="2"
                                                    {{ $pencatatanSkrining->detailPencatatanSkrining->where('id_pertanyaan_skrining', 4)->first()->hasil_skrining == 2 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="pertanyaan_4_tidak">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('styles')
    <style>
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .form-label {
            font-weight: 500;
            color: #555;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border-radius: 0.25rem;
            border: 1px solid #ddd;
            padding: 0.5rem 0.75rem;
        }

        .form-control:focus {
            border-color: #d63384;
            box-shadow: 0 0 0 0.2rem rgba(255, 105, 180, 0.25);
        }

        .question-item {
            padding: 1rem;
            background-color: #f9f9f9;
            border-radius: 0.5rem;
        }

        .form-check-input {
            margin-top: 0.25rem;
        }

        .form-check-input:checked {
            background-color: #d63384;
            border-color: #d63384;
        }
    </style>
@endpush
