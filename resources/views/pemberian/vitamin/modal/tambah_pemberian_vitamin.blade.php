<div class="modal fade" id="tambahPemberianVitaminModal" tabindex="-1" aria-labelledby="tambahPemberianVitaminLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="font-size: 14px;">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="tambahPemberianVitaminLabel">Tambah Pemberian Vitamin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted">Masukkan data pemberian vitamin peserta posyandu.</p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pemberian.vitamin.store') }}" method="POST">
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

                    <div id="vitamin-container">
                        <div class="row g-2 mb-2 vitamin-group">
                            <div class="col-md-6">
                                <label class="form-label">Nama Vitamin <span class="text-danger">*</span></label>
                                <select class="form-select form-select-sm" name="id_vitamin[]" required>
                                    <option value="" selected disabled>Pilih Vitamin</option>
                                    @foreach ($dataVitamin as $vitamin)
                                        <option value="{{ $vitamin->id }}">{{ $vitamin->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label">Dosis <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" name="dosis[]"
                                    placeholder="Masukkan Dosis" required>
                            </div>
                            <div class="col-md-1 d-flex align-items-end">
                                <button type="button" class="btn btn-sm btn-danger remove-vitamin">×</button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-2">
                        <button type="button" class="btn btn-sm btn-secondary" id="add-vitamin">+ Tambah Vitamin</button>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan (opsional)</label>
                        <textarea class="form-control form-control-sm" id="keterangan" name="keterangan" rows="2"
                            placeholder="Masukkan Keterangan"></textarea>
                    </div>

                    <div class="mt-3 d-grid">
                        <button type="submit" class="btn btn-sm text-light"
                            style="background-color: #FF69B4;">SIMPAN</button>
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

        // Tambah vitamin
        document.getElementById('add-vitamin').addEventListener('click', function() {
            const container = document.getElementById('vitamin-container');
            const newGroup = document.querySelector('.vitamin-group').cloneNode(true);

            // Clear values in the new group
            newGroup.querySelector('select').selectedIndex = 0;
            newGroup.querySelector('input').value = '';

            container.appendChild(newGroup);
        });

        // Hapus vitamin
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-vitamin')) {
                const groups = document.querySelectorAll('.vitamin-group');
                if (groups.length > 1) {
                    e.target.closest('.vitamin-group').remove();
                } else {
                    alert('Minimal harus ada satu vitamin');
                }
            }
        });

        // Reset setiap kali modal dibuka
        const modal = document.getElementById('tambahPemberianVitaminModal');
        modal.addEventListener('shown.bs.modal', function() {
            setTanggalSekarang();
            // Reset vitamin groups to 1
            const groups = document.querySelectorAll('.vitamin-group');
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
