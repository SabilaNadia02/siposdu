@extends('layouts.master')

@section('title', 'Edit Pemberian Imunisasi')

@php
    use Carbon\Carbon;
@endphp

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="mb-0" style="color: #333333;">Edit Pemberian Imunisasi</h3>
                        <p style="color: #777777;">Halaman untuk mengedit data pemberian imunisasi pada peserta posyandu.</p>
                    </div>
                    <div class="col-sm-4 d-flex justify-content-end align-items-center">
                        <button type="submit" form="editForm" class="btn btn-success me-2"
                            style="background-color: #198754; border-color: #198754;">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('pemberian.imunisasi.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="border-radius: 0px;">
                            <div class="card-header text-white" style="background-color: #198754; border-radius: 0px;">
                                <h3 class="card-title">Edit Pemberian Imunisasi</h3>
                            </div>

                            <div class="card-body">
                                <form id="editForm"
                                    action="{{ route('pemberian.imunisasi.update', $pemberianImunisasi->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="waktu_pemberian" class="form-label">Tanggal Pemberian <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="waktu_pemberian"
                                                name="waktu_pemberian"
                                                value="{{ Carbon::parse($pemberianImunisasi->waktu_pemberian)->format('Y-m-d') }}"
                                                disabled>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="no_pendaftaran" class="form-label">Peserta <span class="text-danger">*</span></label>
                                            <select class="form-select" id="no_pendaftaran" name="no_pendaftaran" disabled>
                                                @foreach ($pendaftaran as $item)
                                                    <option value="{{ $item->id }}"
                                                        data-tanggal-lahir="{{ $item->tanggal_lahir }}"
                                                        {{ $item->id == $pemberianImunisasi->no_pendaftaran ? 'selected' : '' }}>
                                                        {{ $item->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small id="usiaDisplay" class="text-muted">
                                                Usia:
                                                {{ intval(Carbon::parse($pemberianImunisasi->pendaftaran->tanggal_lahir)
                                                    ->diffInMonths(Carbon::parse($pemberianImunisasi->waktu_pemberian))) }}
                                                bulan
                                            </small>                                                                                     
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="id_imunisasi" class="form-label">Jenis Imunisasi <span class="text-danger">*</span></label>
                                        <select class="form-select" id="id_imunisasi" name="id_imunisasi" required>
                                            <!-- Options akan diisi oleh JavaScript -->
                                        </select>
                                        <div id="imunisasiLoading" style="display: none;">
                                            <i class="fas fa-spinner fa-spin"></i> Memuat...
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="keterangan" class="form-label">Keterangan <span>(optional)</span></label>
                                        <textarea class="form-control" id="keterangan" name="keterangan" rows="2">{{ $pemberianImunisasi->keterangan }}</textarea>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            console.log("Document ready - Edit Imunisasi Form");

            // Fungsi untuk menghitung usia dalam bulan
            function calculateAgeInMonths(birthDate, referenceDate) {
                const birth = new Date(birthDate);
                const ref = new Date(referenceDate);
                let months = (ref.getFullYear() - birth.getFullYear()) * 12;
                months += ref.getMonth() - birth.getMonth();
                if (ref.getDate() < birth.getDate()) {
                    months--;
                }
                return months;
            }

            // Load imunisasi options based on selected participant and date
            function loadImunisasiOptions(tglLahir, tglPemberian, selectedImunisasiId = null) {
                console.log("Loading imunisasi options for:", {
                    tglLahir,
                    tglPemberian,
                    selectedImunisasiId
                });

                if (!tglLahir || !tglPemberian) {
                    console.log("Missing required data - tglLahir or tglPemberian");
                    $('#id_imunisasi').html(
                        '<option value="" selected disabled>-- Data tidak lengkap --</option>'
                    );
                    return;
                }

                $('#imunisasiLoading').show();
                $('#id_imunisasi').prop('disabled', true);

                $.ajax({
                    url: '{{ route('pemberian.imunisasi.get-imunisasi-by-usia') }}',
                    method: 'GET',
                    data: {
                        tanggal_lahir: tglLahir,
                        waktu_pemberian: tglPemberian,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log("AJAX Success - Response:", response);

                        let options = '';
                        let foundSelected = false;

                        if (response && response.length > 0) {
                            // Tambahkan opsi yang sesuai dengan usia
                            response.forEach(function(item) {
                                const selected = (item.id == selectedImunisasiId) ? 'selected' : '';
                                if (selected) foundSelected = true;
                                
                                options +=
                                    `<option value="${item.id}" ${selected}>${item.nama} (${item.dari_umur}-${item.sampai_umur} bln)</option>`;
                            });

                            // Jika imunisasi yang sebelumnya dipilih tidak ada dalam daftar yang sesuai usia,
                            // kita tetap tambahkan sebagai opsi (mungkin karena perubahan aturan)
                            if (selectedImunisasiId && !foundSelected) {
                                const currentImunisasi = {!! json_encode($pemberianImunisasi->imunisasi) !!};
                                if (currentImunisasi) {
                                    options =
                                        `<option value="${currentImunisasi.id}" selected>${currentImunisasi.nama} (Tidak sesuai usia saat ini)</option>` +
                                        options;
                                }
                            }
                        } else {
                            options =
                                '<option value="" selected disabled>-- Tidak ada imunisasi untuk usia ini --</option>';
                            console.warn("No immunization options available for this age");
                        }

                        $('#id_imunisasi').html(options).prop('disabled', false);
                        console.log("Options updated in select element");
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", status, error, xhr.responseText);
                        $('#id_imunisasi').html(
                            '<option value="" selected disabled>-- Gagal memuat data. Coba lagi --</option>'
                        );
                    },
                    complete: function() {
                        $('#imunisasiLoading').hide();
                        console.log("AJAX request completed");
                    }
                });
            }

            // Inisialisasi form saat pertama kali dimuat
            function initializeForm() {
                const peserta = $('#no_pendaftaran').find('option:selected');
                const tglLahir = peserta.data('tanggal-lahir');
                const tglPemberian = $('#waktu_pemberian').val();
                const selectedImunisasiId = {{ $pemberianImunisasi->id_imunisasi ?? 'null' }};

                console.log("Initializing form with:", {
                    tglLahir,
                    tglPemberian,
                    selectedImunisasiId
                });

                if (tglLahir && tglPemberian) {
                    loadImunisasiOptions(tglLahir, tglPemberian, selectedImunisasiId);
                } else {
                    console.log("Missing required data - not initializing options");
                    $('#id_imunisasi').html(
                        '<option value="" selected disabled>-- Data tidak lengkap --</option>'
                    );
                }
            }

            // Form submission handling
            $('#editForm').on('submit', function(e) {
                const selectedImunisasi = $('#id_imunisasi').val();

                console.log("Form submission validation:", {
                    selectedImunisasi
                });

                if (!selectedImunisasi || selectedImunisasi === '') {
                    e.preventDefault();
                    console.log("Validation failed - no imunisasi selected");
                    alert('Silakan pilih jenis imunisasi terlebih dahulu');
                    $('#id_imunisasi').focus();
                    return false;
                }

                console.log("Validation passed - submitting form");
                $('button[type="submit"]').prop('disabled', true)
                    .html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');
            });

            // Panggil inisialisasi saat dokumen siap
            initializeForm();
        });
    </script>
@endsection
