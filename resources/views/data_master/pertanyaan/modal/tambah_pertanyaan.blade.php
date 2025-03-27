<!-- Modal -->
<div class="modal fade" id="tambahPertanyaanModal" tabindex="-1" aria-labelledby="tambahPertanyaanModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" style="position: absolute; right: 35%; top: 20%; transform: translateY(-50%);">
        <div class="modal-content" style="font-size: 14px; padding: 10px;">
            <div class="modal-body">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <h5 class="modal-title fw-bold" id="tambahPertanyaanModalLabel" style="font-size: 18px;">Tambah
                    Pertanyaan Skrining</h5>
                <p class="text-muted" style="font-size: 14px;">Masukkan data pertanyaan skrining posyandu.</p>
                <form action="{{ route('data-master.pertanyaan.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <!-- Pertanyaan -->
                        <div class="col-md-12">
                            <label for="nama_pertanyaan" class="form-label" style="font-size: 14px; margin-bottom: 2px;">Pertanyaan</label>
                            <textarea class="form-control form-control-sm" name="nama_pertanyaan" rows="5" placeholder="Masukkan Pertanyaan" required></textarea>
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
