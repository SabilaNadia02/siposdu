<!-- Modal Tambah Pemberian Vitamin -->
<div class="modal fade" id="tambahPemberianVitaminModal" tabindex="-1" aria-labelledby="tambahPemberianVitaminLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="font-size: 14px; padding: 10px;">
            <div class="modal-body">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <h5 class="modal-title fw-bold" id="tambahPemberianVitaminLabel" style="font-size: 18px;">Tambah Pemberian Vitamin</h5>
                <p class="text-muted" style="font-size: 14px;">Masukkan data pemberian vitamin peserta posyandu.</p>
                <form action="{{ route('pemberian.vitamin.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="no_pendaftaran" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Nama Peserta
                            </label>
                            <select class="form-select form-select-sm" id="no_pendaftaran" name="no_pendaftaran" required>
                                <option selected disabled>Pilih Peserta</option>
                                @foreach(App\Models\Pendaftaran::all() as $peserta)
                                    <option value="{{ $peserta->id }}">{{ $peserta->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="id_vitamin" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Nama Vitamin
                            </label>
                            <select class="form-select form-select-sm" id="id_vitamin" name="id_vitamin" required>
                                <option selected disabled>Pilih Vitamin</option>
                                @foreach(App\Models\DataVitamin::all() as $vitamin)
                                    <option value="{{ $vitamin->id }}">{{ $vitamin->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="dosis" class="form-label" style="font-size: 14px; margin-bottom: 2px;">Jumlah/Dosis</label>
                            <input type="text" class="form-control form-control-sm" id="dosis" name="dosis" placeholder="Masukkan Jumlah/Dosis" required>
                        </div>
                        <div class="col-12">
                            <label for="keterangan" class="form-label" style="font-size: 14px; margin-bottom: 2px;">
                                Keterangan <span style="font-size: 11px; font-weight: normal;">(opsional)</span>
                            </label>
                            <textarea class="form-control form-control-sm" id="keterangan" name="keterangan" rows="2" placeholder="Masukkan Keterangan"></textarea>
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
