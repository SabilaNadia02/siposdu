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
                            <select class="form-control form-control-sm select2-input-style" id="no_pendaftaran" name="no_pendaftaran"
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
                                placeholder="Masukkan nama suami">
                        </div>
                        <div class="col-md-6">
                            <label for="hpht" class="form-label">Hari Pertama Haid Terakhir (HPHT) <span class="text-danger">*</span></label>
                            <input type="date" class="form-control form-control-sm" id="hpht" name="hpht">
                        </div>
                        <div class="col-md-6">
                            <label for="tinggi_badan" class="form-label">Tinggi Badan (cm) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-control-sm" id="tinggi_badan"
                                name="tinggi_badan" placeholder="Masukkan tinggi badan" step="any">
                        </div>
                        <div class="col-md-6">
                            <label for="hamil_ke" class="form-label">Hamil Anak ke- <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-control-sm" id="hamil_ke" name="hamil_ke"
                                placeholder="0" min="1">
                        </div>
                        <div class="col-md-6">
                            <label for="jarak_anak" class="form-label">Jarak Anak (tahun)</label>
                            <input type="number" class="form-control form-control-sm" id="jarak_anak" name="jarak_anak"
                                placeholder="Masukkan jarak anak" min="0" value="0">
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

<style>
    /* Style untuk membuat select2 terlihat seperti input biasa */
    .select2-input-style + .select2-container .select2-selection--single {
        height: calc(1.5em + 0.5rem + 2px);
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        line-height: 1.5;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        background-color: #fff;
        background-clip: padding-box;
    }
    
    .select2-input-style + .select2-container .select2-selection--single .select2-selection__arrow {
        height: calc(1.5em + 0.5rem + 2px);
    }
    
    .select2-input-style + .select2-container .select2-selection--single .select2-selection__rendered {
        line-height: 1.5;
        padding-left: 0.5rem;
        padding-right: 2rem;
    }
</style>

<script>
    $(document).ready(function() {
        // Inisialisasi Select2 dengan tampilan seperti input biasa
        $('.select2-input-style').select2({
            placeholder: "Pilih nama ibu",
            allowClear: true,
            dropdownParent: $('#tambahPencatatanBaruModal'),
            minimumResultsForSearch: 1, // Munculkan search ketika ada 1 karakter
            width: '100%',
            theme: 'bootstrap-5' // Jika menggunakan Bootstrap 5
        });
        
        // Tambahkan class untuk styling
        $('.select2-input-style').next('.select2-container').addClass('form-control form-control-sm p-0');
        
        // Pastikan untuk menutup Select2 ketika modal ditutup
        $('#tambahPencatatanBaruModal').on('hidden.bs.modal', function () {
            $('.select2-input-style').select2('close');
        });
    });
</script>
