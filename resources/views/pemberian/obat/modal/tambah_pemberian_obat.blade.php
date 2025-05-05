<div class="modal fade" id="tambahPemberianObatModal" tabindex="-1" aria-labelledby="tambahPemberianObatLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="font-size: 14px;">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="tambahPemberianObatLabel">Tambah Pemberian Obat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted">Masukkan data pemberian obat peserta posyandu.</p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pemberian.obat.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="waktu_pemberian" class="form-label">Waktu Pemberian <span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control form-control-sm" id="waktu_pemberian"
                            name="waktu_pemberian" required>
                    </div>

                    <div class="mb-3">
                        <label for="no_pendaftaran" class="form-label">Nama Peserta <span
                                class="text-danger">*</span></label>
                        <select class="form-select form-select-sm" id="no_pendaftaran" name="no_pendaftaran" required>
                            <option value="" selected disabled>Pilih Peserta</option>
                            @foreach ($pendaftarans as $pendaftaran)
                                <option value="{{ $pendaftaran->id }}">{{ $pendaftaran->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="obat-container">
                        <div class="row g-2 mb-2 obat-group">
                            <div class="col-md-6">
                                <label class="form-label">Nama Obat <span class="text-danger">*</span></label>
                                <select class="form-select form-select-sm" name="id_obat[]" required>
                                    <option value="" selected disabled>Pilih Obat</option>
                                    @foreach ($dataObat as $obat)
                                        <option value="{{ $obat->id }}">{{ $obat->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label">Dosis <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" name="dosis[]"
                                    placeholder="Masukkan Dosis" required>
                            </div>
                            <div class="col-md-1 d-flex align-items-end">
                                <button type="button" class="btn btn-sm btn-danger remove-obat">×</button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-2">
                        <button type="button" class="btn btn-sm btn-secondary" id="add-obat">+ Tambah Obat</button>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan (opsional)</label>
                        <textarea class="form-control form-control-sm" id="keterangan" name="keterangan" rows="2"
                            placeholder="Masukkan Keterangan"></textarea>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set default waktu_pemberian ke hari ini saat modal dibuka
        const waktuField = document.getElementById('waktu_pemberian');
        const setTanggalSekarang = () => {
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const dd = String(today.getDate()).padStart(2, '0');
            waktuField.value = `${yyyy}-${mm}-${dd}`;
        };

        // Tambah obat
        document.getElementById('add-obat').addEventListener('click', function() {
            const container = document.getElementById('obat-container');
            const newGroup = document.querySelector('.obat-group').cloneNode(true);

            // Clear values in the new group
            newGroup.querySelector('select').selectedIndex = 0;
            newGroup.querySelector('input').value = '';

            container.appendChild(newGroup);
        });

        // Hapus obat
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-obat')) {
                const groups = document.querySelectorAll('.obat-group');
                if (groups.length > 1) {
                    e.target.closest('.obat-group').remove();
                } else {
                    alert('Minimal harus ada satu obat');
                }
            }
        });

        // Reset setiap kali modal dibuka
        const modal = document.getElementById('tambahPemberianObatModal');
        modal.addEventListener('shown.bs.modal', function() {
            setTanggalSekarang();
            // Reset obat groups to 1
            const groups = document.querySelectorAll('.obat-group');
            groups.forEach((group, index) => {
                if (index > 0) group.remove();
            });
            if (groups[0]) {
                groups[0].querySelector('select').selectedIndex = 0;
                groups[0].querySelector('input').value = '';
            }
        });
    });
</script>
