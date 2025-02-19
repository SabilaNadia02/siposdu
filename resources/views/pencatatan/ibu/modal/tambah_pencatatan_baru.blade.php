<!-- Modal -->
<div class="modal fade" id="tambahPencatatanBaruModal" tabindex="-1" aria-labelledby="tambahPencatatanBaruModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="position: absolute; right: 25%; top: 40%; transform: translateY(-50%);">
        <div class="modal-content" style="font-size: 14px; padding: 10px;">
            <div class="modal-body">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 class="modal-title fw-bold" id="tambahPencatatanBaruModalLabel" style="font-size: 18px;">Tambah Pencatatan Ibu Hamil Baru</h5>
                <p class="text-muted" style="font-size: 14px;">Masukkan data peserta posyandu.</p>
                <form>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="nama" class="form-label">Nama Suami</label>
                            <input type="text" class="form-control form-control-sm" id="nama" placeholder="Masukkan Nama Suami">
                        </div>
                        <div class="col-md-6">
                            <label for="hpht" class="form-label">Hari Pertama Haid Terakhir (HPHT)</label>
                            <input type="date" class="form-control form-control-sm" id="hpht">
                        </div>
                        <div class="col-md-6">
                            <label for="htp" class="form-label">Hari Taksiran Persalinan (HTP)</label>
                            <input type="date" class="form-control form-control-sm" id="htp">
                        </div>
                        <div class="col-md-6">
                            <label for="hamilKe" class="form-label">Hamil Anak ke-</label>
                            <input type="number" class="form-control form-control-sm" id="hamilKe" placeholder="0">
                        </div>
                        <div class="col-md-6">
                            <label for="jarakAnak" class="form-label">Jarak Anak (tahun)</label>
                            <input type="number" class="form-control form-control-sm" id="jarakAnak" placeholder="0">
                        </div>
                        <div class="col-md-12">
                            <label for="tinggiBadan" class="form-label">Tinggi Badan (cm)</label>
                            <input type="number" class="form-control form-control-sm" id="tinggiBadan" name="tinggiBadan" placeholder="0" min="0" step="0.1">
                        </div>
                        <div class="col-md-12">
                            <label for="namaPosyandu" class="form-label">Nama Posyandu</label>
                            <select class="form-select form-select-sm" id="namaPosyandu">
                                <option selected disabled>Pilih Nama Posyandu</option>
                                <option value="anggrek">Posyandu Anggrek</option>
                                <option value="kenanga">Posyandu Kenanga</option>
                                <option value="matahari">Posyandu Matahari</option>
                                <option value="mawar">Posyandu Mawar</option>
                                <option value="melati">Posyandu Melati</option>
                            </select>
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
