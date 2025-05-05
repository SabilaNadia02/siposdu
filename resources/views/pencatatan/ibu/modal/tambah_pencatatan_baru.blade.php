<!-- Modal -->
<div class="modal fade" id="tambahPencatatanBaruModal" tabindex="-1" aria-labelledby="tambahPencatatanBaruModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="font-size: 14px; padding: 10px;">
            <div class="modal-body">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <h5 class="modal-title fw-bold" id="tambahPencatatanBaruModalLabel" style="font-size: 18px;">Tambah
                    Pencatatan Ibu Hamil Baru</h5>
                <p class="text-muted" style="font-size: 14px;">Masukkan data peserta posyandu.</p>
                <form action="{{ route('pencatatan.ibu.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="no_pendaftaran" class="form-label">Nama Ibu Hamil <span class="text-danger">*</span></label>
                            <select class="form-select form-select-sm" id="no_pendaftaran" name="no_pendaftaran"
                                required>
                                <option value="" hidden>Pilih nama ibu</option>
                                @foreach ($pendaftarans as $pendaftaran)
                                    <option value="{{ $pendaftaran->id }}">{{ $pendaftaran->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="nama_suami" class="form-label">Nama Suami <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="nama_suami" name="nama_suami"
                                placeholder="Masukkan nama suami" required>
                        </div>
                        <div class="col-md-6">
                            <label for="hpht" class="form-label">Hari Pertama Haid Terakhir (HPHT) <span class="text-danger">*</span></label>
                            <input type="date" class="form-control form-control-sm" id="hpht" name="hpht"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label for="tinggi_badan" class="form-label">Tinggi Badan (cm) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-control-sm" id="tinggi_badan"
                                name="tinggi_badan" placeholder="Masukkan tinggi badan" min="0" required>
                        </div>
                        <div class="col-md-6">
                            <label for="hamil_ke" class="form-label">Hamil Anak ke- <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-control-sm" id="hamil_ke" name="hamil_ke"
                                placeholder="0" min="1" required>
                        </div>
                        <div class="col-md-6">
                            <label for="jarak_anak" class="form-label">Jarak Anak (tahun)</label>
                            <input type="number" class="form-control form-control-sm" id="jarak_anak" name="jarak_anak"
                                placeholder="Masukkan jarak anak" min="0" value="0" required>
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
