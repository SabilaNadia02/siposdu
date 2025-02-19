<!-- Modal -->
<div class="modal fade" id="addDataModal" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="position: absolute; right: 25%; top: 50%; transform: translateY(-50%);">
        <div class="modal-content" style="font-size: 14px; padding: 10px;">
            <div class="modal-body">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <h5 class="modal-title fw-bold" id="addDataModalLabel" style="font-size: 18px;">Tambah Pendaftaran
                    Peserta Posyandu</h5>
                <p class="text-muted" style="font-size: 14px;">Masukkan data pendaftaran peserta Posyandu.</p>
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control form-control-sm" id="nama"
                                placeholder="Masukkan Nama">
                        </div>
                        <div class="col-md-6">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" class="form-control form-control-sm" id="nik"
                                placeholder="Masukkan NIK">
                        </div>
                        <div class="col-md-6">
                            <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select form-select-sm" id="jenisKelamin">
                                <option selected disabled>Pilih Jenis Kelamin</option>
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="statusPerkawinan" class="form-label">Status Perkawinan</label>
                            <select class="form-select form-select-sm" id="statusPerkawinan">
                                <option selected disabled>Pilih Status</option>
                                <option value="belum menikah">Menikah</option>
                                <option value="menikah">Tidak Menikah</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="pendidikan" class="form-label">Pendidikan</label>
                            <select class="form-select form-select-sm" id="pendidikan">
                                <option selected disabled>Pilih Pendidikan</option>
                                <option value="tidak_sekolah">Tidak Sekolah</option>
                                <option value="sd">SD</option>
                                <option value="smp">SMP</option>
                                <option value="smu">SMU</option>
                                <option value="akademi">Akademi</option>
                                <option value="perguruan_tinggi">Perguruan Tinggi</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                            <input type="text" class="form-control form-control-sm" id="pekerjaan"
                                placeholder="Masukkan Pekerjaan">
                        </div>
                        <div class="col-md-6">
                            <label for="tempatLahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control form-control-sm" id="tempatLahir"
                                placeholder="Masukkan Tempat Lahir">
                        </div>
                        <div class="col-md-6">
                            <label for="tanggalLahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control form-control-sm" id="tanggalLahir">
                        </div>
                        <div class="col-md-6">
                            <label for="noHp" class="form-label">No. Handphone</label>
                            <input type="text" class="form-control form-control-sm" id="noHp"
                                placeholder="Masukkan No. Handphone">
                        </div>
                        <div class="col-md-6">
                            <label for="noJkn" class="form-label">No. JKN</label>
                            <input type="text" class="form-control form-control-sm" id="noJkn"
                                placeholder="Masukkan No. JKN">
                        </div>
                        <div class="col-12">
                            <label for="alamat" class="form-label">Alamat <span
                                    style="font-size: smaller; font-weight: normal;">(Dusun RT/RW)</span></label>
                            <textarea class="form-control form-control-sm" id="alamat" rows="2" placeholder="Masukkan Alamat"></textarea>
                        </div>
                    </div>
                    <div class="mt-3 d-grid">
                        <button type="submit" style="background-color: #FF69B4;"
                            class="btn btn-sm text-light">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
