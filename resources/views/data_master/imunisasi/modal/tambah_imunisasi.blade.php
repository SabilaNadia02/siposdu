<!-- Modal -->
<div class="modal fade" id="tambahImunisasiModal" tabindex="-1" aria-labelledby="tambahImunisasiLabel" aria-hidden="true">
    <div class="modal-dialog" style="position: absolute; right: 25%; top: 35%; transform: translateY(-50%);">
        <div class="modal-content" style="font-size: 14px; padding: 10px;">
            <div class="modal-body">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 class="modal-title fw-bold" id="tambahImunisasiLabel" style="font-size: 18px;">Tambah Imunisasi</h5>
                <p class="text-muted" style="font-size: 14px;">Masukkan data imunisasi.</p>
                <form>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="nama" class="form-label">Nama Imunisasi</label>
                            <input type="text" class="form-control form-control-sm" id="nama" placeholder="Masukkan Nama">
                        </div>
                        <div class="col-md-12">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control form-control-sm" id="keterangan" rows="3" placeholder="Masukkan Keterangan"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="dariUmur" class="form-label">Dari Umur (bulan)</label>
                            <input type="number" class="form-control form-control-sm" id="dariUmur" placeholder="0">
                        </div>
                        <div class="col-md-6">
                            <label for="sampaiUmur" class="form-label">Sampai Umur (bulan)</label>
                            <input type="number" class="form-control form-control-sm" id="sampaiUmur" placeholder="0">
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
