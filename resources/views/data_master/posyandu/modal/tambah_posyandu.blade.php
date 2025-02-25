<!-- Modal -->
<div class="modal fade" id="tambahPosyanduModal" tabindex="-1" aria-labelledby="tambahPosyanduLabel" aria-hidden="true">
    <div class="modal-dialog" style="position: absolute; right: 30%; top: 30%; transform: translateY(-50%);">
        <div class="modal-content" style="font-size: 14px; padding: 10px;">
            <div class="modal-body">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <h5 class="modal-title fw-bold" id="tambahPosyanduLabel" style="font-size: 18px;">Tambah Posyandu</h5>
                <p class="text-muted" style="font-size: 14px;">Masukkan data posyandu.</p>
                <form method="POST" action="{{ route('data-master.posyandu.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="nama" class="form-label">Nama Posyandu</label>
                            <input type="text" class="form-control form-control-sm" id="nama" name="nama"
                                placeholder="Masukkan Nama Posyandu">
                        </div>
                        <div class="col-md-12">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control form-control-sm" id="alamat" name="alamat" rows="3"
                                placeholder="Masukkan Alamat"></textarea>
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
