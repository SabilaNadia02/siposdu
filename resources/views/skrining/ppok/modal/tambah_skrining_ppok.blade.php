<!-- Modal -->
<div class="modal fade" id="tambahSkringPPOKModal" tabindex="-1" aria-labelledby="tambahSkringPPOKModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content" style="font-size: 16px;">
            <div class="modal-header" style="border-bottom: 1px solid #FF8F00; padding: 15px 20px;">
                <h5 class="modal-title fw-bold" id="tambahSkringPPOKModalLabel" style="font-size: 18px; color: #333;">
                    Tambah Skrining PPOK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 20px;">
                <p class="text-muted mb-3" style="font-size: 14px;">Masukkan data skrining peserta Posyandu sesuai
                    kriteria berikut:</p>

                <div class="alert alert-info mb-4" style="background-color: #FFF3E0; border-color: #FF8F00;">
                    <strong>Kriteria Skor:</strong>
                    <ul class="mb-0" style="font-size: 13px;">
                        <li>Skor ≥6: Kemungkinan PPOK</li>
                        <li>Skor <6: Tidak PPOK</li>
                    </ul>
                </div>

                <form id="formSkriningPPOK" method="POST" action="{{ route('skrining.ppok.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="waktu_skrining" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Waktu Skrining <span class="text-danger">*</span>
                                <span style="font-size: 11px; font-weight: normal;">(tanggal/bulan/tahun) </span>
                            </label>
                            <input type="date" class="form-control form-control-sm" id="waktu_skrining"
                                name="waktu_skrining" required>
                        </div>
                        <div class="col-md-6">
                            <label for="no_pendaftaran" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Nama Peserta <span class="text-danger">*</span>
                            </label>
                            <select class="form-select form-select-sm" id="no_pendaftaran" name="no_pendaftaran"
                                required>
                                <option value="" selected disabled>Pilih Peserta</option>
                                @foreach ($pendaftarans as $pendaftaran)
                                    <option value="{{ $pendaftaran->id }}"
                                        data-tanggal-lahir="{{ $pendaftaran->tanggal_lahir }}"
                                        data-jenis-kelamin="{{ $pendaftaran->jenis_kelamin }}">
                                        {{ $pendaftaran->nama }}
                                        ({{ $pendaftaran->jenis_kelamin == 1 ? 'Laki-Laki' : 'Perempuan' }},
                                        {{ $pendaftaran->tanggal_lahir ? \Carbon\Carbon::parse($pendaftaran->tanggal_lahir)->format('d/m/Y') : 'TTL tidak ada' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="font-size: 14px;">Jenis Kelamin <span
                                    class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm"
                                        id="display_jenis_kelamin" readonly>
                                    <span class="input-group-text">
                                        <small id="skor_jenis_kelamin_text">(Skor: 0)</small>
                                    </span>
                                </div>
                                <input type="hidden" id="pertanyaan_5" name="pertanyaan[5]">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="font-size: 14px;">Usia <span
                                    class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" class="form-control form-control-sm" id="usia" readonly>
                                    <span class="input-group-text">tahun</span>
                                </div>
                                <small class="text-muted">(Dihitung otomatis)</small>
                                <input type="hidden" id="pertanyaan_6" name="pertanyaan[6]">
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <h6
                                style="color: #FF8F00; font-size: 15px; border-bottom: 1px solid #FF8F00; padding-bottom: 5px;">
                                Pertanyaan Skrining PPOK</h6>
                        </div>

                        <!-- Question 3: Merokok -->
                        <div class="col-md-12">
                            <label for="pertanyaan_7" class="form-label" style="font-size: 14px;">
                                Merokok? <small class="text-muted">(Skor: Tidak=0, <20 bungkus/tahun=0, 20-30=1,
                                        ≥30=2)</small><span
                                        class="text-danger">*</span>
                            </label>
                            <select class="form-select form-select-sm" id="pertanyaan_7" name="pertanyaan[7]" required>
                                <option value="" selected disabled>Pilih Jawaban</option>
                                <option value="1">Tidak merokok (0)</option>
                                <option value="2">Ya, <20 bungkus/tahun (0)</option>
                                <option value="3">Ya, 20-30 bungkus/tahun (1)</option>
                                <option value="4">Ya, ≥30 bungkus/tahun (2)</option>
                            </select>
                        </div>

                        <!-- Question 4: Nafas pendek -->
                        <div class="col-md-12">
                            <label for="pertanyaan_8" class="form-label" style="font-size: 14px;">
                                Pernah merasa nafas pendek ketika berjalan cepat? <small class="text-muted">(Skor:
                                    Ya=1, Tidak=0)</small><span
                                    class="text-danger">*</span>
                            </label>
                            <select class="form-select form-select-sm" id="pertanyaan_8" name="pertanyaan[8]" required>
                                <option value="" selected disabled>Pilih Jawaban</option>
                                <option value="1">Ya (1)</option>
                                <option value="2">Tidak (0)</option>
                            </select>
                        </div>

                        <!-- Question 5: Dahak dari paru -->
                        <div class="col-12">
                            <label for="pertanyaan_9" class="form-label" style="font-size: 14px;">
                                Punya dahak dari paru saat tidak flu? <small class="text-muted">(Skor: Ya=1,
                                    Tidak=0)</small><span
                                    class="text-danger">*</span>
                            </label>
                            <select class="form-select form-select-sm" id="pertanyaan_9" name="pertanyaan[9]"
                                required>
                                <option value="" selected disabled>Pilih Jawaban</option>
                                <option value="1">Ya (1)</option>
                                <option value="2">Tidak (0)</option>
                            </select>
                        </div>

                        <!-- Question 6: Batuk tanpa flu -->
                        <div class="col-12">
                            <label for="pertanyaan_10" class="form-label" style="font-size: 14px;">
                                Biasanya batuk saat tidak flu? <small class="text-muted">(Skor: Ya=1, Tidak=0)</small><span
                                class="text-danger">*</span>
                            </label>
                            <select class="form-select form-select-sm" id="pertanyaan_10" name="pertanyaan[10]"
                                required>
                                <option value="" selected disabled>Pilih Jawaban</option>
                                <option value="1">Ya (1)</option>
                                <option value="2">Tidak (0)</option>
                            </select>
                        </div>

                        <!-- Question 7: Spirometri -->
                        <div class="col-12">
                            <label for="pertanyaan_11" class="form-label" style="font-size: 14px;">
                                Pernah diminta melakukan spirometri? <small class="text-muted">(Skor: Ya=1,
                                    Tidak=0)</small><span
                                    class="text-danger">*</span>
                            </label>
                            <select class="form-select form-select-sm" id="pertanyaan_11" name="pertanyaan[11]"
                                required>
                                <option value="" selected disabled>Pilih Jawaban</option>
                                <option value="1">Ya (1)</option>
                                <option value="2">Tidak (0)</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-3 d-grid">
                        <button type="submit" class="btn btn-sm text-light"
                            style="background-color: #FF8F00;">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pendaftaranSelect = document.getElementById('no_pendaftaran');
        const usiaInput = document.getElementById('usia');
        const skorUsiaInput = document.getElementById('skor_usia');
        const pertanyaan6Input = document.getElementById('pertanyaan_6');
        const waktuSkriningInput = document.getElementById('waktu_skrining');
        const displayJenisKelamin = document.getElementById('display_jenis_kelamin');
        const skorJenisKelaminText = document.getElementById('skor_jenis_kelamin_text');
        const pertanyaan5Input = document.getElementById('pertanyaan_5');

        // Set default tanggal skrining ke hari ini
        const today = new Date().toISOString().split('T')[0];
        waktuSkriningInput.value = today;

        pendaftaranSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const tanggalLahir = selectedOption.getAttribute('data-tanggal-lahir');
            const jenisKelamin = selectedOption.getAttribute('data-jenis-kelamin');

            // Update jenis kelamin
            updateJenisKelamin(jenisKelamin);

            if (tanggalLahir) {
                // Hitung usia berdasarkan tanggal lahir dan tanggal skrining
                hitungUsia(tanggalLahir, waktuSkriningInput.value);
            } else {
                usiaInput.value = '';
                skorUsiaInput.value = '';
                pertanyaan6Input.value = '';
            }
        });

        waktuSkriningInput.addEventListener('change', function() {
            const selectedOption = pendaftaranSelect.options[pendaftaranSelect.selectedIndex];
            const tanggalLahir = selectedOption ? selectedOption.getAttribute('data-tanggal-lahir') :
                null;

            if (tanggalLahir) {
                hitungUsia(tanggalLahir, this.value);
            }
        });

        function updateJenisKelamin(jenisKelamin) {
            if (jenisKelamin == 1) { // Laki-Laki
                displayJenisKelamin.value = 'Laki-Laki';
                skorJenisKelaminText.textContent = '(Skor: 1)';
                pertanyaan5Input.value = '1'; // Nilai untuk Laki-Laki
            } else if (jenisKelamin == 2) { // Perempuan
                displayJenisKelamin.value = 'Perempuan';
                skorJenisKelaminText.textContent = '(Skor: 0)';
                pertanyaan5Input.value = '2'; // Nilai untuk perempuan
            } else {
                displayJenisKelamin.value = 'Tidak diketahui';
                skorJenisKelaminText.textContent = '(Skor: 0)';
                pertanyaan5Input.value = '';
            }
        }

        function hitungUsia(tanggalLahir, tanggalSkrining) {
            if (!tanggalLahir || !tanggalSkrining) return;

            const dob = new Date(tanggalLahir);
            const skriningDate = new Date(tanggalSkrining);

            // Hitung selisih tahun
            let usia = skriningDate.getFullYear() - dob.getFullYear();

            // Koreksi jika belum ulang tahun tahun ini
            const monthDiff = skriningDate.getMonth() - dob.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && skriningDate.getDate() < dob.getDate())) {
                usia--;
            }

            // Set nilai usia
            usiaInput.value = usia;
            pertanyaan6Input.value = usia; // Simpan usia untuk dikirim ke server

            // Hitung skor usia
            let skorUsia = 0;
            if (usia >= 60) {
                skorUsia = 2;
            } else if (usia >= 50) {
                skorUsia = 1;
            }

            skorUsiaInput.value = skorUsia;
        }

        // Pastikan form tidak submit jika data tidak lengkap
        document.getElementById('formSkriningPPOK').addEventListener('submit', function(e) {
            if (!pertanyaan5Input.value || !pertanyaan6Input.value) {
                e.preventDefault();
                alert('Mohon lengkapi data peserta terlebih dahulu');
                return false;
            }
            return true;
        });

        function updateJenisKelamin(jenisKelamin) {
            if (jenisKelamin == 1) { // Laki-Laki
                displayJenisKelamin.value = 'Laki-Laki';
                skorJenisKelaminText.textContent = '(Skor: 1)';
                pertanyaan5Input.value = '1'; // Sesuai enum
            } else if (jenisKelamin == 2) { // Perempuan
                displayJenisKelamin.value = 'Perempuan';
                skorJenisKelaminText.textContent = '(Skor: 0)';
                pertanyaan5Input.value = '2'; // Sesuai enum
            }
        }
    });
</script>
