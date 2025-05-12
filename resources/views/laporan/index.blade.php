@extends('layouts.master')

@section('title', 'Laporan')

@section('content')
    <!--begin::App Main-->
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0" style="color: #333333;">Laporan</h3>
                        <p style="color: #777777;">Halaman ini untuk mengunduh laporan.</p>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="#" style="color: #d63384; font-size: 16px;">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Laporan</li>
                        </ol>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content Header-->

        <!--begin::App Content-->
        <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="col-md-12">
                        <div class="card mb-4" style="border-top: 3px solid #d63384; border-radius: 0px;">
                            <div class="card-body">
                                <form action="{{ route('laporan.generate') }}" method="GET">
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="jenis" class="form-label">Jenis Laporan <span
                                                    class="text-danger">*</span></label>
                                            <select name="jenis" id="jenis" class="form-select" required>
                                                <option value="">Pilih Jenis Laporan</option>
                                                <option value="pendaftaran">Laporan Pendaftaran</option>
                                                <option value="pencatatan">Laporan Pencatatan Awal</option>
                                                <option value="kunjungan">Laporan Pencatatan Kunjungan</option>
                                                <option value="balita_tidak_datang">Laporan Pencatatan Peserta Tidak Hadir
                                                </option>
                                                <option value="imunisasi">Laporan Balita - Pemberian Imunisasi</option>
                                                <option value="balita_stunting">Laporan Balita - Stunting (pendek)</option>
                                                <option value="balita_wasting">Laporan Balita - Wasting (kurus)</option>
                                                <option value="vitamin">Laporan Pemberian Vitamin</option>
                                                <option value="obat">Laporan Pemberian Obat</option>
                                                <option value="vaksin">Laporan Pemberian Vaksin</option>
                                                <option value="skrining_tbc">Laporan Skrining TBC</option>
                                                <option value="skrining_ppok">Laporan Skrining PPOK</option>
                                                <option value="kelulusan">Laporan Kelulusan Balita</option>
                                                <option value="rujukan">Laporan Rujukan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="posyandu_id" class="form-label">Posyandu</label>
                                            <select name="posyandu_id" id="posyandu_id" class="form-select">
                                                <option value="semua">Semua Posyandu</option>
                                                @foreach ($posyandus as $posyandu)
                                                    <option value="{{ $posyandu->id }}">{{ $posyandu->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="jenis_sasaran" class="form-label">Jenis Sasaran</label>
                                            <select name="jenis_sasaran" id="jenis_sasaran" class="form-select">
                                                <option value="semua">Semua Jenis Sasaran</option>
                                                @foreach ($jenisSasaranOptions as $value => $label)
                                                    <option value="{{ $value }}">{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="start_date" class="form-label">Tanggal Mulai <span
                                                    style="font-size: 11px; font-weight: normal;">(bulan/tanggal/tahun)</span><span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="start_date" id="start_date" class="form-control"
                                                required max="{{ date('Y-m-d') }}" value="{{ date('Y-m-01') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="end_date" class="form-label">Tanggal Selesai <span
                                                    style="font-size: 11px; font-weight: normal;">(bulan/tanggal/tahun)</span><span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="end_date" id="end_date" class="form-control"
                                                required max="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <button type="submit" class="btn text-light px-4 py-2"
                                            style="background-color: #d63384; min-width: 180px;">
                                            <i class="fas fa-file-pdf"></i> Cetak PDF
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!--end::Row-->
        </div>
        <!--end::App Content-->
    </main>
    <!--end::App Main-->

    <style>
        .bg-light {
            background-color: #f8f9fa !important;
        }

        select:disabled {
            cursor: not-allowed;
        }
    </style>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('form').addEventListener('submit', function(e) {
                console.log('Form submitted');
                console.log(new FormData(this));
            });

            const jenisLaporanSelect = document.getElementById('jenis');
            const jenisSasaranSelect = document.getElementById('jenis_sasaran');

            // Daftar laporan yang khusus untuk balita (jenis sasaran 2)
            const laporanKhususBalita = ['imunisasi', 'kelulusan', 'balita_stunting', 'balita_wasting'];

            // Daftar laporan yang khusus untuk usia produktif dan lansia (jenis sasaran 3)
            const laporanKhususDewasa = ['skrining_ppok'];

            jenisLaporanSelect.addEventListener('change', function() {
                if (laporanKhususBalita.includes(this.value)) {
                    // Untuk laporan balita, set ke jenis sasaran 2
                    jenisSasaranSelect.value = '2';
                    jenisSasaranSelect.disabled = true;
                    jenisSasaranSelect.classList.add('bg-light');
                } else if (laporanKhususDewasa.includes(this.value)) {
                    // Untuk laporan skrining TBC dan PPOK, set ke jenis sasaran 3
                    jenisSasaranSelect.value = '3';
                    jenisSasaranSelect.disabled = true;
                    jenisSasaranSelect.classList.add('bg-light');
                } else {
                    // Untuk laporan lainnya, aktifkan pilihan
                    jenisSasaranSelect.disabled = false;
                    jenisSasaranSelect.classList.remove('bg-light');
                }
            });

            // Inisialisasi saat load
            if (laporanKhususBalita.includes(jenisLaporanSelect.value)) {
                jenisSasaranSelect.value = '2';
                jenisSasaranSelect.disabled = true;
                jenisSasaranSelect.classList.add('bg-light');
            } else if (laporanKhususDewasa.includes(jenisLaporanSelect.value)) {
                jenisSasaranSelect.value = '3';
                jenisSasaranSelect.disabled = true;
                jenisSasaranSelect.classList.add('bg-light');
            }
        });
    </script>
@endpush
