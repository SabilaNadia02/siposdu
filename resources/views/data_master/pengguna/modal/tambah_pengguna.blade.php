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
                                placeholder="Masukkan nama" required>
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control form-control-sm" id="email" name="email"
                                placeholder="Masukkan email" required>
                        </div>
                        <div class="col-md-12">
                            <label for="role" class="form-label">Peran <span class="text-danger">*</span></label>
                            <select class="form-select form-select-sm" id="role" name="role" required>
                                <option value="">Pilih peran</option>
                                <option value="1">Admin</option>
                                <option value="2">Tenaga Kesehatan</option>
                                <option value="3">Kader</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control form-control-sm" id="password" name="password"
                                placeholder="Masukkan password" required>
                        </div>
                        <div class="col-md-12">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control form-control-sm" id="password_confirmation" 
                                name="password_confirmation" placeholder="Konfirmasi password" required>
                        </div>
                    </div>
                    <div class="mt-3 d-grid">
                        <button type="submit" class="btn btn-sm text-light"
                            style="background-color: #d63384;">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
