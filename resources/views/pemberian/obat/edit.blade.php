<div class="modal fade" id="editPemberianObatModal" tabindex="-1" aria-labelledby="editPemberianObatLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: 1px solid #FF69B4;">
                <h5 class="modal-title fw-bold" id="editPemberianObatLabel" style="color: #FF69B4;">Edit Pemberian Obat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id" name="id">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="edit_id_obat" class="form-label">Nama Obat</label>
                            <select class="form-select" id="edit_id_obat" name="id_obat" required>
                                @foreach($dataObat as $obat)
                                    <option value="{{ $obat->id }}">{{ $obat->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_dosis" class="form-label">Dosis</label>
                            <input type="text" class="form-control" id="edit_dosis" name="dosis" required placeholder="Masukkan Dosis">
                        </div>
                        <div class="col-md-6">
                            <label for="edit_waktu_pemberian" class="form-label">Waktu Pemberian</label>
                            <input type="date" class="form-control" id="edit_waktu_pemberian" name="waktu_pemberian" required>
                        </div>
                        <div class="col-12">
                            <label for="edit_keterangan" class="form-label">Keterangan (opsional)</label>
                            <textarea class="form-control" id="edit_keterangan" name="keterangan" rows="2" placeholder="Masukkan Keterangan"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn text-light" style="background-color: #FF69B4;">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
