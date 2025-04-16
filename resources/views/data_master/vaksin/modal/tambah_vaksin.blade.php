<!-- Modal -->
<div class="modal fade" id="tambahVaksinModal" tabindex="-1" aria-labelledby="tambahVaksinLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="font-size: 14px; padding: 10px;">
            <div class="modal-body">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <h5 class="modal-title fw-bold" id="tambahVaksinLabel" style="font-size: 18px;">Tambah Vaksin</h5>
                <p class="text-muted" style="font-size: 14px;">Masukkan data vaksin.</p>
                <form method="POST" action="{{ route('data-master.vaksin.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="nama" class="form-label">Nama Vaksin <span
                                class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="nama" name="nama"
                                placeholder="Masukkan Nama Vaksin">
                        </div>
                        <div class="col-md-12">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control form-control-sm" id="keterangan" name="keterangan" rows="3"
                                placeholder="Masukkan Keterangan"></textarea>
                        </div>
                    </div>
                    <div class="mt-3 d-grid">
                        <button type="submit" class="btn btn-sm text-light"
                            style="background-color: #FF69B4;">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
