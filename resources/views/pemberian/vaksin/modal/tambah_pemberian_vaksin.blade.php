<!-- Modal Cari Peserta -->
<div class="modal fade" id="tambahPemberianVaksinModal" tabindex="-1" aria-labelledby="tambahPemberianVaksinLabel" aria-hidden="true">
    <div class="modal-dialog" style="position: absolute; right: 25%; top: 30%; transform: translateY(-50%);">
        <div class="modal-content" style="font-size: 14px; padding: 10px;">
            <div class="modal-body">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <h5 class="modal-title fw-bold" id="tambahPemberianVaksinLabel" style="font-size: 18px;">Tambah Pemberian Vaksin</h5>
                <p class="text-muted" style="font-size: 14px;">Masukkan data pemberian vaksin peserta posyandu.</p>
                <form>
                    <div class="row g-3">
                        <div class="col-6">
                            <label for="jenis_rujukan" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Nama Vaksin
                            </label>
                            <select class="form-select form-select-sm" id="jenis_rujukan">
                                <option selected disabled>Pilih Nama Vaksin</option>
                                <option value="pustu">Hepatitis B</option>
                                <option value="pustu">BCG</option>
                                <option value="pustu">Polio Tetes 1</option>
                                <option value="pustu">DPT-HB-Hib 1</option>
                                <option value="pustu">Polio Tetes 2</option>
                                <option value="pustu">Rotavirus (RV)1*</option>
                                <option value="pustu">PCV 1</option>
                                <option value="pustu">DPT-HB-Hib 2</option>
                                <option value="pustu">Polio Tetes 3</option>
                                <option value="pustu">Rotavirus (RV)2*</option>
                                <option value="pustu">PCV 2</option>
                                <option value="pustu">DPT-HB-Hib 3</option>
                                <option value="pustu">Polio Tetes 4</option>
                                <option value="pustu">Polio Suntik (IPV) 1</option>
                                <option value="pustu">Rotavirus (RV)3*</option>
                                <option value="pustu">Campak Rubella (MR)</option>
                                <option value="pustu">Polio Suntik (IPV) 2*</option>
                                <option value="pustu">Japanese Encephalitis (JE)</option>
                                <option value="pustu">PCV 3</option>
                                <option value="pustu">DPT-HB-Hib Lanjutan</option>
                                <option value="pustu">Campak -Rubella (MR) Lanjutan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="jumlah" class="form-label" style="font-size: 14px; margin-bottom: 2px;">Jumlah/Dosis</label>
                            <input type="text" class="form-control form-control-sm" id="nik" placeholder="Masukkan Jumlah/Dosis">
                        </div>
                        <div class="mt-3 col-12">
                            <button type="submit" class="btn btn-sm text-light" style="background-color: #FF69B4;">TAMBAH</button>
                        </div>
                        <div class="col-12">
                            <label for="keterangan" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Keterangan <span style="font-size: 11px; font-weight: normal;">(opsional)</span>
                            </label>
                            <textarea class="form-control form-control-sm" id="keterangan" rows="2" placeholder="Masukkan Keterangan"></textarea>
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
