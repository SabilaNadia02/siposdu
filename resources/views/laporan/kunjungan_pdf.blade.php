<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 16px;
            color: #333;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 12px;
            color: #666;
        }

        .info {
            margin-bottom: 15px;
        }

        .info p {
            margin: 3px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 11px;
            color: #666;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            font-style: italic;
            color: #777;
        }

        .danger-value {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>{{ $title }}</h1>
        <p>Posyandu ILP Desa Jambean</p>
        <p>Tanggal {{ date('d-m-Y', strtotime($startDate)) }} s/d {{ date('d-m-Y', strtotime($endDate . ' -1 day')) }}
        </p>
    </div>

    <div class="info">
        <p><strong>Posyandu:</strong> {{ $posyanduFilter }}</p>
        <p><strong>Jenis Sasaran:</strong> {{ $jenisSasaranFilter }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">NIK</th>
                <th rowspan="2">Nama</th>
                @if ($jenisSasaranFilter == 'Ibu Hamil' || $jenisSasaranFilter == 'Semua Jenis Sasaran')
                    <th rowspan="2">Usia Kehamilan</th>
                @endif
                @if ($jenisSasaranFilter == 'Balita' || $jenisSasaranFilter == 'Semua Jenis Sasaran')
                    <th rowspan="2">Usia</th>
                @endif
                @if ($jenisSasaranFilter == 'Usia Produktif dan Lansia' || $jenisSasaranFilter == 'Semua Jenis Sasaran')
                    <th rowspan="2">Usia (Tahun)</th>
                @endif
                <th rowspan="2">Berat Badan</th>

                @if ($jenisSasaranFilter == 'Ibu Hamil' || $jenisSasaranFilter == 'Semua Jenis Sasaran')
                    <th colspan="4" style="text-align: center;">Data Penimbangan/Pengukuran/Pemeriksaan</th>
                @endif
                @if ($jenisSasaranFilter == 'Balita' || $jenisSasaranFilter == 'Semua Jenis Sasaran')
                    <th colspan="6" style="text-align: center;">Data Penimbangan/Pengukuran/Pemeriksaan</th>
                @endif
                @if ($jenisSasaranFilter == 'Usia Produktif dan Lansia' || $jenisSasaranFilter == 'Semua Jenis Sasaran')
                    <th colspan="6" style="text-align: center;">Data Penimbangan/Pengukuran/Pemeriksaan</th>
                @endif
                <th rowspan="2">Keluhan</th>
                <th rowspan="2">Edukasi</th>
            </tr>
            <tr>
                @if ($jenisSasaranFilter == 'Ibu Hamil' || $jenisSasaranFilter == 'Semua Jenis Sasaran')
                    <th>Tekanan Darah</th>
                    <th>Lingkar Lengan</th>
                    <th>Kelas Ibu Hamil</th>
                    <th>MT Bumil KEK</th>
                @endif
                @if ($jenisSasaranFilter == 'Balita' || $jenisSasaranFilter == 'Semua Jenis Sasaran')
                    <th>Tinggi Badan</th>
                    <th>Lingkar Kepala</th>
                    <th>ASI Eksklusif</th>
                    <th>MP ASI</th>
                    <th>MT Pangan</th>
                    <th>Catatan Kesehatan</th>
                @endif
                @if ($jenisSasaranFilter == 'Usia Produktif dan Lansia' || $jenisSasaranFilter == 'Semua Jenis Sasaran')
                    <th>Tekanan Darah</th>
                    <th>Lingkar Perut</th>
                    <th>Gula Darah</th>
                    <th>Kolesterol</th>
                    <th>Tes Mata (Kanan / Kiri)</th>
                    <th>Tes Telinga (Kanan / Kiri)</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if ($data->isEmpty())
                <tr>
                    <td colspan="@php
$colspan = 6; // No, NIK, Nama, Berat Badan, Keluhan, Edukasi
                        if($jenisSasaranFilter == 'Ibu Hamil' || $jenisSasaranFilter == 'Semua Jenis Sasaran') {
                            $colspan += 5; // Usia Hamil + 4 data ibu hamil
                        }
                        if($jenisSasaranFilter == 'Balita' || $jenisSasaranFilter == 'Semua Jenis Sasaran') {
                            $colspan += 7; // Usia + 6 data balita
                        }
                        if($jenisSasaranFilter == 'Usia Produktif dan Lansia' || $jenisSasaranFilter == 'Semua Jenis Sasaran') {
                            $colspan += 8; // Usia + 7 data lansia
                        }
                        echo $colspan; @endphp"
                        class="no-data">
                        Tidak ada data kunjungan yang ditemukan untuk periode ini
                    </td>
                </tr>
            @else
                @foreach ($data as $key => $item)
                    @php
                        $pendaftaran = $item->pencatatanAwal->pendaftaran ?? null;
                        $pencatatanAwal = $item->pencatatanAwal ?? null;
                        $jenisSasaran = $pendaftaran->jenis_sasaran ?? null;

                        // Calculate pregnancy age if this is a pregnant mother
                        $usiaKehamilan = '-';
                        if ($jenisSasaran == 1 && isset($pencatatanAwal->hpht) && !empty($pencatatanAwal->hpht)) {
                            $hpht = new DateTime($pencatatanAwal->hpht);
                            $visitDate = new DateTime($item->waktu_pencatatan);
                            $interval = $hpht->diff($visitDate);
                            $weeks = floor($interval->days / 7);
                            $usiaKehamilan = $weeks;
                        }

                        // Check for dangerous values
                        $tekananDarahDanger = false;
                        $gulaDarahDanger = false;
                        $kolesterolDanger = false;

                        if ($jenisSasaran == 1 || $jenisSasaran == 3) {
                            // Check blood pressure
                            if (!is_null($item->tekanan_darah_sistolik) && !is_null($item->tekanan_darah_diastolik)) {
                                $sistolik = $item->tekanan_darah_sistolik;
                                $diastolik = $item->tekanan_darah_diastolik;
                                if ($sistolik < 90 || $diastolik < 60 || $sistolik > 140 || $diastolik > 90) {
                                    $tekananDarahDanger = true;
                                }
                            }

                            // Check blood sugar (for lansia only)
                            if ($jenisSasaran == 3 && !is_null($item->gula_darah)) {
                                if ($item->gula_darah < 70 || $item->gula_darah > 200) {
                                    $gulaDarahDanger = true;
                                }
                            }

                            // Check cholesterol (for lansia only)
                            if ($jenisSasaran == 3 && !is_null($item->kolestrol) && $item->kolestrol > 240) {
                                $kolesterolDanger = true;
                            }
                        }
                    @endphp
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>{{ $pendaftaran->nik ?? '-' }}</td>
                        <td>{{ $pendaftaran->nama ?? '-' }}</td>

                        {{-- Usia berdasarkan jenis sasaran --}}
                        @if ($jenisSasaranFilter == 'Ibu Hamil' || $jenisSasaranFilter == 'Semua Jenis Sasaran')
                            <td>
                                @if ($jenisSasaran == 1)
                                    {{ $usiaKehamilan }} minggu
                                @else
                                    -
                                @endif
                            </td>
                        @endif
                        @if ($jenisSasaranFilter == 'Balita' || $jenisSasaranFilter == 'Semua Jenis Sasaran')
                            <td>
                                @if ($jenisSasaran == 2 && $pendaftaran->tanggal_lahir)
                                    @php
                                        $lahir = \Carbon\Carbon::parse($pendaftaran->tanggal_lahir);
                                        $now = \Carbon\Carbon::now();
                                        $umur = $lahir->diff($now);
                                    @endphp
                                    {{ $umur->y }} tahun {{ $umur->m }} bulan {{ $umur->d }} hari
                                @else
                                    -
                                @endif
                            </td>
                        @endif

                        @if ($jenisSasaranFilter == 'Usia Produktif dan Lansia' || $jenisSasaranFilter == 'Semua Jenis Sasaran')
                            <td>
                                @if ($jenisSasaran == 3 && $pendaftaran->tanggal_lahir)
                                    @php
                                        $lahir = \Carbon\Carbon::parse($pendaftaran->tanggal_lahir);
                                        $now = \Carbon\Carbon::now();
                                        $umurTahun = intval($lahir->diffInYears($now));
                                    @endphp
                                    {{ $umurTahun }}
                                @else
                                    -
                                @endif
                            </td>
                        @endif

                        <td>{{ $item->berat_badan }} kg</td>

                        {{-- Data Ibu Hamil --}}
                        @if ($jenisSasaranFilter == 'Ibu Hamil' || $jenisSasaranFilter == 'Semua Jenis Sasaran')
                            <td @if ($tekananDarahDanger) class="danger-value" @endif>
                                @if ($jenisSasaran == 1)
                                    {{ $item->tekanan_darah_sistolik }}/{{ $item->tekanan_darah_diastolik }} mmHg
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($jenisSasaran == 1)
                                    {{ $item->lingkar_lengan }} cm
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($jenisSasaran == 1)
                                    @if ($item->kelas_ibu_hamil == 1)
                                        Ya
                                    @elseif ($item->kelas_ibu_hamil == 2)
                                        Tidak
                                    @else
                                        -
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($jenisSasaran == 1)
                                    @if ($item->mt_bumil_kek == 1)
                                        Ya
                                    @elseif ($item->mt_bumil_kek == 2)
                                        Tidak
                                    @else
                                        -
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                        @endif

                        {{-- Data Balita --}}
                        @if ($jenisSasaranFilter == 'Balita' || $jenisSasaranFilter == 'Semua Jenis Sasaran')
                            <td>
                                @if ($jenisSasaran == 2)
                                    {{ $item->tinggi_badan ?? $item->panjang_badan }} cm
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($jenisSasaran == 2)
                                    {{ $item->lingkar_kepala }} cm
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($jenisSasaran == 2)
                                    @if ($item->asi_eksklusif)
                                        Ya
                                    @else
                                        Tidak
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($jenisSasaran == 2)
                                    @if ($item->mp_asi)
                                        Ya
                                    @else
                                        Tidak
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($jenisSasaran == 2)
                                    @if ($item->mt_pangan_pemulihan)
                                        Ya
                                    @else
                                        Tidak
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($jenisSasaran == 2)
                                    {{ $item->catatan_kesehatan ?? '-' }}
                                @else
                                    -
                                @endif
                            </td>
                        @endif

                        {{-- Data Usia Produktif dan Lansia --}}
                        @if ($jenisSasaranFilter == 'Usia Produktif dan Lansia' || $jenisSasaranFilter == 'Semua Jenis Sasaran')
                            <td @if ($tekananDarahDanger) class="danger-value" @endif>
                                @if ($jenisSasaran == 3)
                                    {{ $item->tekanan_darah_sistolik }}/{{ $item->tekanan_darah_diastolik }} mmHg
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($jenisSasaran == 3)
                                    {{ $item->lingkar_perut }} cm
                                @else
                                    -
                                @endif
                            </td>
                            <td @if ($gulaDarahDanger) class="danger-value" @endif>
                                @if ($jenisSasaran == 3)
                                    {{ $item->gula_darah }} mg/dL
                                @else
                                    -
                                @endif
                            </td>
                            <td @if ($kolesterolDanger) class="danger-value" @endif>
                                @if ($jenisSasaran == 3)
                                    {{ $item->kolestrol }} mg/dL
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($jenisSasaran == 3)
                                    @if ($item->tes_mata_kanan || $item->tes_mata_kiri)
                                        {{ $item->tes_mata_kanan == 1 ? 'N' : ($item->tes_mata_kanan == 2 ? 'TN' : '-') }}
                                        /
                                        {{ $item->tes_mata_kiri == 1 ? 'N' : ($item->tes_mata_kiri == 2 ? 'TN' : '-') }}
                                    @else
                                        -
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($jenisSasaran == 3)
                                    @if ($item->tes_telinga_kanan || $item->tes_telinga_kiri)
                                        {{ $item->tes_telinga_kanan == 1 ? 'N' : ($item->tes_telinga_kanan == 2 ? 'TN' : '-') }}
                                        /
                                        {{ $item->tes_telinga_kiri == 1 ? 'N' : ($item->tes_telinga_kiri == 2 ? 'TN' : '-') }}
                                    @else
                                        -
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                        @endif
                        <td>{{ $item->keluhan ?? '-' }}</td>
                        <td>{{ $item->edukasi ?? '-' }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ date('d-m-Y H:i:s') }}</p>
    </div>
</body>

</html>
