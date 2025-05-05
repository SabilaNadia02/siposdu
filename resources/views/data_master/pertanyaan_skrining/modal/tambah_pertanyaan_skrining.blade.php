<!-- Modal -->
<div class="modal fade" id="tambahPertanyaanSkriningModal" tabindex="-1"
    aria-labelledby="tambahPertanyaanSkriningModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="font-size: 14px; padding: 10px;">
            <div class="modal-body">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <h5 class="modal-title fw-bold" id="tambahPertanyaanSkriningModalLabel" style="font-size: 18px;">Tambah
                    Pertanyaan Skrining Baru</h5>
                <p class="text-muted" style="font-size: 14px;">Masukkan data pertanyaan skrining posyandu.</p>
                <!-- Form untuk menambahkan pertanyaan skrining -->
                <form action="{{ route('data-master.pertanyaan-skrining.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="id_skrining" class="form-label">Nama Skrining <span
                                class="text-danger">*</span></label>
                            <select class="form-select form-select-sm" id="id_skrining" name="id_skrining" required>
                                <option value="" hidden>Pilih Nama Skrining</option>
                                @foreach ($dataSkrining as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_skrining }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="id_pertanyaan" class="form-label">Pertanyaan Skrining <span
                                class="text-danger">*</span></label>
                            <select class="form-select form-select-sm" id="id_pertanyaan" name="id_pertanyaan" required>
                                <option value="" hidden>Pilih Pertanyaan Skrining</option>
                                @foreach ($dataPertanyaan as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama_pertanyaan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-3 d-grid">
                        <button type="submit" class="btn btn-sm text-light"
                            style="background-color: #d63384;">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
