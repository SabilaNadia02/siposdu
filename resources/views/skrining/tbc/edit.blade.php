@extends('layouts.master')

@section('title', 'Edit Skrining TBC')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="mb-0" style="color: #333333;">Edit Skrining TBC</h3>
                        <p style="color: #777777;">Halaman ini digunakan untuk mengubah data skrining TBC peserta Posyandu.</p>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}" style="color: #d63384; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('skrining.tbc.index') }}" style="color: #d63384; font-size: 16px;">Data Skrining TBC</a>
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

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form id="editSkriningForm" action="{{ route('skrining.tbc.update', $pencatatanSkrining->id) }}" method="POST" novalidate>
                                    @csrf
                                    @method('PUT')

                                    <div class="row g-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Nama Peserta <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="{{ $pencatatanSkrining->pendaftaran->nama }}" disabled>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="waktu_skrining" class="form-label">Waktu Skrining <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="waktu_skrining" id="waktu_skrining" value="{{ old('waktu_skrining', $pencatatanSkrining->waktu_skrining) }}" required>
                                            <div class="invalid-feedback">Waktu skrining harus diisi</div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="d-flex align-items-center mb-3" style="border-bottom: 1px solid #eee; padding-bottom: 10px;">
                                            <h5 class="mb-0" style="color: #333333;">Pertanyaan Skrining TBC</h5>
                                        </div>

                                        <div class="question-container">
                                            <!-- Pertanyaan 1: Batuk terus menerus -->
                                            <div class="question-item mb-4">
                                                <label class="form-label fw-medium">Batuk terus menerus? <span class="text-danger">*</span></label>
                                                <div class="d-flex gap-4 mt-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="pertanyaan[1]" id="pertanyaan_1_ya" value="1"
                                                            {{ $pencatatanSkrining->detailPencatatanSkrining->where('id_pertanyaan_skrining', 1)->first()->hasil_skrining == 1 ? 'checked' : '' }} required>
                                                        <label class="form-check-label" for="pertanyaan_1_ya">Ya</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="pertanyaan[1]" id="pertanyaan_1_tidak" value="2"
                                                            {{ $pencatatanSkrining->detailPencatatanSkrining->where('id_pertanyaan_skrining', 1)->first()->hasil_skrining == 2 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="pertanyaan_1_tidak">Tidak</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">Pertanyaan ini harus dijawab</div>
                                            </div>

                                            <!-- Pertanyaan 2: Demam lebih dari 2 minggu -->
                                            <div class="question-item mb-4">
                                                <label class="form-label fw-medium">Demam lebih dari 2 minggu? <span class="text-danger">*</span></label>
                                                <div class="d-flex gap-4 mt-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="pertanyaan[2]" id="pertanyaan_2_ya" value="1"
                                                            {{ $pencatatanSkrining->detailPencatatanSkrining->where('id_pertanyaan_skrining', 2)->first()->hasil_skrining == 1 ? 'checked' : '' }} required>
                                                        <label class="form-check-label" for="pertanyaan_2_ya">Ya</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="pertanyaan[2]" id="pertanyaan_2_tidak" value="2"
                                                            {{ $pencatatanSkrining->detailPencatatanSkrining->where('id_pertanyaan_skrining', 2)->first()->hasil_skrining == 2 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="pertanyaan_2_tidak">Tidak</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">Pertanyaan ini harus dijawab</div>
                                            </div>

                                            <!-- Pertanyaan 3: Berat Badan naik/turun -->
                                            <div class="question-item mb-4">
                                                <label class="form-label fw-medium">Berat Badan (BB) naik atau turun dalam 2 bulan berturut-turut? <span class="text-danger">*</span></label>
                                                <div class="d-flex gap-4 mt-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="pertanyaan[3]" id="pertanyaan_3_ya" value="1"
                                                            {{ $pencatatanSkrining->detailPencatatanSkrining->where('id_pertanyaan_skrining', 3)->first()->hasil_skrining == 1 ? 'checked' : '' }} required>
                                                        <label class="form-check-label" for="pertanyaan_3_ya">Ya</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="pertanyaan[3]" id="pertanyaan_3_tidak" value="2"
                                                            {{ $pencatatanSkrining->detailPencatatanSkrining->where('id_pertanyaan_skrining', 3)->first()->hasil_skrining == 2 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="pertanyaan_3_tidak">Tidak</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">Pertanyaan ini harus dijawab</div>
                                            </div>

                                            <!-- Pertanyaan 4: Kontak erat dengan pasien TBC -->
                                            <div class="question-item mb-4">
                                                <label class="form-label fw-medium">Kontak erat dengan pasien TBC? <span class="text-danger">*</span></label>
                                                <div class="d-flex gap-4 mt-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="pertanyaan[4]" id="pertanyaan_4_ya" value="1"
                                                            {{ $pencatatanSkrining->detailPencatatanSkrining->where('id_pertanyaan_skrining', 4)->first()->hasil_skrining == 1 ? 'checked' : '' }} required>
                                                        <label class="form-check-label" for="pertanyaan_4_ya">Ya</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="pertanyaan[4]" id="pertanyaan_4_tidak" value="2"
                                                            {{ $pencatatanSkrining->detailPencatatanSkrining->where('id_pertanyaan_skrining', 4)->first()->hasil_skrining == 2 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="pertanyaan_4_tidak">Tidak</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">Pertanyaan ini harus dijawab</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('skrining.tbc.index') }}" class="btn btn-secondary me-2">Batal</a>
                                        <button type="submit" class="btn text-light" style="background-color: #d63384;">
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

        .form-control {
            border-radius: 0.25rem;
            border: 1px solid #ddd;
            padding: 0.5rem 0.75rem;
        }

        .form-control:focus {
            border-color: #d63384;
            box-shadow: 0 0 0 0.2rem rgba(214, 51, 132, 0.25);
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
        .was-validated .form-select:invalid,
        .was-validated .form-check-input:invalid {
            border-color: #dc3545 !important;
        }

        .was-validated .form-control:invalid~.invalid-feedback,
        .was-validated .form-select:invalid~.invalid-feedback,
        .was-validated .question-item:has(.form-check-input:invalid) .invalid-feedback {
            display: block;
        }

        .was-validated .question-item:has(.form-check-input:invalid) {
            border-left: 3px solid #dc3545;
            padding-left: calc(1rem - 3px);
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

                    // Menambahkan class 'was-validated' untuk menampilkan pesan error
                    form.classList.add('was-validated');

                    // Scroll ke field pertama yang error
                    const firstInvalid = form.querySelector(':invalid');
                    if (firstInvalid) {
                        firstInvalid.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });

                        // Untuk radio button, scroll ke parent question-item
                        if (firstInvalid.type === 'radio') {
                            firstInvalid.closest('.question-item').scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                        } else {
                            firstInvalid.focus();
                        }
                    }
                }
            }, false);

            // Menambahkan event listener untuk setiap input/radio
            const inputs = form.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    if (input.checkValidity()) {
                        if (input.type === 'radio') {
                            const questionItem = input.closest('.question-item');
                            questionItem.classList.remove('is-invalid');
                            questionItem.classList.add('is-valid');
                        } else {
                            input.classList.remove('is-invalid');
                            input.classList.add('is-valid');
                        }
                    } else {
                        if (input.type === 'radio') {
                            const questionItem = input.closest('.question-item');
                            questionItem.classList.remove('is-valid');
                        } else {
                            input.classList.remove('is-valid');
                        }
                    }
                });

                input.addEventListener('change', function() {
                    if (input.checkValidity()) {
                        if (input.type === 'radio') {
                            const questionItem = input.closest('.question-item');
                            questionItem.classList.remove('is-invalid');
                            questionItem.classList.add('is-valid');
                        } else {
                            input.classList.remove('is-invalid');
                            input.classList.add('is-valid');
                        }
                    } else {
                        if (input.type === 'radio') {
                            const questionItem = input.closest('.question-item');
                            questionItem.classList.remove('is-valid');
                        } else {
                            input.classList.remove('is-valid');
                        }
                    }
                });
            });
        });
    </script>
@endpush
