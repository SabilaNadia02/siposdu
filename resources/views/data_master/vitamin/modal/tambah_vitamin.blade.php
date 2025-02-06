<!-- Modal -->
<div class="modal fade" id="tambahVitaminModal" tabindex="-1" aria-labelledby="tambahVitaminLabel" aria-hidden="true">
    <div class="modal-dialog" style="position: absolute; right: 30%; top: 30%; transform: translateY(-50%);">
        <div class="modal-content" style="font-size: 14px; padding: 10px;">
            <div class="modal-body">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 class="modal-title fw-bold" id="tambahVitaminLabel" style="font-size: 18px;">Tambah Vitamin</h5>
                <p class="text-muted" style="font-size: 14px;">Masukkan data vitamin.</p>
                <form>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="nama" class="form-label">Nama Vitamin</label>
                            <input type="text" class="form-control form-control-sm" id="nama" placeholder="Masukkan Nama Vitamin">
                        </div>
                        <div class="col-md-12">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control form-control-sm" id="keterangan" rows="3" placeholder="Masukkan Keterangan"></textarea>
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
