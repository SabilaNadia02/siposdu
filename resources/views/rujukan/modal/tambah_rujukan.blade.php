<div class="modal fade" id="tambahRujukanModal" tabindex="-1" aria-labelledby="tambahRujukanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 class="modal-title fw-bold" id="tambahPemberianVitaminLabel" style="font-size: 18px;">Tambah Rujukan</h5>
                <p class="text-muted" style="font-size: 14px;">Masukkan data rujukan peserta posyandu.</p>
                <form action="{{ route('rujukan.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="waktu_rujukan" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Waktu Rujukan <span class="text-danger">*</span>
                                <span style="font-size: 11px; font-weight: normal;">(bulan/tanggal/tahun)</span>
                            </label>
                            <input type="date" class="form-control form-control-sm" id="waktu_rujukan"
                                name="waktu_rujukan" value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}" required>
                        </div>

                        <div class="col-md-12">
                            <label for="no_pendaftaran" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Nama Peserta <span class="text-danger">*</span>
                            </label>
                            <select class="form-select form-select-sm" id="no_pendaftaran" name="no_pendaftaran" required>
                                <option value="" selected disabled>Pilih Peserta</option>
                                @foreach ($pendaftarans as $pendaftaran)
                                    <option value="{{ $pendaftaran->id }}">
                                        {{ $pendaftaran->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label for="jenis_rujukan" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Jenis Rujukan <span class="text-danger">*</span>
                            </label>
                            <select class="form-select form-select-sm" id="jenis_rujukan" name="jenis_rujukan" required>
                                <option value="" selected disabled>Pilih Rujukan</option>
                                <option value="1">Pustu</option>
                                <option value="2">Puskesmas</option>
                                <option value="3">Rumah Sakit</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="keterangan" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Keterangan <span style="font-size: 11px; font-weight: normal;">(opsional)</span>
                            </label>
                            <textarea class="form-control form-control-sm" id="keterangan" name="keterangan" rows="3"
                                placeholder="Masukkan Keterangan"></textarea>
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
