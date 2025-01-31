<!-- Modal Cari Peserta -->
<div class="modal fade" id="tambahRujukanModal" tabindex="-1" aria-labelledby="tambahRujukanLabel" aria-hidden="true">
    <div class="modal-dialog" style="position: absolute; right: 25%; top: 35%; transform: translateY(-50%);">
        <div class="modal-content" style="font-size: 14px; padding: 10px;">
            <div class="modal-body">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <h5 class="modal-title fw-bold" id="addDataModalLabel" style="font-size: 18px;">Tambah Rujukan</h5>
                <p class="text-muted" style="font-size: 14px;">Masukkan data rujukan peserta posyandu.</p>
                <form>
                    <div class="row g-3"> 
                        <div class="col-12">
                            <label for="waktu_rujukan" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Waktu Rujukan <span
                                    style="font-size: 11px; font-weight: normal;">(tanggal/bulan/tahun)</span>
                            </label>
                            <input type="date" class="form-control form-control-sm" id="waktu_rujukan">
                        </div>
                        <div class="col-12">
                            <label for="jenis_rujukan" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Jenis Rujukan
                            </label>
                            <select class="form-select form-select-sm" id="jenis_rujukan">
                                <option selected disabled>Pilih Rujukan</option>
                                <option value="pustu">Pustu</option>
                                <option value="puskesmas">Puskesmas</option>
                                <option value="rumah_sakit">Rumah Sakit</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="keterangan" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Keterangan <span style="font-size: 11px; font-weight: normal;">(opsional)</span>
                            </label>
                            <textarea class="form-control form-control-sm" id="keterangan" rows="2" placeholder="Masukkan Keterangan"></textarea>
                        </div>
                    </div>
                    <div class="mt-3 d-grid">
                        <button type="submit" class="btn btn-primary btn-sm">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
