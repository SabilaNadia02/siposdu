@extends('layouts.master')

@section('title', 'Edit Skrining PPOK')

@section('content')
    <main class="app-main" style="background-color: white">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0" style="color: #333333;">Edit Skrining PPOK</h3>
                        <p style="color: #777777;">Perbarui data skrining PPOK peserta Posyandu.</p>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end align-items-center">
                        <button type="submit" form="editSkriningForm" class="btn text-light me-2"
                            style="background-color: #FF8F00;">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('skrining.ppok.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="card shadow-sm" style="border-radius: 0px; border-top: 3px solid #FF8F00;">
                    <div class="card-body">
                        <form id="editSkriningForm" action="{{ route('skrining.ppok.update', $pencatatanSkrining->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="waktu_skrining" class="form-label">
                                        Waktu Skrining <span class="text-danger">*</span>
                                        <span class="text-muted small">(tanggal/bulan/tahun)</span>
                                    </label>
                                    <input type="date" class="form-control form-control-sm" id="waktu_skrining"
                                        name="waktu_skrining"
                                        value="{{ old('waktu_skrining', $pencatatanSkrining->waktu_skrining ? \Carbon\Carbon::parse($pencatatanSkrining->waktu_skrining)->format('Y-m-d') : '') }}"
                                        required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">
                                        Nama Peserta
                                    </label>
                                    <input type="text" class="form-control form-control-sm"
                                        value="{{ $pencatatanSkrining->pendaftaran->nama }}" readonly>
                                    <input type="hidden" name="no_pendaftaran"
                                        value="{{ $pencatatanSkrining->no_pendaftaran }}">
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-sm"
                                                value="{{ $pencatatanSkrining->pendaftaran->jenis_kelamin == 1 ? 'Laki-Laki' : 'Perempuan' }}"
                                                readonly>
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
                                        <label>Usia</label>
                                        <div class="input-group">
                                            @php
                                                // Pastikan ada data pendaftaran dan tanggal lahir
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

                                                        // Hitung usia dengan presisi
                                                        $age = $dob->diffInYears($screeningDate);

                                                        // Pastikan usia tidak negatif
                                                        $age = max(0, $age);
                                                    } catch (\Exception $e) {
                                                        \Log::error('Error menghitung usia: ' . $e->getMessage());
                                                        $age = 0;
                                                    }
                                                }

                                                // Jika usia masih 0, coba ambil dari jawaban sebelumnya
                                                if ($age === 0) {
                                                    foreach ($pencatatanSkrining->detailPencatatanSkrining as $detail) {
                                                        if ($detail->id_pertanyaan_skrining == 6) {
                                                            // ID pertanyaan usia
                                                            $age = $detail->hasil_skrining;
                                                            break;
                                                        }
                                                    }
                                                }
                                            @endphp
                                            <input type="number" class="form-control form-control-sm"
                                                value="{{ floor($age) }}" readonly>
                                            <span class="input-group-text">tahun</span>
                                        </div>
                                        <small class="text-muted">(Dihitung otomatis)</small>
                                        <input type="hidden" name="pertanyaan[6]" value="{{ $age }}">
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <h6 style="color: #FF8F00; border-bottom: 1px solid #FF8F00; padding-bottom: 5px;">
                                        Pertanyaan Skrining PPOK</h6>
                                </div>

                                @php
                                    $jawaban = [];
                                    foreach ($pencatatanSkrining->detailPencatatanSkrining as $detail) {
                                        $jawaban[$detail->id_pertanyaan_skrining] = $detail->hasil_skrining;
                                    }
                                @endphp

                                <!-- Question 3: Merokok -->
                                <div class="col-md-12">
                                    <label for="pertanyaan_7" class="form-label">
                                        Merokok? <small class="text-muted">(Skor: Tidak=0, <20 bungkus/tahun=0, 20-30=1,
                                                ≥30=2)</small>
                                    </label>
                                    <select class="form-select form-select-sm" id="pertanyaan_7" name="pertanyaan[7]"
                                        required>
                                        <option value="" disabled>Pilih Jawaban</option>
                                        <option value="1"
                                            {{ old('pertanyaan.7', $jawaban[7] ?? '') == 1 ? 'selected' : '' }}>Tidak
                                            merokok (0)</option>
                                        <option value="2"
                                            {{ old('pertanyaan.7', $jawaban[7] ?? '') == 2 ? 'selected' : '' }}>Ya, <20
                                                bungkus/tahun (0)</option>
                                        <option value="3"
                                            {{ old('pertanyaan.7', $jawaban[7] ?? '') == 3 ? 'selected' : '' }}>Ya, 20-30
                                            bungkus/tahun (1)</option>
                                        <option value="4"
                                            {{ old('pertanyaan.7', $jawaban[7] ?? '') == 4 ? 'selected' : '' }}>Ya, ≥30
                                            bungkus/tahun (2)</option>
                                    </select>
                                </div>

                                <!-- Question 4: Nafas pendek -->
                                <div class="col-md-12">
                                    <label for="pertanyaan_8" class="form-label">
                                        Pernah merasa nafas pendek ketika berjalan cepat? <small class="text-muted">(Skor:
                                            Ya=1, Tidak=0)</small>
                                    </label>
                                    <select class="form-select form-select-sm" id="pertanyaan_8" name="pertanyaan[8]"
                                        required>
                                        <option value="" disabled>Pilih Jawaban</option>
                                        <option value="1"
                                            {{ old('pertanyaan.8', $jawaban[8] ?? '') == 1 ? 'selected' : '' }}>Ya (1)
                                        </option>
                                        <option value="2"
                                            {{ old('pertanyaan.8', $jawaban[8] ?? '') == 2 ? 'selected' : '' }}>Tidak (0)
                                        </option>
                                    </select>
                                </div>

                                <!-- Question 5: Dahak dari paru -->
                                <div class="col-12">
                                    <label for="pertanyaan_9" class="form-label">
                                        Punya dahak dari paru saat tidak flu? <small class="text-muted">(Skor: Ya=1,
                                            Tidak=0)</small>
                                    </label>
                                    <select class="form-select form-select-sm" id="pertanyaan_9" name="pertanyaan[9]"
                                        required>
                                        <option value="" disabled>Pilih Jawaban</option>
                                        <option value="1"
                                            {{ old('pertanyaan.9', $jawaban[9] ?? '') == 1 ? 'selected' : '' }}>Ya (1)
                                        </option>
                                        <option value="2"
                                            {{ old('pertanyaan.9', $jawaban[9] ?? '') == 2 ? 'selected' : '' }}>Tidak (0)
                                        </option>
                                    </select>
                                </div>

                                <!-- Question 6: Batuk tanpa flu -->
                                <div class="col-12">
                                    <label for="pertanyaan_10" class="form-label">
                                        Biasanya batuk saat tidak flu? <small class="text-muted">(Skor: Ya=1,
                                            Tidak=0)</small>
                                    </label>
                                    <select class="form-select form-select-sm" id="pertanyaan_10" name="pertanyaan[10]"
                                        required>
                                        <option value="" disabled>Pilih Jawaban</option>
                                        <option value="1"
                                            {{ old('pertanyaan.10', $jawaban[10] ?? '') == 1 ? 'selected' : '' }}>Ya (1)
                                        </option>
                                        <option value="2"
                                            {{ old('pertanyaan.10', $jawaban[10] ?? '') == 2 ? 'selected' : '' }}>Tidak (0)
                                        </option>
                                    </select>
                                </div>

                                <!-- Question 7: Spirometri -->
                                <div class="col-12">
                                    <label for="pertanyaan_11" class="form-label">
                                        Pernah diminta melakukan spirometri? <small class="text-muted">(Skor: Ya=1,
                                            Tidak=0)</small>
                                    </label>
                                    <select class="form-select form-select-sm" id="pertanyaan_11" name="pertanyaan[11]"
                                        required>
                                        <option value="" disabled>Pilih Jawaban</option>
                                        <option value="1"
                                            {{ old('pertanyaan.11', $jawaban[11] ?? '') == 1 ? 'selected' : '' }}>Ya (1)
                                        </option>
                                        <option value="2"
                                            {{ old('pertanyaan.11', $jawaban[11] ?? '') == 2 ? 'selected' : '' }}>Tidak (0)
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection