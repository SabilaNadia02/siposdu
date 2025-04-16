<!-- Modal -->
<div class="modal fade" id="tambahPenggunaModal" tabindex="-1" aria-labelledby="tambahPenggunaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="font-size: 14px; padding: 10px;">
            <div class="modal-body">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <h5 class="modal-title fw-bold" id="tambahPenggunaLabel" style="font-size: 18px;">Tambah Pengguna</h5>
                <p class="text-muted" style="font-size: 14px;">Masukkan data pengguna.</p>
                <form action="{{ route('data-master.pengguna.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="nama" name="nama"
                                placeholder="Masukkan nama">
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control form-control-sm" id="email" name="email"
                                placeholder="Masukkan email">
                        </div>
                        <div class="col-md-12">
                            <label for="peran" class="form-label">Peran <span class="text-danger">*</span></label>
                            <select class="form-select form-select-sm" id="peran" name="peran">
                                <option value="">Pilih peran</option>
                                <option value=1>Admin</option>
                                <option value=2>Kader</option>
                                <option value=3>Nakes (Bidan/Perawat)</option>
                            </select>
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
