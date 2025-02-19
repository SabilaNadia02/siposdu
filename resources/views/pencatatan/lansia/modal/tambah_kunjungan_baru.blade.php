<!-- Modal -->
<div class="modal fade" id="tambahKunjunganBaruModal" tabindex="-1" aria-labelledby="tambahKunjunganBaruModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" style="position: absolute; right: 25%; top: 45%; transform: translateY(-50%);">
        <div class="modal-content" style="font-size: 14px; padding: 10px;">
            <div class="modal-body">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <h5 class="modal-title fw-bold" id="tambahKunjunganBaruModalLabel" style="font-size: 18px;">Tambah
                    Pencatatan Kunjungan Balita</h5>
                <p class="text-muted" style="font-size: 14px;">Masukkan data peserta posyandu.</p>
                <form>
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="waktuKunjungan" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Waktu ke Posyandu <span
                                    style="font-size: 11px; font-weight: normal;">(tanggal/bulan/tahun)</span>
                            </label>
                            <input type="date" class="form-control form-control-sm" id="waktuKunjungan">
                        </div>

                        <h6 style="margin-top: 20px; margin-bottom: 4px;">Hasil Penimbangan/Pengukuran/Pemeriksaan</h6>
                        <div class="col-4" style="margin-top: 8px;">
                            <label for="beratBadan" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Berat Badan (Kg)
                            </label>
                            <input type="number" class="form-control form-control-sm" id="beratBadan" name="beratBadan"
                                placeholder="0" min="0" step="0.1">
                        </div>
                        <div class="col-4" style="margin-top: 8px;">
                            <label for="tinggiBadan" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Tinggi Badan (cm)
                            </label>
                            <input type="number" class="form-control form-control-sm" id="tinggiBadan"
                                name="tinggiBadan" placeholder="0" min="0" step="0.1">
                        </div>
                        <div class="col-4" style="margin-top: 8px;">
                            <label for="lingkarPerut" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Lingkar Perut (cm)
                            </label>
                            <input type="number" class="form-control form-control-sm" id="lingkarPerut"
                                name="lingkarPerut" placeholder="0" min="0" step="0.1">
                        </div>
                        <div class="col-6" style="margin-top: 8px;">
                            <label for="gulaDarah" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Gula Darah (mg/dL)
                            </label>
                            <input type="number" class="form-control form-control-sm" id="gulaDarah" name="gulaDarah"
                                placeholder="0" min="0" step="0.1">
                        </div>
                        <div class="col-6" style="margin-top: 8px;">
                            <label for="kolesterol" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Kolesterol (mg/dL)
                            </label>
                            <input type="number" class="form-control form-control-sm" id="kolesterol" name="kolesterol"
                                placeholder="0" min="0" step="0.1">
                        </div>
                        <div class="col-6" style="margin-top: 8px;">
                            <label for="lingkarLenganAtas" class="form-label"
                                style="font-size: 14px; margin-bottom: 2px;">
                                Tekanan Darah (Sistolik)
                            </label>
                            <input type="number" class="form-control form-control-sm" id="lingkarLenganAtas"
                                name="lingkarLenganAtas" placeholder="0" min="0" step="0.1">
                        </div>
                        <div class="col-6" style="margin-top: 8px;">
                            <label for="lingkarLenganAtas" class="form-label"
                                style="font-size: 14px; margin-bottom: 2px;">
                                Tekanan Darah (Diastolik)
                            </label>
                            <input type="number" class="form-control form-control-sm" id="lingkarLenganAtas"
                                name="lingkarLenganAtas" placeholder="0" min="0" step="0.1">
                        </div>
                        <div class="col-6" style="margin-top: 8px;">
                            <label for="asi_eksklusif" class="form-label"
                                style="font-size: 14px; margin-bottom: 2px;">
                                Tes Hitung Jari (Mata Kanan)
                            </label>
                            <select class="form-select form-select-sm" id="asi_eksklusif">
                                <option selected disabled>Pilih Jawaban</option>
                                <option value="1">Normal</option>
                                <option value="2">Tidak Normal</option>
                            </select>
                        </div>
                        <div class="col-6" style="margin-top: 8px;">
                            <label for="mp_asi" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Tes Hitung Jari (Mata Kiri)
                            </label>
                            <select class="form-select form-select-sm" id="mp_asi">
                                <option selected disabled>Pilih Jawaban</option>
                                <option value="1">Normal</option>
                                <option value="2">Tidak Normal</option>
                            </select>
                        </div>
                        <div class="col-6" style="margin-top: 8px;">
                            <label for="asi_eksklusif" class="form-label"
                                style="font-size: 14px; margin-bottom: 2px;">
                                Tes Berbisik (Telinga Kanan)
                            </label>
                            <select class="form-select form-select-sm" id="asi_eksklusif">
                                <option selected disabled>Pilih Jawaban</option>
                                <option value="1">Normal</option>
                                <option value="2">Tidak Normal</option>
                            </select>
                        </div>
                        <div class="col-6" style="margin-top: 8px;">
                            <label for="mp_asi" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Tes Berbisik (Telinga Kiri)
                            </label>
                            <select class="form-select form-select-sm" id="mp_asi">
                                <option selected disabled>Pilih Jawaban</option>
                                <option value="1">Normal</option>
                                <option value="2">Tidak Normal</option>
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
