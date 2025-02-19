<!-- Modal -->
<div class="modal fade" id="tambahPenggunaModal" tabindex="-1" aria-labelledby="tambahPenggunaLabel" aria-hidden="true">
    <div class="modal-dialog" style="position: absolute; right: 25%; top: 35%; transform: translateY(-50%);">
        <div class="modal-content" style="font-size: 14px; padding: 10px;">
            <div class="modal-body">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 class="modal-title fw-bold" id="tambahPenggunaLabel" style="font-size: 18px;">Tambah Pengguna</h5>
                <p class="text-muted" style="font-size: 14px;">Masukkan data pengguna.</p>
                <form>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control form-control-sm" id="nama" placeholder="Masukkan Nama">
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control form-control-sm" id="email" placeholder="Masukkan Email">
                        </div>
                        <div class="col-md-12">
                            <label for="peran" class="form-label">Peran</label>
                            <select class="form-select form-select-sm" id="peran">
                                <option value="">Pilih Peran</option>
                                <option value="Admin">Admin</option>
                                <option value="Kader">Kader</option>
                                <option value="Nakes">Nakes (Bidan/Perawat)</option>
                            </select>
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
