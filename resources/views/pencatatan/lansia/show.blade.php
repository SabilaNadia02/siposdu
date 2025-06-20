@extends('layouts.master')

@section('title', 'Detail Pencatatan Usia Subur/Lansia')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0" style="color: #333333; font-size: 1.5rem;">Pencatatan Kunjungan Posyandu</h3>
                        <p style="color: #777777; font-size: 1rem;">Halaman ini untuk mengelola data pencatatan kunjungan
                            pada peserta usia subur atau lansia.</p>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end align-items-center">
                        <a href="{{ route('pencatatan.lansia.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="card shadow-sm" style="border-radius: 0px; border-top: 3px solid #FF8F00;">
                    <div class="card-header">
                        <!-- Tab navigation -->
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item me-2">
                                <button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1"
                                    type="button" role="tab">
                                    Data Pencatatan Awal
                                </button>
                            </li>
                            <li class="nav-item me-2">
                                <button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2"
                                    type="button" role="tab">
                                    Riwayat Kunjungan
                                </button>
                            </li>
                            <li class="nav-item me-2">
                                <button class="nav-link" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab3"
                                    type="button" role="tab">
                                    Catatan Tambahan
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body overflow-x-scroll">

                        @foreach (['success' => 'success', 'error' => 'danger'] as $msg => $type)
                            @if (session($msg))
                                <div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
                                    {{ session($msg) }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                        @endforeach

                        <div class="tab-content" id="myTabContent">

                            <!-- Tab 1: Data Pencatatan Awal -->
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>No Pendaftaran</th>
                                        <td>{{ str_pad(optional($data->pendaftaran)->id, 4, '0', STR_PAD_LEFT) ?? '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>NIK</th>
                                        <td>{{ optional($data->pendaftaran)->nik ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama</th>
                                        <td>{{ optional($data->pendaftaran)->nama ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Lahir</th>
                                        <td>{{ optional($data->pendaftaran)->tanggal_lahir 
                                            ? \Carbon\Carbon::parse($data->pendaftaran->tanggal_lahir)->translatedFormat('j F Y') 
                                            : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Usia</th>
                                        <td>{{ \Carbon\Carbon::parse($data->pendaftaran->tanggal_lahir)->age }} Tahun</td>
                                    </tr>
                                    <tr>
                                        <th>Riwayat Keluarga</th>
                                        <td>
                                            @php $riwayat_keluarga = json_decode($data->riwayat_keluarga ?? '[]', true); @endphp
                                            @if (!empty($riwayat_keluarga))
                                                <ul>
                                                    @foreach ($riwayat_keluarga as $riwayat)
                                                        <li>{{ $riwayat }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Riwayat Diri Sendiri</th>
                                        <td>
                                            @php $riwayat_diri = json_decode($data->riwayat_diri_sendiri ?? '[]', true); @endphp
                                            @if (!empty($riwayat_diri))
                                                <ul>
                                                    @foreach ($riwayat_diri as $riwayat)
                                                        <li>{{ $riwayat }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Perilaku Berisiko</th>
                                        <td>
                                            @php $perilaku_berisiko = json_decode($data->perilaku_berisiko ?? '[]', true); @endphp
                                            @if (!empty($perilaku_berisiko))
                                                <ul>
                                                    @foreach ($perilaku_berisiko as $perilaku)
                                                        <li>{{ $perilaku }}</li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('pencatatan.lansia.edit', $data->id) }}" class="btn text-light mt-2"
                                        style="background-color: #FF8F00;">
                                        <i class="fas fa-edit"></i> Edit Data
                                    </a>
                                </div>
                            </div>

                            <!-- Tab 2: Riwayat Kunjungan -->
                            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                                <h4 class="mb-0">Riwayat Penimbangan, Pengukuran, dan Pemeriksaan</h4>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <p>Data riwayat penimbangan, pengukuran, dan pemeriksaan Balita.</p>
                                    <button type="button" class="btn btn-sm ms-auto text-light"
                                        style="background-color: #FF8F00;" data-bs-toggle="modal"
                                        data-bs-target="#tambahKunjunganBaruModal">
                                        <i class="bi bi-plus"></i> Tambah Data
                                    </button>
                                </div>
                                @include('pencatatan.lansia.modal.tambah_kunjungan_baru')

                                @if ($data->pencatatanKunjungan->isEmpty())
                                    <p class="text-muted">Belum ada riwayat kunjungan.</p>
                                @else
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="table-warning">
                                            <tr>
                                                <th style="width: 150px;">Tanggal Kunjungan</th>
                                                <th style="width: 100px;">Berat Badan (kg)</th>
                                                <th style="width: 120px;">Tekanan Darah (mmHg)</th>
                                                <th style="width: 100px;">Lingkar Perut (cm)</th>
                                                <th style="width: 100px;">Gula Darah (mg/dL)</th>
                                                <th style="width: 100px;">Kolestrol (mg/dL)</th>
                                                <th style="width: 200px;">Keluhan</th>
                                                <th style="width: 200px;">Edukasi</th>
                                                <th class="text-center" style="width: 100px;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data->pencatatanKunjungan as $kunjungan)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($kunjungan->waktu_pencatatan)->translatedFormat('j F Y') }}
                                                    </td>
                                                    <td>{{ $kunjungan->berat_badan ?? '-' }}</td>
                                                    <td>{{ $kunjungan->tekanan_darah_sistolik ?? '-' }}/{{ $kunjungan->tekanan_darah_diastolik ?? '-' }}</td>
                                                    <td>{{ $kunjungan->lingkar_perut ?? '-' }}</td>
                                                    <td>{{ $kunjungan->gula_darah ?? '-' }}</td>
                                                    <td>{{ $kunjungan->kolestrol ?? '-' }}</td>
                                                    <td>{{ $kunjungan->keluhan ?? '-' }}</td>
                                                    <td>{{ $kunjungan->edukasi ?? '-' }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('pencatatan.lansia.kunjungan.show', [$data->id, $kunjungan->id]) }}"
                                                            class="btn btn-info btn-sm" title="Lihat"
                                                            style="width: 20px; height: 20px; font-size: 10px; padding: 1px;">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('pencatatan.lansia.kunjungan.edit', [$data->id, $kunjungan->id]) }}"
                                                            class="btn btn-warning btn-sm" title="Edit"
                                                            style="width: 20px; height: 20px; font-size: 10px; padding: 1px;">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form
                                                            action="{{ route('pencatatan.lansia.kunjungan.destroy', [$data->id, $kunjungan->id]) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm btn-hapus"
                                                                style="width: 20px; height: 20px; font-size: 10px; padding: 1px;"
                                                                title="Hapus">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @endif
                            </div>

                            <!-- Tab 3: Catatan Tambahan -->
                            <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                                <h5>Catatan Tambahan</h5>
                                <p>Catatan tambahan mengenai peserta usia subur atau lansia berdasarkan data yang tersedia.
                                </p>

                                @php
                                    $lansiaBermasalah = [];
                                    $masalahGulaDarah = [];
                                    $masalahKolesterol = [];

                                    foreach ($data->pencatatanKunjungan as $kunjungan) {
                                        // Cek tekanan darah
                                        if (
                                            !is_null($kunjungan->tekanan_darah_sistolik) &&
                                            !is_null($kunjungan->tekanan_darah_diastolik)
                                        ) {
                                            $sistolik = $kunjungan->tekanan_darah_sistolik;
                                            $diastolik = $kunjungan->tekanan_darah_diastolik;

                                            if ($sistolik < 90 || $diastolik < 60) {
                                                $lansiaBermasalah[] =
                                                    "Tekanan darah rendah ({$sistolik}/{$diastolik} mmHg) pada kunjungan tanggal " .
                                                    \Carbon\Carbon::parse(
                                                        $kunjungan->waktu_pencatatan,
                                                    )->translatedFormat('j F Y');
                                            } elseif ($sistolik > 140 || $diastolik > 90) {
                                                $lansiaBermasalah[] =
                                                    "Tekanan darah tinggi ({$sistolik}/{$diastolik} mmHg) pada kunjungan tanggal " .
                                                    \Carbon\Carbon::parse(
                                                        $kunjungan->waktu_pencatatan,
                                                    )->translatedFormat('j F Y');
                                            }
                                        }

                                        // Cek gula darah
                                        if (!is_null($kunjungan->gula_darah)) {
                                            if ($kunjungan->gula_darah < 70) {
                                                $masalahGulaDarah[] =
                                                    "Gula darah rendah ({$kunjungan->gula_darah} mg/dL) pada kunjungan tanggal " .
                                                    \Carbon\Carbon::parse(
                                                        $kunjungan->waktu_pencatatan,
                                                    )->translatedFormat('j F Y');
                                            } elseif ($kunjungan->gula_darah > 200) {
                                                $masalahGulaDarah[] =
                                                    "Gula darah tinggi ({$kunjungan->gula_darah} mg/dL) pada kunjungan tanggal " .
                                                    \Carbon\Carbon::parse(
                                                        $kunjungan->waktu_pencatatan,
                                                    )->translatedFormat('j F Y');
                                            }
                                        }

                                        // Cek kolesterol
                                        if (!is_null($kunjungan->kolestrol) && $kunjungan->kolestrol > 240) {
                                            $masalahKolesterol[] =
                                                "Kolesterol tinggi ({$kunjungan->kolestrol} mg/dL) pada kunjungan tanggal " .
                                                \Carbon\Carbon::parse($kunjungan->waktu_pencatatan)->translatedFormat(
                                                    'j F Y',
                                                );
                                        }
                                    }
                                @endphp

                                @if (!empty($lansiaBermasalah))
                                    <div class="alert alert-danger">
                                        <strong>⚠ Peringatan!</strong> Ditemukan kondisi tekanan darah
                                        bermasalah:
                                        <ul>
                                            @foreach ($lansiaBermasalah as $catatan)
                                                <li>{{ $catatan }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if (!empty($masalahGulaDarah))
                                    <div class="alert alert-danger">
                                        <strong>⚠ Peringatan!</strong> Ditemukan kondisi gula darah bermasalah:
                                        <ul>
                                            @foreach ($masalahGulaDarah as $catatan)
                                                <li>{{ $catatan }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if (!empty($masalahKolesterol))
                                    <div class="alert alert-danger">
                                        <strong>⚠ Peringatan!</strong> Ditemukan kondisi kadar kolesterol tinggi:
                                        <ul>
                                            @foreach ($masalahKolesterol as $catatan)
                                                <li>{{ $catatan }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if (empty($lansiaBermasalah) && empty($masalahGulaDarah) && empty($masalahKolesterol))
                                    <p class="text-success">✅ Tidak ditemukan masalah terkait tekanan darah, gula darah,
                                        atau kolesterol.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <style>
        /* Styling untuk table dan padding */
        table.table th,
        table.table td {
            padding: 10px;
        }

        table.table th {
            text-align: left;
            width: 35%;
        }

        /* Styling untuk tombol tab */
        .nav-tabs .nav-link {
            border-radius: 4px;
            border: 1px solid #ddd;
            color: #333;
            transition: all 0.3s ease;
            padding: 10px 20px;
            font-weight: 500;
            background: #f8f9fa;
        }

        /* Styling untuk tab yang aktif */
        .nav-tabs .nav-link.active {
            background-color: #FF8F00 !important;
            color: #fff !important;
            border-color: #FF8F00 !important;
        }

        /* Hover effect */
        .nav-tabs .nav-link:hover {
            color: #FF8F00 !important;
        }

        /* Menghilangkan border bawah tab */
        .nav-tabs {
            border-bottom: none;
        }
    </style>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.btn-hapus').on('click', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#FF8F00',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
