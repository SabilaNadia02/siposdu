<!-- Modal -->
<div class="modal fade" id="tambahPencatatanBaruModal" tabindex="-1" aria-labelledby="tambahPencatatanBaruModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="position: absolute; right: 25%; top: 40%; transform: translateY(-50%);">
        <div class="modal-content" style="font-size: 14px; padding: 10px;">
            <div class="modal-body">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 class="modal-title fw-bold" id="tambahPencatatanBaruModalLabel" style="font-size: 18px;">Tambah Pencatatan Balita Baru</h5>
                <p class="text-muted" style="font-size: 14px;">Masukkan data peserta posyandu.</p>
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="namaIbu" class="form-label">Nama Ibu</label>
                            <input type="text" class="form-control form-control-sm" id="namaIbu" placeholder="Masukkan Nama Ibu">
                        </div>
                        <div class="col-md-6">
                            <label for="namaAyah" class="form-label">Nama Ayah</label>
                            <input type="text" class="form-control form-control-sm" id="namaAyah" placeholder="Masukkan Nama Ayah">
                        </div>
                        <div class="col-md-6">
                            <label for="berat_badan_lahir" class="form-label">Berat Badan Lahir (Kg)</label>
                            <input type="number" class="form-control form-control-sm" id="berat_badan_lahir" name="berat_badan_lahir" placeholder="0" min="0" step="0.1">
                        </div>
                        <div class="col-md-6">
                            <label for="panjang_badan_lahir" class="form-label">Panjang Badan Lahir (cm)</label>
                            <input type="number" class="form-control form-control-sm" id="panjang_badan_lahir" name="panjang_badan_lahir" placeholder="0" min="0" step="0.1">
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
                        <button type="submit" class="btn btn-success btn-sm">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
