<!-- Modal -->
<div class="modal fade" id="tambahKunjunganBaruModal" tabindex="-1" aria-labelledby="tambahKunjunganBaruModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="font-size: 14px; padding: 10px;">
            <div class="modal-body">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <h5 class="modal-title fw-bold" id="tambahKunjunganBaruModalLabel" style="font-size: 18px;">Tambah
                    Pencatatan Kunjungan Ibu Hamil</h5>
                <p class="text-muted" style="font-size: 14px;">Masukkan data peserta posyandu.</p>
                <form action="{{ route('pencatatan.ibu.kunjungan.store', ['id_pencatatan_awal' => $data->id]) }}"
                    method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="waktu_pencatatan" class="form-label"
                                style="font-size: 14px; margin-bottom: 2px;">
                                Waktu ke Posyandu <span
                                    style="font-size: 11px; font-weight: normal;">(bulan/tanggal/tahun)</span><span
                                    class="text-danger">*</span>
                            </label>
                            <input type="date" class="form-control form-control-sm" id="waktu_pencatatan"
                                name="waktu_pencatatan">
                        </div>

                        <h6 style="margin-top: 20px; margin-bottom: 4px;">Hasil Penimbangan/Pengukuran/Pemeriksaan</h6>
                        <div class="col-6" style="margin-top: 8px;">
                            <label for="berat_badan" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Berat Badan (Kg) <span class="text-danger">*</span>
                            </label>
                            <input type="number" class="form-control form-control-sm" id="berat_badan"
                                name="berat_badan" placeholder="0" step=any>
                        </div>
                        <div class="col-6" style="margin-top: 8px;">
                            <label for="lingkar_lengan" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Lingkar Lengan Atas (cm) <span class="text-danger">*</span>
                            </label>
                            <input type="number" class="form-control form-control-sm" id="lingkar_lengan"
                                name="lingkar_lengan" placeholder="0" step=any>
                        </div>
                        <div class="col-6" style="margin-top: 8px;">
                            <label for="tekanan_darah_sistolik" class="form-label"
                                style="font-size: 14px; margin-bottom: 2px;">
                                Tekanan Darah (Sistolik) <span class="text-danger">*</span>
                            </label>
                            <input type="number" class="form-control form-control-sm" id="tekanan_darah_sistolik"
                                name="tekanan_darah_sistolik" placeholder="0" step=any>
                        </div>
                        <div class="col-6" style="margin-top: 8px;">
                            <label for="tekanan_darah_diastolik" class="form-label"
                                style="font-size: 14px; margin-bottom: 2px;">
                                Tekanan Darah (Diastolik) <span class="text-danger">*</span>
                            </label>
                            <input type="number" class="form-control form-control-sm" id="tekanan_darah_diastolik"
                                name="tekanan_darah_diastolik" placeholder="0" step=any>
                        </div>

                        <h6 style="margin-top: 20px; margin-bottom: 4px;">Kegiatan dan Tindakan</h6>
                        <div class="col-6" style="margin-top: 8px;">
                            <label for="kelas_ibu_hamil" class="form-label"
                                style="font-size: 14px; margin-bottom: 2px;">
                                Mengikuti Kelas Ibu Hamil?
                            </label>
                            <select class="form-select form-select-sm" id="kelas_ibu_hamil" name="kelas_ibu_hamil">
                                <option selected disabled>Pilih Jawaban</option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                        </div>
                        <div class="col-6" style="margin-top: 8px;">
                            <label for="mt_bumil_kek" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Pemberian MT Bumil KEK?
                            </label>
                            <select class="form-select form-select-sm" id="mt_bumil_kek" name="mt_bumil_kek">
                                <option selected disabled>Pilih Jawaban</option>
                                <option value="1">Ya</option>
                                <option value="2">Tidak</option>
                            </select>
                        </div>
                        <div class="col-12" style="margin-top: 8px;">
                            <label for="keluhan" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Keluhan
                            </label>
                            <textarea class="form-control" name="keluhan" maxlength="255">{{ old('keluhan') }}</textarea>
                        </div>
                        <div class="col-12" style="margin-top: 8px;">
                            <label for="edukasi" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Edukasi
                            </label>
                            <textarea class="form-control" name="edukasi" maxlength="255">{{ old('edukasi') }}</textarea>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let today = new Date().toISOString().split('T')[0];
        document.getElementById("waktu_pencatatan").value = today;
    });
</script>
