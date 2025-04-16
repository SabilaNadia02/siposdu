<!-- Modal -->
<div class="modal fade" id="tambahSkriningModal" tabindex="-1" aria-labelledby="tambahSkriningModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="font-size: 14px; padding: 10px;">
            <div class="modal-body">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <h5 class="modal-title fw-bold" id="tambahSkriningModalLabel" style="font-size: 18px;">Tambah
                    Skrining Peserta Posyandu</h5>
                <p class="text-muted" style="font-size: 14px;">Masukkan data skrining posyandu posyandu.</p>
                <form action="{{ route('data-master.skrining.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <!-- Nama Skrining -->
                        <div class="col-md-12">
                            <label for="nama_skrining" class="form-label" style="font-size: 14px; margin-bottom: 2px;">Nama Skrining <span
                                class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="nama_skrining" name="nama_skrining" placeholder="Masukkan nama skrining" required>
                        </div>
                
                        <!-- Keterangan -->
                        <div class="col-12">
                            <label for="keterangan" class="form-label" style="font-size: 14px; margin-bottom: 2px;">Keterangan</label>
                            <textarea class="form-control form-control-sm" name="keterangan" rows="3" placeholder="Masukkan keterangan"></textarea>
                        </div>
                
                        <div class="mt-3 d-grid">
                            <button type="submit" class="btn btn-sm text-light" style="background-color: #FF69B4;">SIMPAN</button>
                        </div>
                    </div>
                </form>                
            </div>
        </div>
    </div>
</div>
