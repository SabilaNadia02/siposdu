<!-- Modal -->
<div class="modal fade" id="tambahKunjunganBaruModal" tabindex="-1" aria-labelledby="tambahKunjunganBaruModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="font-size: 14px; padding: 10px;">
            <div class="modal-body">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <h5 class="modal-title fw-bold" id="tambahKunjunganBaruModalLabel" style="font-size: 18px;">Tambah
                    Pencatatan Kunjungan Usia Subur/Lansia</h5>
                <p class="text-muted" style="font-size: 14px;">Masukkan data peserta posyandu.</p>
                <form
                    action="{{ route('pencatatan.lansia.kunjungan.store', ['id_pencatatan_awal' => $pencatatan_awal->id]) }}"
                    method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="waktu_pencatatan" class="form-label"
                                style="font-size: 14px; margin-bottom: 2px;">
                                Waktu ke Posyandu <span
                                    style="font-size: 11px; font-weight: normal;">(tanggal/bulan/tahun)</span>
                            </label>
                            <input type="date" class="form-control form-control-sm" id="waktu_pencatatan"
                                name="waktu_pencatatan">
                        </div>

                        <h6 style="margin-top: 20px; margin-bottom: 4px;">Hasil Penimbangan/Pengukuran/Pemeriksaan</h6>
                        <div class="col-4" style="margin-top: 8px;">
                            <label for="berat_badan" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Berat Badan (Kg)
                            </label>
                            <input type="number" class="form-control form-control-sm" id="berat_badan"
                                name="berat_badan" placeholder="0" step=any>
                        </div>
                        <div class="col-4" style="margin-top: 8px;">
                            <label for="tinggi_badan" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Tinggi Badan (cm)
                            </label>
                            <input type="number" class="form-control form-control-sm" id="tinggi_badan"
                                name="tinggi_badan" placeholder="0" min="0" step=any>
                        </div>
                        <div class="col-4" style="margin-top: 8px;">
                            <label for="lingkar_perut" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Lingkar Perut (cm)
                            </label>
                            <input type="number" class="form-control form-control-sm" id="lingkar_perut"
                                name="lingkar_perut" placeholder="0" min="0" step=any>
                        </div>
                        <div class="col-6" style="margin-top: 8px;">
                            <label for="gula_darah" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Gula Darah (mg/dL)
                            </label>
                            <input type="number" class="form-control form-control-sm" id="gula_darah" name="gula_darah"
                                placeholder="0" min="0" step=any>
                        </div>
                        <div class="col-6" style="margin-top: 8px;">
                            <label for="kolestrol" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Kolesterol (mg/dL)
                            </label>
                            <input type="number" class="form-control form-control-sm" id="kolestrol" name="kolestrol"
                                placeholder="0" min="0" step=any>
                        </div>
                        <div class="col-6" style="margin-top: 8px;">
                            <label for="tekanan_darah_sistolik" class="form-label"
                                style="font-size: 14px; margin-bottom: 2px;">
                                Tekanan Darah (Sistolik)
                            </label>
                            <input type="number" class="form-control form-control-sm" id="tekanan_darah_sistolik"
                                name="tekanan_darah_sistolik" placeholder="0" step=any>
                        </div>
                        <div class="col-6" style="margin-top: 8px;">
                            <label for="tekanan_darah_diastolik" class="form-label"
                                style="font-size: 14px; margin-bottom: 2px;">
                                Tekanan Darah (Diastolik)
                            </label>
                            <input type="number" class="form-control form-control-sm" id="tekanan_darah_diastolik"
                                name="tekanan_darah_diastolik" placeholder="0" step=any>
                        </div>
                        <div class="col-6" style="margin-top: 8px;">
                            <label for="tes_mata_kanan" class="form-label"
                                style="font-size: 14px; margin-bottom: 2px;">
                                Tes Hitung Jari (Mata Kanan)
                            </label>
                            <select class="form-select form-select-sm" id="tes_mata_kanan" name="tes_mata_kanan">
                                <option selected disabled>Pilih Jawaban</option>
                                <option value="1">Normal (N)</option>
                                <option value="2">Tidak Normal (TN)</option>
                            </select>
                        </div>
                        <div class="col-6" style="margin-top: 8px;">
                            <label for="tes_mata_kiri" class="form-label"
                                style="font-size: 14px; margin-bottom: 2px;">
                                Tes Hitung Jari (Mata Kiri)
                            </label>
                            <select class="form-select form-select-sm" id="tes_mata_kiri" name="tes_mata_kiri">
                                <option selected disabled>Pilih Jawaban</option>
                                <option value="1">Normal (N)</option>
                                <option value="2">Tidak Normal (TN)</option>
                            </select>
                        </div>
                        <div class="col-6" style="margin-top: 8px;">
                            <label for="tes_telinga_kanan" class="form-label"
                                style="font-size: 14px; margin-bottom: 2px;">
                                Tes Berbisik (Telinga Kanan)
                            </label>
                            <select class="form-select form-select-sm" id="tes_telinga_kanan" name="tes_telinga_kanan">
                                <option selected disabled>Pilih Jawaban</option>
                                <option value="1">Normal (N)</option>
                                <option value="2">Tidak Normal (TN)</option>
                            </select>
                        </div>
                        <div class="col-6" style="margin-top: 8px;">
                            <label for="tes_telinga_kiri" class="form-label"
                                style="font-size: 14px; margin-bottom: 2px;">
                                Tes Berbisik (Telinga Kiri)
                            </label>
                            <select class="form-select form-select-sm" id="tes_telinga_kiri" name="tes_telinga_kiri">
                                <option selected disabled>Pilih Jawaban</option>
                                <option value="1">Normal (N)</option>
                                <option value="2">Tidak Normal (TN)</option>
                            </select>
                        </div>
                        <div class="col-12" style="margin-top: 8px;">
                            <label for="keluhan" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Keluhan
                            </label>
                            <textarea class="form-control" name="keluhan" maxlength="255">{{ old('keluhan') }}</textarea>
                        </div>
                        <div class="col-12" style="margin-top: 8px;">
                            <label for="edukasi" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Edukasi
                            </label>
                            <textarea class="form-control" name="edukasi" maxlength="255">{{ old('edukasi') }}</textarea>
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
    document.addEventListener("DOMContentLoaded", function() {
        let today = new Date().toISOString().split('T')[0];
        document.getElementById("waktu_pencatatan").value = today;
    });
</script>
