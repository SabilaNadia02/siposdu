@extends('layouts.master')

@section('title', 'Detail Pencatatan Ibu Hamil')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0" style="color: #333333; font-size: 1.5rem;">Pencatatan Kunjungan Posyandu</h3>
                        <p style="color: #777777; font-size: 1rem;">Halaman ini untuk mengelola data pencatatan kunjungan
                            pada Ibu Hamil.</p>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end align-items-center">
                        <a href="{{ route('pencatatan.ibu.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="card shadow-sm" style="border-radius: 0px; border-top: 3px solid #007BFF;">
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

                    <div class="card-body">
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
                                        <th>Nama</th>
                                        <td>{{ optional($data->pendaftaran)->nama ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Suami</th>
                                        <td>{{ $data->nama_suami ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Hamil Ke</th>
                                        <td>{{ $data->hamil_ke ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jarak Anak</th>
                                        <td>{{ $data->jarak_anak ?? '-' }} tahun</td>
                                    </tr>
                                    <tr>
                                        <th>Tinggi Badan</th>
                                        <td>{{ $data->tinggi_badan ?? '-' }} cm</td>
                                    </tr>
                                    <tr>
                                        <th>Hari Pertama Haid Terakhir (HPHT)</th>
                                        <td>{{ \Carbon\Carbon::parse($data->hpht)->translatedFormat('j F Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Hari Taksiran Persalinan (HTP)</th>
                                        <td>{{ \Carbon\Carbon::parse($data->htp)->translatedFormat('j F Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Usia Kehamilan</th>
                                        <td>{{ $data->usia_kehamilan ?? '-' }} minggu</td>
                                    </tr>
                                </table>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('pencatatan.ibu.edit', $data->id) }}" class="btn btn-primary mt-2">
                                        <i class="fas fa-edit"></i> Edit Data
                                    </a>
                                </div>
                            </div>

                            <!-- Tab 2: Riwayat Kunjungan -->
                            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
                                <h4 class="mb-0">Riwayat Penimbangan, Pengukuran, dan Pemeriksaan</h4>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <p>Data riwayat penimbangan, pengukuran, dan pemeriksaan Ibu Hamil.</p>
                                    <a href="#" class="btn btn-primary">Tambah Data</a>
                                </div>

                                @if ($data->pencatatanKunjungan->isEmpty())
                                    <p class="text-muted">Belum ada riwayat kunjungan.</p>
                                @else
                                    <table class="table table-bordered">
                                        <thead class="table-primary">
                                            <tr>
                                                <th style="width: 150px;">Tanggal Kunjungan</th>
                                                <th style="width: 100px;">Berat Badan</th>
                                                <th style="width: 100px;">Lingkar Lengan</th>
                                                <th style="width: 120px;">Tekanan Darah</th>
                                                <th style="width: 120px;">MT Bumil KEK</th>
                                                <th style="width: 120px;">Kelas Ibu Hamil</th>
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
                                                    <td>{{ $kunjungan->berat_badan ?? '-' }}
                                                        kg</td>
                                                    <td>{{ $kunjungan->lingkar_lengan ?? '-' }}
                                                        cm</td>
                                                    <td>{{ $kunjungan->tekanan_darah_sistolik ?? '-' }}/{{ $kunjungan->tekanan_darah_diastolik ?? '-' }}
                                                        mmHg</td>
                                                    <td>{{ $kunjungan->mt_bumil_kek == 1 ? 'Ya' : ($kunjungan->mt_bumil_kek == 2 ? 'Tidak' : '-') }}
                                                    </td>
                                                    <td>{{ $kunjungan->kelas_ibu_hamil == 1 ? 'Ya' : ($kunjungan->kelas_ibu_hamil == 2 ? 'Tidak' : '-') }}
                                                    </td>
                                                    <td>{{ $kunjungan->keluhan ?? '-' }}
                                                    </td>
                                                    <td>{{ $kunjungan->edukasi ?? '-' }}
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('pencatatan.ibu.kunjungan.show', [$data->id, $kunjungan->id]) }}"
                                                            class="btn btn-info btn-sm" title="Lihat"
                                                            style="width: 20px; height: 20px; font-size: 10px; padding: 1px;">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('pencatatan.ibu.kunjungan.edit', [$data->id, $kunjungan->id]) }}"
                                                            class="btn btn-warning btn-sm" title="Edit"
                                                            style="width: 20px; height: 20px; font-size: 10px; padding: 1px;">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form
                                                            action="{{ route('pencatatan.ibu.kunjungan.destroy', [$data->id, $kunjungan->id]) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm btn-hapus"
                                                                title="Hapus"
                                                                style="width: 20px; height: 20px; font-size: 10px; padding: 1px;"
                                                                onclick="return confirm('Yakin ingin menghapus?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>

                            <!-- Tab 3: Catatan Tambahan -->
                            <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
                                <h5>Catatan Tambahan</h5>
                                <p>Catatan tambahan mengenai ibu hamil berdasarkan data yang tersedia.</p>

                                @php
                                    $ibuBermasalah = [];
                                    foreach ($data->pencatatanKunjungan as $kunjungan) {
                                        if (
                                            !is_null($kunjungan->tekanan_darah_sistolik) &&
                                            !is_null($kunjungan->tekanan_darah_diastolik)
                                        ) {
                                            $sistolik = $kunjungan->tekanan_darah_sistolik;
                                            $diastolik = $kunjungan->tekanan_darah_diastolik;

                                            // Kriteria tekanan darah bermasalah
                                            if ($sistolik < 90 || $diastolik < 60) {
                                                $ibuBermasalah[] =
                                                    "Tekanan darah rendah ( {$sistolik}/{$diastolik} mmHg ) pada kunjungan tanggal " .
                                                    \Carbon\Carbon::parse(
                                                        $kunjungan->waktu_kunjungan,
                                                    )->translatedFormat('j F Y');
                                            } elseif ($sistolik > 140 || $diastolik > 90) {
                                                $ibuBermasalah[] =
                                                    "Tekanan darah tinggi ( {$sistolik}/{$diastolik} mmHg ) pada kunjungan tanggal " .
                                                    \Carbon\Carbon::parse(
                                                        $kunjungan->waktu_kunjungan,
                                                    )->translatedFormat('j F Y');
                                            }
                                        }
                                    }
                                @endphp

                                @if (!empty($ibuBermasalah))
                                    <div class="alert alert-warning">
                                        <strong>⚠ Peringatan!</strong> Ditemukan ibu hamil dengan kondisi tekanan darah
                                        bermasalah:
                                        <ul>
                                            @foreach ($ibuBermasalah as $catatan)
                                                <li>{{ $catatan }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @else
                                    <p class="text-success">✅ Tidak ditemukan masalah terkait tekanan darah ibu hamil.</p>
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
            background-color: #007bff !important;
            color: #fff !important;
            border-color: #007bff !important;
        }

        /* Hover effect */
        .nav-tabs .nav-link:hover {
            color: #007bff !important;
        }

        /* Menghilangkan border bawah tab */
        .nav-tabs {
            border-bottom: none;
        }
    </style>
@endsection
