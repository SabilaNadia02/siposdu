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
                                        <label for="waktu_pemberian" class="form-label">Tanggal Pemberian</label>
                                        <input type="date" class="form-control" id="waktu_pemberian"
                                            name="waktu_pemberian" value="{{ date('Y-m-d') }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="no_pendaftaran" class="form-label">Pilih Peserta</label>
                                        <select class="form-select" id="no_pendaftaran" name="no_pendaftaran" required>
                                            <option value="" selected disabled>-- Pilih Peserta --</option>
                                            @foreach ($pendaftaran as $item)
                                                @php
                                                    $usiaBulan = (int) Carbon::parse(
                                                        $item->tanggal_lahir,
                                                    )->diffInMonths(now());
                                                @endphp
                                                <option value="{{ $item->no_pendaftaran }}"
                                                    data-tanggal-lahir="{{ $item->tanggal_lahir }}">
                                                    {{ $item->nama }} ({{ $usiaBulan }} bulan)
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="id_imunisasi" class="form-label">Jenis Imunisasi</label>
                                        <select class="form-select" id="id_imunisasi" name="id_imunisasi" required disabled>
                                            <option value="" selected disabled>-- Pilih peserta terlebih dahulu --
                                            </option>
                                        </select>
                                        <div id="imunisasiLoading" class="text-muted small mt-1" style="display: none;">
                                            <i class="fas fa-spinner fa-spin"></i> Memuat data imunisasi...
                                        </div>
                                        <div id="imunisasiInfo" class="text-muted small mt-1">
                                            <i class="fas fa-info-circle"></i> Pilihan imunisasi akan muncul setelah memilih
                                            peserta dan tanggal pemberian
                                        </div>
                                    </div>

                                    {{-- <div class="mb-3">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <textarea class="form-control" id="keterangan" name="keterangan" rows="2"></textarea>
                                    </div> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
            <script>
                $(document).ready(function() {
                    // Fungsi untuk menghitung usia dalam bulan
                    function hitungUsiaBulan(tglLahirStr, tglPemberianStr) {
                        const tglLahir = new Date(tglLahirStr);
                        const tglPemberian = new Date(tglPemberianStr);
                        
                        // Pastikan tanggal valid
                        if (isNaN(tglLahir.getTime()) {
                            console.error('Tanggal lahir tidak valid:', tglLahirStr);
                            return 0;
                        }
                        if (isNaN(tglPemberian.getTime())) {
                            console.error('Tanggal pemberian tidak valid:', tglPemberianStr);
                            return 0;
                        }
                        
                        let usiaBulan = (tglPemberian.getFullYear() - tglLahir.getFullYear()) * 12;
                        usiaBulan += tglPemberian.getMonth() - tglLahir.getMonth();
                        
                        // Adjust jika hari pemberian belum mencapai hari lahir
                        if (tglPemberian.getDate() < tglLahir.getDate()) {
                            usiaBulan -= 1;
                        }
                        
                        return Math.max(0, usiaBulan);
                    }

                    // Fungsi untuk memuat imunisasi berdasarkan usia
                    function updateImunisasiOptions() {
                        const selectedPeserta = $('#no_pendaftaran option:selected');
                        const tglLahir = selectedPeserta.data('tanggal-lahir');
                        const tglPemberian = $('#waktu_pemberian').val();

                        // Validasi jika data belum lengkap
                        if (!tglLahir || !tglPemberian || selectedPeserta.val() === '') {
                            $('#id_imunisasi').html(
                                '<option value="" selected disabled>-- Pilih peserta dan tanggal dulu --</option>');
                            $('#id_imunisasi').prop('disabled', true);
                            $('#imunisasiInfo').show();
                            $('#imunisasiLoading').hide();
                            return;
                        }

                        // Hitung usia dalam bulan
                        const usiaBulan = hitungUsiaBulan(tglLahir, tglPemberian);

                        // Tampilkan loading
                        $('#imunisasiLoading').show();
                        $('#imunisasiInfo').hide();
                        $('#id_imunisasi').html('<option value="" selected disabled>-- Memuat... --</option>');
                        $('#id_imunisasi').prop('disabled', true);

                        // AJAX request untuk mendapatkan imunisasi sesuai usia
                        $.ajax({
                            url: '{{ route('pemberian.imunisasi.get-imunisasi-by-usia') }}',
                            method: 'GET',
                            data: {
                                usia_bulan: usiaBulan,
                                _token: '{{ csrf_token() }}' // Tambahkan CSRF token
                            },
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            },
                            success: function(response) {
                                console.log('Response:', response); // Debug log
                                let options = '<option value="" selected disabled>-- Pilih Imunisasi --</option>';

                                if (response.length > 0) {
                                    $.each(response, function(index, imunisasi) {
                                        options += `<option value="${imunisasi.id}">${imunisasi.nama} (usia ${imunisasi.dari_umur}-${imunisasi.sampai_umur} bulan)</option>`;
                                    });
                                    $('#id_imunisasi').prop('disabled', false);
                                } else {
                                    options = '<option value="" selected disabled>-- Tidak ada imunisasi yang sesuai untuk usia ini --</option>';
                                    $('#id_imunisasi').prop('disabled', true);
                                }

                                $('#id_imunisasi').html(options);
                            },
                            error: function(xhr, status, error) {
                                console.error('Error:', error, xhr.responseText);
                                $('#id_imunisasi').html(
                                    '<option value="" selected disabled>-- Gagal memuat data imunisasi --</option>'
                                );
                                $('#id_imunisasi').prop('disabled', true);
                            },
                            complete: function() {
                                $('#imunisasiLoading').hide();
                            }
                        });

                    // Event handler ketika peserta atau tanggal berubah
                    $('#no_pendaftaran, #waktu_pemberian').on('change', function() {
                        updateImunisasiOptions();
                    });

                    // Inisialisasi awal jika ada nilai
                    if ($('#no_pendaftaran').val() && $('#waktu_pemberian').val()) {
                        updateImunisasiOptions();
                    }
                });
            </script>
        @endpush
    </main>
@endsection
