<!-- Modal -->
<div class="modal fade" id="tambahKunjunganBaruModal" tabindex="-1" aria-labelledby="tambahKunjunganBaruModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="position: absolute; right: 25%; top: 40%; transform: translateY(-50%);">
        <div class="modal-content" style="font-size: 14px; padding: 10px;">
            <div class="modal-body">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 class="modal-title fw-bold" id="tambahKunjunganBaruModalLabel" style="font-size: 18px;">Tambah Pencatatan Kunjungan Balita</h5>
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
                        <div class="col-6" style="margin-top: 8px;">
                            <label for="beratBadan" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Berat Badan (Kg)
                            </label>
                            <input type="number" class="form-control form-control-sm" id="beratBadan" name="beratBadan" placeholder="0" min="0" step="0.1">
                        </div>                
                        <div class="col-6" style="margin-top: 8px;">
                            <label for="panjangBadan" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Panjang Badan (cm)
                            </label>
                            <input type="number" class="form-control form-control-sm" id="panjangBadan" name="panjangBadan" placeholder="0" min="0" step="0.1">
                        </div>                
                        <div class="col-6" style="margin-top: 8px;">
                            <label for="lingkarLenganAtas" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Lingkar Lengan Atas (cm)
                            </label>
                            <input type="number" class="form-control form-control-sm" id="lingkarLenganAtas" name="lingkarLenganAtas" placeholder="0" min="0" step="0.1">
                        </div>                
                        <div class="col-6" style="margin-top: 8px;">
                            <label for="lingkarKepala" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Lingkar Kepala (cm)
                            </label>
                            <input type="number" class="form-control form-control-sm" id="lingkarKepala" name="lingkarKepala" placeholder="0" min="0" step="0.1">
                        </div>

                        <h6 style="margin-top: 20px; margin-bottom: 4px;">Kegiatan dan Tindakan</h6>
                        <div class="col-6" style="margin-top: 8px;">
                            <label for="asi_eksklusif" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                ASI Eksklusif?
                            </label>
                            <select class="form-select form-select-sm" id="asi_eksklusif">
                                <option selected disabled>Pilih Jawaban</option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                        </div>
                        <div class="col-6" style="margin-top: 8px;">
                            <label for="mp_asi" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                MP ASI?
                            </label>
                            <select class="form-select form-select-sm" id="mp_asi">
                                <option selected disabled>Pilih Jawaban</option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                        </div>    
                    </div>
                    <div class="mt-3 d-grid">
                        <button type="submit" class="btn btn-success btn-sm">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
