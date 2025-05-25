@extends('layouts.master')

@section('title', 'Edit Skrining PPOK')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="mb-0" style="color: #333333;">Edit Skrining PPOK</h3>
                        <p style="color: #777777;">Halaman ini digunakan untuk mengubah data skrining PPOK peserta Posyandu.
                        </p>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}" style="color: #FF8F00; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('skrining.ppok.index') }}" style="color: #FF8F00; font-size: 16px;">Data
                                    Skrining PPOK</a>
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
                        <div class="card" style="border-top: 3px solid #FF8F00; border-radius: 0px">
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

                                <form id="editSkriningForm"
                                    action="{{ route('skrining.ppok.update', $pencatatanSkrining->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label for="waktu_skrining" class="form-label">
                                                Waktu Skrining <span class="text-danger">*</span>
                                            </label>
                                            <input type="date" class="form-control" id="waktu_skrining"
                                                name="waktu_skrining"
                                                value="{{ old('waktu_skrining', $pencatatanSkrining->waktu_skrining ? \Carbon\Carbon::parse($pencatatanSkrining->waktu_skrining)->format('Y-m-d') : '') }}"
                                                required>
                                            <small class="text-muted">(tanggal/bulan/tahun)</small>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">
                                                Nama Peserta <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control"
                                                value="{{ $pencatatanSkrining->pendaftaran->nama }}" disabled>
                                            <input type="hidden" name="no_pendaftaran"
                                                value="{{ $pencatatanSkrining->no_pendaftaran }}">
                                        </div>
                                    </div>

                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Jenis Kelamin <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control"
                                                        value="{{ $pencatatanSkrining->pendaftaran->jenis_kelamin == 1 ? 'Laki-Laki' : 'Perempuan' }}"
                                                        disabled>
                                                    <span class="input-group-text">
                                                        <small>{{ $pencatatanSkrining->pendaftaran->jenis_kelamin == 1 ? '(Skor: 1)' : '(Skor: 0)' }}</small>
                                                    </span>
                                                </div>
                                                <input type="hidden" name="pertanyaan[5]"
                                                    value="{{ $pencatatanSkrining->pendaftaran->jenis_kelamin }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Usia <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    @php
                                                        $age = 0;
                                                        if (
                                                            $pencatatanSkrining->pendaftaran &&
                                                            $pencatatanSkrining->pendaftaran->tanggal_lahir
                                                        ) {
                                                            try {
                                                                $dob = \Carbon\Carbon::parse(
                                                                    $pencatatanSkrining->pendaftaran->tanggal_lahir,
                                                                );
                                                                $screeningDate = \Carbon\Carbon::parse(
                                                                    $pencatatanSkrining->waktu_skrining,
                                                                );
                                                                $age = $dob->diffInYears($screeningDate);
                                                                $age = max(0, $age);
                                                            } catch (\Exception $e) {
                                                                \Log::error(
                                                                    'Error menghitung usia: ' . $e->getMessage(),
                                                                );
                                                                $age = 0;
                                                            }
                                                        }

                                                        if ($age === 0) {
                                                            foreach (
                                                                $pencatatanSkrining->detailPencatatanSkrining
                                                                as $detail
                                                            ) {
                                                                if ($detail->id_pertanyaan_skrining == 6) {
                                                                    $age = $detail->hasil_skrining;
                                                                    break;
                                                                }
                                                            }
                                                        }
                                                    @endphp
                                                    <input type="number" class="form-control" value="{{ floor($age) }}"
                                                        disabled>
                                                    <span class="input-group-text">tahun</span>
                                                </div>
                                                <small class="text-muted">(Dihitung otomatis)</small>
                                                <input type="hidden" name="pertanyaan[6]" value="{{ $age }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="d-flex align-items-center mb-3"
                                            style="border-bottom: 1px solid #FF8F00; padding-bottom: 10px;">
                                            <h5 class="mb-0" style="color: #333333;">Pertanyaan Skrining PPOK</h5>
                                        </div>

                                        @php
                                            $jawaban = [];
                                            foreach ($pencatatanSkrining->detailPencatatanSkrining as $detail) {
                                                $jawaban[$detail->id_pertanyaan_skrining] = $detail->hasil_skrining;
                                            }
                                        @endphp

                                        <!-- Question 3: Merokok -->
                                        <div class="question-item mb-4">
                                            <label class="form-label fw-medium">
                                                Merokok? <span class="text-danger">*</span>
                                            </label>
                                            <small class="text-muted d-block mb-2">(Skor: Tidak=0, <20 bungkus/tahun=0,
                                                    20-30=1, ≥30=2)</small>
                                                    <select class="form-select" name="pertanyaan[7]" required>
                                                        <option value="" disabled>Pilih Jawaban</option>
                                                        <option value="1"
                                                            {{ old('pertanyaan.7', $jawaban[7] ?? '') == 1 ? 'selected' : '' }}>
                                                            Tidak merokok (0)</option>
                                                        <option value="2"
                                                            {{ old('pertanyaan.7', $jawaban[7] ?? '') == 2 ? 'selected' : '' }}>
                                                            Ya, <20 bungkus/tahun (0)</option>
                                                        <option value="3"
                                                            {{ old('pertanyaan.7', $jawaban[7] ?? '') == 3 ? 'selected' : '' }}>
                                                            Ya, 20-30 bungkus/tahun (1)</option>
                                                        <option value="4"
                                                            {{ old('pertanyaan.7', $jawaban[7] ?? '') == 4 ? 'selected' : '' }}>
                                                            Ya, ≥30 bungkus/tahun (2)</option>
                                                    </select>
                                        </div>

                                        <!-- Question 4: Nafas pendek -->
                                        <div class="question-item mb-4">
                                            <label class="form-label fw-medium">
                                                Pernah merasa nafas pendek ketika berjalan cepat? <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <small class="text-muted d-block mb-2">(Skor: Ya=1, Tidak=0)</small>
                                            <select class="form-select" name="pertanyaan[8]" required>
                                                <option value="" disabled>Pilih Jawaban</option>
                                                <option value="1"
                                                    {{ old('pertanyaan.8', $jawaban[8] ?? '') == 1 ? 'selected' : '' }}>Ya
                                                    (1)</option>
                                                <option value="2"
                                                    {{ old('pertanyaan.8', $jawaban[8] ?? '') == 2 ? 'selected' : '' }}>
                                                    Tidak (0)</option>
                                            </select>
                                        </div>

                                        <!-- Question 5: Dahak dari paru -->
                                        <div class="question-item mb-4">
                                            <label class="form-label fw-medium">
                                                Punya dahak dari paru saat tidak flu? <span class="text-danger">*</span>
                                            </label>
                                            <small class="text-muted d-block mb-2">(Skor: Ya=1, Tidak=0)</small>
                                            <select class="form-select" name="pertanyaan[9]" required>
                                                <option value="" disabled>Pilih Jawaban</option>
                                                <option value="1"
                                                    {{ old('pertanyaan.9', $jawaban[9] ?? '') == 1 ? 'selected' : '' }}>Ya
                                                    (1)</option>
                                                <option value="2"
                                                    {{ old('pertanyaan.9', $jawaban[9] ?? '') == 2 ? 'selected' : '' }}>
                                                    Tidak (0)</option>
                                            </select>
                                        </div>

                                        <!-- Question 6: Batuk tanpa flu -->
                                        <div class="question-item mb-4">
                                            <label class="form-label fw-medium">
                                                Biasanya batuk saat tidak flu? <span class="text-danger">*</span>
                                            </label>
                                            <small class="text-muted d-block mb-2">(Skor: Ya=1, Tidak=0)</small>
                                            <select class="form-select" name="pertanyaan[10]" required>
                                                <option value="" disabled>Pilih Jawaban</option>
                                                <option value="1"
                                                    {{ old('pertanyaan.10', $jawaban[10] ?? '') == 1 ? 'selected' : '' }}>
                                                    Ya (1)</option>
                                                <option value="2"
                                                    {{ old('pertanyaan.10', $jawaban[10] ?? '') == 2 ? 'selected' : '' }}>
                                                    Tidak (0)</option>
                                            </select>
                                        </div>

                                        <!-- Question 7: Spirometri -->
                                        <div class="question-item mb-4">
                                            <label class="form-label fw-medium">
                                                Pernah diminta melakukan spirometri? <span class="text-danger">*</span>
                                            </label>
                                            <small class="text-muted d-block mb-2">(Skor: Ya=1, Tidak=0)</small>
                                            <select class="form-select" name="pertanyaan[11]" required>
                                                <option value="" disabled>Pilih Jawaban</option>
                                                <option value="1"
                                                    {{ old('pertanyaan.11', $jawaban[11] ?? '') == 1 ? 'selected' : '' }}>
                                                    Ya (1)</option>
                                                <option value="2"
                                                    {{ old('pertanyaan.11', $jawaban[11] ?? '') == 2 ? 'selected' : '' }}>
                                                    Tidak (0)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('skrining.ppok.index') }}"
                                            class="btn btn-secondary me-2">Batal</a>
                                        <button type="submit" class="btn text-light" style="background-color: #FF8F00;">
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

        .form-control,
        .form-select {
            border-radius: 0.25rem;
            border: 1px solid #ddd;
            padding: 0.5rem 0.75rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #FF8F00;
            box-shadow: 0 0 0 0.2rem rgba(255, 143, 0, 0.25);
        }

        .question-item {
            padding: 1rem;
            background-color: #f9f9f9;
            border-radius: 0.5rem;
        }

        .input-group-text {
            background-color: #f8f9fa;
        }

        /* Validation Styles */
        .is-valid {
            border-color: #28a745 !important;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }

        .invalid-feedback {
            display: none;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875em;
            color: #dc3545;
        }

        .was-validated .form-control:invalid,
        .was-validated .form-select:invalid {
            border-color: #dc3545 !important;
        }

        .was-validated .form-control:invalid~.invalid-feedback,
        .was-validated .form-select:invalid~.invalid-feedback {
            display: block;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('editSkriningForm');

            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                    form.classList.add('was-validated');

                    // Scroll to first invalid field
                    const firstInvalid = form.querySelector(':invalid');
                    if (firstInvalid) {
                        firstInvalid.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        firstInvalid.focus();
                    }
                }
            }, false);

            // Add validation styling
            const inputs = form.querySelectorAll('input, select');
            inputs.forEach(input => {
                input.addEventListener('change', function() {
                    if (input.checkValidity()) {
                        input.classList.remove('is-invalid');
                        input.classList.add('is-valid');
                    } else {
                        input.classList.remove('is-valid');
                    }
                });
            });
        });
    </script>
@endpush
