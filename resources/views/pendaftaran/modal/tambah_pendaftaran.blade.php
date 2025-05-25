<!-- Modal -->
<div class="modal fade" id="addDataModal" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="font-size: 14px; padding: 10px;">
            <div class="modal-body">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <h5 class="modal-title fw-bold" id="tambahKunjunganBaruModalLabel" style="font-size: 18px;">Tambah
                    Pendaftaran Peserta Posyandu</h5>
                <p class="text-muted" style="font-size: 14px;">Masukkan data peserta posyandu.</p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pendaftaran.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <!-- NIK -->
                        <div class="col-md-6">
                            <label for="nik" class="form-label">NIK <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="nik"
                                value="{{ old('nik') }}" placeholder="Masukkan NIK">
                        </div>

                        <!-- Nama -->
                        <div class="col-md-6">
                            <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="nama"
                                value="{{ old('nama') }}" placeholder="Masukkan nama lengkap">
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="col-md-6">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select class="form-select form-select-sm" name="jenis_kelamin">
                                <option selected disabled>Pilih jenis kelamin</option>
                                <option value="1">Laki-laki</option>
                                <option value="2">Perempuan</option>
                            </select>
                        </div>

                        <!-- Status Perkawinan -->
                        <div class="col-md-6">
                            <label for="status_perkawinan" class="form-label">Status Perkawinan <span class="text-danger">*</span></label>
                            <select class="form-select form-select-sm" name="status_perkawinan">
                                <option selected disabled>Pilih status perkawinan</option>
                                <option value="1">Tidak Menikah</option>
                                <option value="2">Menikah</option>
                            </select>
                        </div>

                        <!-- Tempat Lahir -->
                        <div class="col-md-6">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="tempat_lahir"
                                value="{{ old('tempat_lahir') }}" placeholder="Masukkan tempat lahir">
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="col-md-6">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span
                                    style="font-size: 11px; font-weight: normal;">(bulan/tanggal/tahun)</span><span class="text-danger">*</span></label>
                            <input type="date" class="form-control form-control-sm" name="tanggal_lahir"
                                value="{{ old('tanggal_lahir') }}">
                        </div>

                        <!-- Pendidikan -->
                        <div class="col-md-6">
                            <label for="pendidikan" class="form-label">Pendidikan <span class="text-danger">*</span></label>
                            <select class="form-select form-select-sm" name="pendidikan">
                                <option selected disabled>Pilih tingkat pendidikan</option>
                                <option value="1">Tidak Sekolah</option>
                                <option value="2">SD</option>
                                <option value="3">SMP</option>
                                <option value="4">SMA</option>
                                <option value="5">Diploma/Sarjana</option>
                                <option value="6">Lainnya</option>
                            </select>
                        </div>

                        <!-- Pekerjaan -->
                        <div class="col-md-6">
                            <label for="pekerjaan" class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                            <select class="form-select form-select-sm" name="pekerjaan">
                                <option selected disabled>Pilih pekerjaan</option>
                                <option value="1">Tidak Bekerja</option>
                                <option value="2">PNS</option>
                                <option value="3">TNI/Polri</option>
                                <option value="4">Swasta</option>
                                <option value="5">Wirausaha</option>
                                <option value="6">Petani</option>
                                <option value="7">Lainnya</option>
                            </select>
                        </div>

                        <!-- Alamat -->
                        <div class="col-12">
                            <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control form-control-sm" name="alamat" rows="2" placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                        </div>

                        <!-- No HP -->
                        <div class="col-md-6">
                            <label for="no_hp" class="form-label">No HP <span
                                    style="font-size: 11px; font-weight: normal;">(cth: 6285852057967)</span><span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="no_hp"
                                value="{{ old('no_hp') }}" placeholder="Masukkan nomor HP aktif">
                        </div>

                        <!-- No JKN -->
                        <div class="col-md-6">
                            <label for="no_jkn" class="form-label">No JKN <span
                                    style="font-size: 11px; font-weight: normal;">(opsional)</span><span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="no_jkn"
                                value="{{ old('no_jkn') }}" placeholder="Masukkan nomor JKN (jika ada)">
                        </div>

                        <!-- Jenis Sasaran -->
                        <div class="col-md-6">
                            <label for="jenis_sasaran" class="form-label">Jenis Sasaran <span class="text-danger">*</span></label>
                            <select class="form-select form-select-sm" name="jenis_sasaran">
                                <option selected disabled>Pilih jenis sasaran</option>
                                <option value="1" {{ old('jenis_sasaran') == 1 ? 'selected' : '' }}>Ibu Hamil
                                </option>
                                <option value="2" {{ old('jenis_sasaran') == 2 ? 'selected' : '' }}>Balita
                                </option>
                                <option value="3" {{ old('jenis_sasaran') == 3 ? 'selected' : '' }}>Usia Subur
                                    atau Lansia</option>
                            </select>
                        </div>

                        <!-- Nama Posyandu -->
                        <div class="col-md-6">
                            <label for="data_posyandu_id" class="form-label">Nama Posyandu <span class="text-danger">*</span></label>
                            <select class="form-select form-select-sm" name="data_posyandu_id">
                                <option selected disabled>Pilih Posyandu</option>
                                @foreach ($posyandus as $posyandu)
                                    <option value="{{ $posyandu->id }}">{{ $posyandu->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-3 d-grid">
                            <button type="submit" class="btn btn-sm text-light"
                                style="background-color: #d63384;">SIMPAN</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
