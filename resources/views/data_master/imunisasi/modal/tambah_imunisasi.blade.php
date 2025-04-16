<!-- Modal -->
<div class="modal fade" id="tambahImunisasiModal" tabindex="-1" aria-labelledby="tambahImunisasiLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="font-size: 14px; padding: 10px;">
            <div class="modal-body">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 class="modal-title fw-bold" id="tambahImunisasiLabel" style="font-size: 18px;">Tambah Imunisasi</h5>
                <p class="text-muted" style="font-size: 14px;">Masukkan data imunisasi.</p>
                
                <!-- Form -->
                <form action="{{ route('data-master.imunisasi.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="nama" class="form-label">Nama Imunisasi <span
                                class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="nama" name="nama" placeholder="Masukkan Nama" required>
                        </div>
                        <div class="col-md-12">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control form-control-sm" id="keterangan" name="keterangan" rows="3" placeholder="Masukkan Keterangan"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="dari_umur" class="form-label">Dari Umur (bulan) <span
                                class="text-danger">*</span></label>
                            <input type="number" class="form-control form-control-sm" id="dari_umur" name="dari_umur" placeholder="0" min="0" required>
                        </div>
                        <div class="col-md-6">
                            <label for="sampai_umur" class="form-label">Sampai Umur (bulan) <span
                                class="text-danger">*</span></label>
                            <input type="number" class="form-control form-control-sm" id="sampai_umur" name="sampai_umur" placeholder="0" min="0" required>
                        </div>
                    </div>
                    <div class="mt-3 d-grid">
                        <button type="submit" class="btn btn-sm text-light" style="background-color: #FF69B4;">SIMPAN</button>
                    </div>
                </form>
                <!-- End Form -->
            </div>
        </div>
    </div>
</div>
