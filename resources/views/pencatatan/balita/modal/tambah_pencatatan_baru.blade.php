<!-- Modal -->
<div class="modal fade" id="tambahPencatatanBaruModal" tabindex="-1" aria-labelledby="tambahPencatatanBaruModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="position: absolute; right: 30%; top: 30%; transform: translateY(-50%);">
        <div class="modal-content" style="font-size: 14px; padding: 10px;">
            <div class="modal-body">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 class="modal-title fw-bold" id="tambahPencatatanBaruModalLabel" style="font-size: 18px;">Tambah Pencatatan Balita Baru</h5>
                <p class="text-muted" style="font-size: 14px;">Masukkan data peserta posyandu.</p>
                <form action="{{ route('pencatatan.balita.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="no_pendaftaran" class="form-label">Nama Balita</label>
                            <select class="form-select form-select-sm" id="no_pendaftaran" name="no_pendaftaran"
                                required>
                                <option value="" hidden>Pilih Nama Balita</option>
                                @foreach ($pendaftarans as $pendaftaran)
                                    <option value="{{ $pendaftaran->id }}">{{ $pendaftaran->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="nama_ibu" class="form-label">Nama Ibu</label>
                            <input type="text" class="form-control form-control-sm" id="nama_ibu" name="nama_ibu" placeholder="Masukkan Nama Ibu">
                        </div>
                        <div class="col-md-12">
                            <label for="nama_ayah" class="form-label">Nama Ayah</label>
                            <input type="text" class="form-control form-control-sm" id="nama_ayah" name="nama_ayah" placeholder="Masukkan Nama Ayah">
                        </div>
                        <div class="col-md-6">
                            <label for="berat_badan_lahir" class="form-label">Berat Badan Lahir (Kg)</label>
                            <input type="number" class="form-control form-control-sm" id="berat_badan_lahir" name="berat_badan_lahir" placeholder="0" min="0" step=any>
                        </div>
                        <div class="col-md-6">
                            <label for="panjang_badan_lahir" class="form-label">Panjang Badan Lahir (cm)</label>
                            <input type="number" class="form-control form-control-sm" id="panjang_badan_lahir" name="panjang_badan_lahir" placeholder="0" min="0" step=any>
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
