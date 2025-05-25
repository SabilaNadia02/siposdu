<!-- Modal -->
<div class="modal fade" id="tambahSkringTBCModal" tabindex="-1" aria-labelledby="tambahSkringTBCModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="font-size: 14px; padding: 10px;">
            <div class="modal-body">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <h5 class="modal-title fw-bold" id="tambahSkringTBCModalLabel" style="font-size: 18px;">Tambah Skrining
                    TBC</h5>
                <p class="text-muted" style="font-size: 14px;">Masukkan data skrining peserta Posyandu.</p>
                <form id="skriningForm" action="{{ route('skrining.tbc.store') }}" method="POST" novalidate>
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="waktu_skrining" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Waktu Skrining <span class="text-danger">*</span>
                            </label>
                            <input type="date" class="form-control form-control-sm" id="waktu_skrining"
                                name="waktu_skrining" required>
                            <div class="invalid-feedback">Waktu skrining harus diisi</div>
                        </div>

                        <!-- Peserta -->
                        <div class="col-md-12">
                            <label for="no_pendaftaran" class="form-label">Nama Peserta Posyandu <span
                                    class="text-danger">*</span></label>
                            <select class="form-select form-select-sm" id="no_pendaftaran" name="no_pendaftaran"
                                required>
                                <option value="" hidden>Pilih Nama</option>
                                @foreach ($pendaftarans as $pendaftaran)
                                    <option value="{{ $pendaftaran->id }}">{{ $pendaftaran->nama }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Silakan pilih nama peserta</div>
                        </div>

                        <!-- Pertanyaan -->
                        <h6 style="margin-top: 20px; margin-bottom: 4px;">Pertanyaan Skrining TBC</h6>

                        <div class="col-12" style="margin-top: 8px;">
                            <label for="skrining1" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Batuk terus menerus? <span class="text-danger">*</span>
                            </label>
                            <select class="form-select form-select-sm" id="skrining1" name="pertanyaan[1]" required>
                                <option value="" selected disabled>Pilih Jawaban</option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                            <div class="invalid-feedback">Pertanyaan ini harus dijawab</div>
                        </div>
                        <div class="col-12">
                            <label for="skrining2" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Demam lebih dari 2 minggu? <span class="text-danger">*</span>
                            </label>
                            <select class="form-select form-select-sm" id="skrining2" name="pertanyaan[2]" required>
                                <option value="" selected disabled>Pilih Jawaban</option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                            <div class="invalid-feedback">Pertanyaan ini harus dijawab</div>
                        </div>
                        <div class="col-12">
                            <label for="skrining3" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Berat Badan (BB) naik atau turun dalam 2 bulan berturut-turut? <span
                                    class="text-danger">*</span>
                            </label>
                            <select class="form-select form-select-sm" id="skrining3" name="pertanyaan[3]" required>
                                <option value="" selected disabled>Pilih Jawaban</option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                            <div class="invalid-feedback">Pertanyaan ini harus dijawab</div>
                        </div>
                        <div class="col-12">
                            <label for="skrining4" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Kontak erat dengan pasien TBC? <span class="text-danger">*</span>
                            </label>
                            <select class="form-select form-select-sm" id="skrining4" name="pertanyaan[4]" required>
                                <option value="" selected disabled>Pilih Jawaban</option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                            <div class="invalid-feedback">Pertanyaan ini harus dijawab</div>
                        </div>
                    </div>

                    <div class="mt-3 d-grid">
                        <button type="submit" class="btn btn-sm text-light"
                            style="background-color: #d63384;">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Set Today Script dan Form Validation -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set tanggal hari ini
        const inputTanggal = document.getElementById('waktu_skrining');
        const today = new Date().toISOString().split('T')[0];
        inputTanggal.value = today;

        // Form validation
        const form = document.getElementById('skriningForm');

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
                    firstInvalid.focus();
                }
            }
        }, false);

        // Menambahkan event listener untuk setiap input/select
        const inputs = form.querySelectorAll('input, select');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                if (input.checkValidity()) {
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid');
                } else {
                    input.classList.remove('is-valid');
                }
            });

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

<style>
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
