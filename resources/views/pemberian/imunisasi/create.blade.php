@extends('layouts.master')

@section('title', 'Tambah Pemberian Imunisasi')

@php
    use Carbon\Carbon;
@endphp

@section('content')
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="mb-0" style="color: #333333;">Pemberian Imunisasi</h3>
                        <p style="color: #777777; white-space: normal;">Halaman ini untuk mengelola data pemberian imunisasi
                            pada peserta posyandu.</p>
                    </div>
                    <div class="col-sm-4 d-flex justify-content-end align-items-center">
                        <button type="submit" form="tambahForm" class="btn btn-success text-light me-2">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('pemberian.imunisasi.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content Header-->

        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="border-radius: 0px;">
                            <div class="card-header bg-success text-white" style="border-radius: 0px;">
                                <h3 class="card-title">Tambah Pemberian Imunisasi</h3>
                            </div>

                            <div class="card-body" style="border-radius: 0px;">
                                <form id="tambahForm" action="{{ route('pemberian.imunisasi.store') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="waktu_pemberian" class="form-label">Tanggal Pemberian <span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="waktu_pemberian"
                                            name="waktu_pemberian" value="{{ date('Y-m-d') }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="no_pendaftaran" class="form-label">Pilih Peserta <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" id="no_pendaftaran" name="no_pendaftaran" required>
                                            <option value="" selected disabled>-- Pilih Peserta --</option>
                                            @foreach ($pendaftaran as $item)
                                                <option value="{{ $item->id }}"
                                                    data-tanggal-lahir="{{ $item->tanggal_lahir }}">
                                                    {{ $item->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small id="usiaDisplay" class="text-muted">Usia: -</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="id_imunisasi" class="form-label">Jenis Imunisasi <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" id="id_imunisasi" name="id_imunisasi" required>
                                            <option value="" selected disabled>-- Pilih peserta terlebih dahulu --
                                            </option>
                                        </select>
                                        <div id="imunisasiLoading" style="display: none;">
                                            <i class="fas fa-spinner fa-spin"></i> Memuat...
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="keterangan" class="form-label">Keterangan
                                            <span>(optional)</span></label>
                                        <textarea class="form-control" id="keterangan" name="keterangan" rows="2"></textarea>
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

@push('scripts')
    <script>
        $(document).ready(function() {
            console.log("Document ready - Imunisasi Form");

            // Fungsi untuk menghitung usia dalam bulan
            function calculateAgeInMonths(birthDate, referenceDate) {
                const birth = new Date(birthDate);
                const ref = new Date(referenceDate);

                // Pastikan tanggal valid
                if (isNaN(birth.getTime()) || isNaN(ref.getTime())) {
                    console.error("Invalid date format");
                    return 0;
                }

                let years = ref.getFullYear() - birth.getFullYear();
                let months = ref.getMonth() - birth.getMonth();
                let days = ref.getDate() - birth.getDate();

                // Adjust for negative months/days
                if (days < 0) {
                    months--;
                }
                if (months < 0) {
                    years--;
                    months += 12;
                }

                const totalMonths = (years * 12) + months;
                console.log(`Age calculation: ${birthDate} to ${referenceDate} = ${totalMonths} months`);
                return totalMonths;
            }

            // Update tampilan usia
            function updateAgeDisplay() {
                const peserta = $('#no_pendaftaran').find('option:selected');
                const tglLahir = peserta.data('tanggal-lahir');
                const tglPemberian = $('#waktu_pemberian').val();

                if (tglLahir && tglPemberian) {
                    const usiaBulan = calculateAgeInMonths(tglLahir, tglPemberian);
                    $('#usiaDisplay').text(`Usia: ${usiaBulan} bulan`);
                } else {
                    $('#usiaDisplay').text('Usia: -');
                }
            }

            // Load imunisasi options based on selected participant and date
            function loadImunisasiOptions(tglLahir, tglPemberian) {
                console.log("Loading imunisasi options for:", {
                    tglLahir,
                    tglPemberian
                });

                if (!tglLahir || !tglPemberian) {
                    console.log("Missing required data - tglLahir or tglPemberian");
                    $('#id_imunisasi').html(
                        '<option value="" selected disabled>-- Pilih peserta dan tanggal --</option>'
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

                        let options =
                            '<option value="" selected disabled>-- Pilih Imunisasi --</option>';

                        if (response && response.length > 0) {
                            response.forEach(function(item) {
                                options +=
                                    `<option value="${item.id}">${item.nama} (${item.dari_umur}-${item.sampai_umur} bln)</option>`;
                            });
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
                        showAlert('error',
                            'Terjadi kesalahan saat memuat data imunisasi. Silakan coba lagi.');
                    },
                    complete: function() {
                        $('#imunisasiLoading').hide();
                        console.log("AJAX request completed");
                    }
                });
            }

            // Show alert message
            function showAlert(type, message) {
                $('.alert').remove();
                const alertHtml = `
                    <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
                $('.app-content').prepend(alertHtml);
                setTimeout(() => $('.alert').alert('close'), 5000);
            }

            // Handle participant and date change
            $('#no_pendaftaran, #waktu_pemberian').on('change', function() {
                console.log("Selection changed - updating imunisasi options");
                updateAgeDisplay();

                const peserta = $('#no_pendaftaran').find('option:selected');
                const tglLahir = peserta.data('tanggal-lahir');
                const tglPemberian = $('#waktu_pemberian').val();

                console.log("Selected values:", {
                    peserta: peserta.val(),
                    nama: peserta.text(),
                    tglLahir,
                    tglPemberian
                });

                if (tglLahir && tglPemberian) {
                    loadImunisasiOptions(tglLahir, tglPemberian);
                } else {
                    console.log("Missing required data - not loading options");
                    $('#id_imunisasi').html(
                        '<option value="" selected disabled>-- Pilih peserta dan tanggal --</option>'
                    );
                }
            });

            // Form submission handling
            $('#tambahForm').on('submit', function(e) {
                const selectedPeserta = $('#no_pendaftaran').val();
                const selectedImunisasi = $('#id_imunisasi').val();

                console.log("Form submission validation:", {
                    selectedPeserta,
                    selectedImunisasi
                });

                if (!selectedPeserta || selectedPeserta === '') {
                    e.preventDefault();
                    console.log("Validation failed - no peserta selected");
                    showAlert('danger', 'Silakan pilih peserta terlebih dahulu');
                    $('#no_pendaftaran').focus();
                    return false;
                }

                if (!selectedImunisasi || selectedImunisasi === '') {
                    e.preventDefault();
                    console.log("Validation failed - no imunisasi selected");
                    showAlert('danger', 'Silakan pilih jenis imunisasi terlebih dahulu');
                    $('#id_imunisasi').focus();
                    return false;
                }

                console.log("Validation passed - submitting form");
                $('button[type="submit"]').prop('disabled', true)
                    .html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');
            });

            // Initial state
            console.log("Initializing form state");
            $('#id_imunisasi').html(
                '<option value="" selected disabled>-- Pilih peserta terlebih dahulu --</option>');

            // Update age display on page load if values exist
            updateAgeDisplay();
        });
    </script>
@endpush
