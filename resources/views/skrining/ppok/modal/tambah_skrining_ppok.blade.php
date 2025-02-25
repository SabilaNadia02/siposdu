<!-- Modal -->
<div class="modal fade" id="tambahSkringPPOKModal" tabindex="-1" aria-labelledby="tambahSkringPPOKModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" style="position: absolute; right: 15%; top: 55%; transform: translateY(-50%);">
        <div class="modal-content" style="font-size: 16px; padding: 20px;">
            <div class="modal-body">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 class="modal-title fw-bold" id="tambahSkringPPOKModalLabel" style="font-size: 18px;">Tambah Skrining PPOK</h5>
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
                        <h6 style="margin-top: 20px; margin-bottom: 2px;">Pertanyaan Skrining PPOK</h6>
                        <div class="col-md-4" style="margin-top: 8px;">
                            <label for="skrining1" class="form-label" style="font-size: 14px; margin-bottom: 2px;">Jenis Kelamin</label>
                            <select class="form-select" id="skrining1" style="font-size: 14px;">
                                <option selected disabled>Pilih Jawaban</option>
                                <option value="1">Perempuan</option>
                                <option value="2">Laki-Laki</option>
                            </select>
                        </div>
                        <div class="col-md-4" style="margin-top: 8px;">
                            <label for="skrining2" class="form-label" style="font-size: 14px; margin-bottom: 2px;">Usia</label>
                            <input type="number" class="form-control form-control-sm" id="skrining2" style="font-size: 14px;" placeholder="0">
                        </div>
                        <div class="col-md-4" style="margin-top: 8px;">
                            <label for="skrining3" class="form-label" style="font-size: 14px; margin-bottom: 2px;">Merokok?</label>
                            <select class="form-select" id="skrining3" style="font-size: 14px;">
                                <option selected disabled>Pilih Jawaban</option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="skrining4" class="form-label" style="font-size: 14px; margin-bottom: 2px;">Apakah pernah merasa nafas pendek ketika berjalan lebih cepat pada jalan yang datar atau jalan yang sedikit menanjak?</label>
                            <select class="form-select" id="skrining4" style="font-size: 14px;">
                                <option selected disabled>Pilih Jawaban</option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="skrining5" class="form-label" style="font-size: 14px; margin-bottom: 2px;">Apakah mempunyai dahak yang berasal dari paru atau kesulitan mengeluarkan dahak pada saat sedang tidak menderita flu?</label>
                            <select class="form-select" id="skrining5" style="font-size: 14px;">
                                <option selected disabled>Pilih Jawaban</option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="skrining6" class="form-label" style="font-size: 14px; margin-bottom: 2px;">Apakah biasanya batuk pada saat sedang tidak menderita flu?</label>
                            <select class="form-select" id="skrining6" style="font-size: 14px;">
                                <option selected disabled>Pilih Jawaban</option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="skrining7" class="form-label" style="font-size: 14px; margin-bottom: 2px;">Apakah Dokter atau Tenaga Kesehatan lainnya pernah meminta untuk melakukan pemeriksaan spirometri/peakflow meter (meniup ke dalam suatu alat)?</label>
                            <select class="form-select" id="skrining7" style="font-size: 14px;">
                                <option selected disabled>Pilih Jawaban</option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4 d-grid">
                        <button type="submit" class="btn btn-sm text-light" style="background-color: #FF8F00;">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
