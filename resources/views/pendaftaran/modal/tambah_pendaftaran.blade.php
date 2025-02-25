<!-- Modal -->
<div class="modal fade" id="addDataModal" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="position: absolute; right: 30%; top: 45%; transform: translateY(-50%);">
        <div class="modal-content" style="font-size: 14px; padding: 10px;">
            <div class="modal-body">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 class="modal-title fw-bold" id="addDataModalLabel" style="font-size: 18px;">Tambah Pendaftaran Peserta Posyandu</h5>
                <p class="text-muted" style="font-size: 14px;">Masukkan data pendaftaran peserta Posyandu.</p>
                
                <form action="{{ route('pendaftaran.store') }}" method="POST">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control form-control-sm @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama">
                            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" class="form-control form-control-sm @error('nik') is-invalid @enderror" name="nik" id="nik" value="{{ old('nik') }}" placeholder="Masukkan NIK">
                            @error('nik') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select form-select-sm @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" id="jenis_kelamin">
                                <option selected disabled>Pilih Jenis Kelamin</option>
                                <option value="1" {{ old('jenis_kelamin') == 1 ? 'selected' : '' }}>Laki-laki</option>
                                <option value="2" {{ old('jenis_kelamin') == 2 ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="status_perkawinan" class="form-label">Status Perkawinan</label>
                            <select class="form-select form-select-sm @error('status_perkawinan') is-invalid @enderror" name="status_perkawinan" id="status_perkawinan">
                                <option selected disabled>Pilih Status</option>
                                <option value="1" {{ old('status_perkawinan') == 1 ? 'selected' : '' }}>Tidak Menikah</option>
                                <option value="2" {{ old('status_perkawinan') == 2 ? 'selected' : '' }}>Menikah</option>
                            </select>
                            @error('status_perkawinan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="pendidikan" class="form-label">Pendidikan</label>
                            <select class="form-select form-select-sm @error('pendidikan') is-invalid @enderror" name="pendidikan" id="pendidikan">
                                <option selected disabled>Pilih Pendidikan</option>
                                <option value="1">Tidak Sekolah</option>
                                <option value="2">SD</option>
                                <option value="3">SMP</option>
                                <option value="4">SMU</option>
                                <option value="5">Akademi</option>
                                <option value="6">Perguruan Tinggi</option>
                            </select>
                            @error('pendidikan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                            <input type="text" class="form-control form-control-sm @error('pekerjaan') is-invalid @enderror" name="pekerjaan" id="pekerjaan" value="{{ old('pekerjaan') }}" placeholder="Masukkan Pekerjaan">
                            @error('pekerjaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control form-control-sm @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="Masukkan Tempat Lahir">
                            @error('tempat_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control form-control-sm @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                            @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="no_hp" class="form-label">No. Handphone</label>
                            <input type="text" class="form-control form-control-sm @error('no_hp') is-invalid @enderror" name="no_hp" id="no_hp" value="{{ old('no_hp') }}" placeholder="Masukkan No. Handphone">
                            @error('no_hp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="no_jkn" class="form-label">No. JKN</label>
                            <input type="text" class="form-control form-control-sm @error('no_jkn') is-invalid @enderror" name="no_jkn" id="no_jkn" value="{{ old('no_jkn') }}" placeholder="Masukkan No. JKN">
                            @error('no_jkn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control form-control-sm @error('alamat') is-invalid @enderror" name="alamat" id="alamat" rows="2" placeholder="Masukkan Alamat">{{ old('alamat') }}</textarea>
                            @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mt-3 d-grid">
                        <button type="submit" style="background-color: #FF69B4;" class="btn btn-sm text-light">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
