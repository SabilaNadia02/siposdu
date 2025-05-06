<!-- Modal -->
<div class="modal fade" id="tambahPencatatanBaruModal" tabindex="-1" aria-labelledby="tambahPencatatanBaruModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="font-size: 14px; padding: 10px;">
            <div class="modal-body">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <h5 class="modal-title fw-bold" id="tambahPencatatanBaruModalLabel" style="font-size: 18px;">Tambah
                    Pencatatan Lansia Baru</h5>
                <p class="text-muted" style="font-size: 14px;">Masukkan data peserta posyandu.</p>
                <form action="{{ route('pencatatan.lansia.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="no_pendaftaran" class="form-label">Nama Peserta Usia Subur/Lansia <span class="text-danger">*</span></label>
                            <select class="form-select form-select-sm" id="no_pendaftaran" name="no_pendaftaran"
                                required>
                                <option value="" hidden>Pilih nama peserta lansia</option>
                                @foreach ($pendaftarans as $pendaftaran)
                                    <option value="{{ $pendaftaran->id }}">{{ $pendaftaran->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Riwayat Keluarga</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="hipertensiKeluarga"
                                    name="riwayat_keluarga[]" value="Hipertensi">
                                <label class="form-check-label" for="hipertensiKeluarga">Hipertensi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="dmKeluarga"
                                    name="riwayat_keluarga[]" value="DM">
                                <label class="form-check-label" for="dmKeluarga">DM</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="strokeKeluarga"
                                    name="riwayat_keluarga[]" value="Stroke">
                                <label class="form-check-label" for="strokeKeluarga">Stroke</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="jantungKeluarga"
                                    name="riwayat_keluarga[]" value="Jantung">
                                <label class="form-check-label" for="jantungKeluarga">Jantung</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="kankerKeluarga"
                                    name="riwayat_keluarga[]" value="Kanker">
                                <label class="form-check-label" for="kankerKeluarga">Kanker</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="kolesterolKeluarga"
                                    name="riwayat_keluarga[]" value="Kolesterol Tinggi">
                                <label class="form-check-label" for="kolesterolKeluarga">Kolesterol Tinggi</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Riwayat Diri Sendiri</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="hipertensiDiri"
                                    name="riwayat_diri[]" value="Hipertensi">
                                <label class="form-check-label" for="hipertensiDiri">Hipertensi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="dmDiri" name="riwayat_diri[]"
                                    value="DM">
                                <label class="form-check-label" for="dmDiri">DM</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="strokeDiri" name="riwayat_diri[]"
                                    value="Stroke">
                                <label class="form-check-label" for="strokeDiri">Stroke</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="jantungDiri"
                                    name="riwayat_diri[]" value="Jantung">
                                <label class="form-check-label" for="jantungDiri">Jantung</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="kankerDiri"
                                    name="riwayat_diri[]" value="Kanker">
                                <label class="form-check-label" for="kankerDiri">Kanker</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="kolesterolDiri"
                                    name="riwayat_diri[]" value="Kolesterol Tinggi">
                                <label class="form-check-label" for="kolesterolDiri">Kolesterol Tinggi</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Perilaku Berisiko Diri Sendiri</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="merokok"
                                    name="perilaku_berisiko[]" value="Merokok">
                                <label class="form-check-label" for="merokok">Merokok</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="tinggiGula"
                                    name="perilaku_berisiko[]" value="Konsumsi Tinggi Gula">
                                <label class="form-check-label" for="tinggiGula">Konsumsi Tinggi Gula</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="tinggiGaram"
                                    name="perilaku_berisiko[]" value="Konsumsi Tinggi Garam">
                                <label class="form-check-label" for="tinggiGaram">Konsumsi Tinggi Garam</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="tinggiLemak"
                                    name="perilaku_berisiko[]" value="Konsumsi Tinggi Lemak">
                                <label class="form-check-label" for="tinggiLemak">Konsumsi Tinggi Lemak</label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 d-grid">
                        <button type="submit" class="btn btn-sm text-light"
                            style="background-color: #FF8F00;">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
