<!-- Modal -->
<div class="modal fade" id="tambahSkringTBCModal" tabindex="-1" aria-labelledby="tambahSkringTBCModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="position: absolute; right: 25%; top: 45%; transform: translateY(-50%);">
        <div class="modal-content" style="font-size: 14px; padding: 10px;">
            <div class="modal-body">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 class="modal-title fw-bold" id="tambahSkringTBCModalLabel" style="font-size: 18px;">Tambah Skrining TBC</h5>
                <p class="text-muted" style="font-size: 14px;">Masukkan data skrining peserta Posyandu.</p>
                <form>
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="waktu_skrining" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Waktu Skrining <span
                                    style="font-size: 11px; font-weight: normal;">(tanggal/bulan/tahun)</span>
                            </label>
                            <input type="date" class="form-control form-control-sm" id="waktu_skrining">
                        </div>
                        <h6 style="margin-top: 20px; margin-bottom: 4px;">Pertanyaan Skrining TBC</h6>
                        <div class="col-12" style="margin-top: 8px;">
                            <label for="skrining1" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Batuk terus menerus?
                            </label>
                            <select class="form-select form-select-sm" id="skrining1">
                                <option selected disabled>Pilih Jawaban</option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="skrining2" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Demam lebih dari 2 minggu?
                            </label>
                            <select class="form-select form-select-sm" id="skrining2">
                                <option selected disabled>Pilih Jawaban</option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="skrining3" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Berat Badan (BB) naik atau turun dalam 2 bulan berturut-turut?
                            </label>
                            <select class="form-select form-select-sm" id="skrining3">
                                <option selected disabled>Pilih Jawaban</option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="skrining4" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Kontak erat dengan pasien TBC?
                            </label>
                            <select class="form-select form-select-sm" id="skrining4">
                                <option selected disabled>Pilih Jawaban</option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-3 d-grid">
                        <button type="submit" class="btn btn-sm text-light" style="background-color: #FF69B4;">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
