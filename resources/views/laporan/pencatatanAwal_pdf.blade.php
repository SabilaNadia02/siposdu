<!DOCTYPE html>
<html>

<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 0;
            padding: 10px;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 1px solid #000;
            padding-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            padding: 0;
            font-size: 16px;
            font-weight: bold;
        }

        .filter-info {
            margin-bottom: 10px;
            padding: 5px;
            background-color: #f5f5f5;
            border-radius: 3px;
            font-size: 9px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            font-size: 9px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }

        .footer {
            margin-top: 10px;
            text-align: right;
            font-size: 8px;
            color: #555;
        }

        .no-data {
            text-align: center;
            padding: 10px;
            font-style: italic;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    @php
        $dataIbuHamil = $data->filter(fn($item) => optional($item->pendaftaran)->jenis_sasaran == 1);
        $dataBalita = $data->filter(fn($item) => optional($item->pendaftaran)->jenis_sasaran == 2);
        $dataLansia = $data->filter(fn($item) => optional($item->pendaftaran)->jenis_sasaran == 3);
        $showAll = $jenisSasaranFilter == 'Semua Jenis Sasaran';

        // Function to calculate age in years for ibu hamil
        function calculateIbuHamilAge($tanggalLahir)
        {
            if (!$tanggalLahir) {
                return '-';
            }
            $birthDate = new DateTime($tanggalLahir);
            $today = new DateTime();
            $age = $today->diff($birthDate);
            return $age->y . ' tahun';
        }

        // Function to calculate age in years, months, days for balita
        function calculateBalitaAge($tanggalLahir)
        {
            if (!$tanggalLahir) {
                return '-';
            }
            $birthDate = new DateTime($tanggalLahir);
            $today = new DateTime();
            $age = $today->diff($birthDate);
            return $age->y . ' tahun ' . $age->m . ' bulan ' . $age->d . ' hari';
        }

        // Function to calculate age in years for lansia
        function calculateLansiaAge($tanggalLahir)
        {
            if (!$tanggalLahir) {
                return '-';
            }
            $birthDate = new DateTime($tanggalLahir);
            $today = new DateTime();
            $age = $today->diff($birthDate);
            return $age->y . ' tahun';
        }
    @endphp

    <div class="header">
        <h1>{{ $title }}</h1>
        <p>Posyandu ILP Desa Jambean</p>
        <p>Periode: {{ date('d/m/Y', strtotime($startDate)) }} - {{ date('d/m/Y', strtotime($endDate . ' -1 day')) }}
        </p>
    </div>

    <div class="filter-info">
        <p><strong>Filter yang digunakan:</strong></p>
        <p>• Posyandu: {{ $posyanduFilter }}</p>
        <p>• Jenis Sasaran: {{ $jenisSasaranFilter }}</p>
    </div>

    @if ($data->isEmpty())
        <p class="no-data">Tidak ada data yang ditemukan</p>
    @else
        @if (($jenisSasaranFilter == 'Ibu Hamil' || $showAll) && $dataIbuHamil->isNotEmpty())
            <h3 style="margin: 5px 0; font-size: 11px;">Data Ibu Hamil</h3>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Ibu</th>
                        <th>NIK</th>
                        <th>HPHT</th>
                        <th>HTP</th>
                        <th>Usia Kehamilan (Minggu)</th>
                        <th>Usia Ibu</th>
                        <th>Nama Suami</th>
                        <th>Hamil Ke</th>
                        <th>Jarak Anak</th>
                        <th>Tinggi Badan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataIbuHamil as $item)
                        <tr>
                            <td align="center">{{ $loop->iteration }}</td>
                            <td>{{ optional($item->pendaftaran)->nama ?? '-' }}</td>
                            <td>{{ optional($item->pendaftaran)->nik ?? '-' }}</td>
                            <td>{{ $item->hpht ? date('d/m/Y', strtotime($item->hpht)) : '-' }}</td>
                            <td>{{ $item->htp ? date('d/m/Y', strtotime($item->htp)) : '-' }}</td>
                            <td align="center">{{ $item->usia_kehamilan ?? '-' }}</td>
                            <td align="center">{{ calculateIbuHamilAge(optional($item->pendaftaran)->tanggal_lahir) }}
                            </td>
                            <td>{{ $item->nama_suami ?? '-' }}</td>
                            <td align="center">{{ $item->hamil_ke ?? '-' }}</td>
                            <td align="center">{{ $item->jarak_anak ?? '-' }}</td>
                            <td align="center">{{ $item->tinggi_badan ? $item->tinggi_badan . ' cm' : '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($showAll && ($dataBalita->isNotEmpty() || $dataLansia->isNotEmpty()))
                <div class="page-break"></div>
            @endif
        @elseif ($jenisSasaranFilter == 'Ibu Hamil' && $dataIbuHamil->isEmpty())
            <p class="no-data">Tidak ada data Ibu Hamil yang ditemukan</p>
        @endif

        @if (($jenisSasaranFilter == 'Balita' || $showAll) && $dataBalita->isNotEmpty())
            <h3 style="margin: 10px 0 5px 0; font-size: 11px;">Data Balita</h3>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Balita</th>
                        <th>NIK</th>
                        <th>Nama Ibu</th>
                        <th>Nama Ayah</th>
                        <th>Tanggal Lahir</th>
                        <th>Umur (Tahun, Bulan, Hari)</th>
                        <th>Berat Lahir</th>
                        <th>Panjang Lahir</th>
                        <th>Status Balita</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataBalita as $item)
                        <tr>
                            <td align="center">{{ $loop->iteration }}</td>
                            <td>{{ optional($item->pendaftaran)->nama ?? '-' }}</td>
                            <td>{{ optional($item->pendaftaran)->nik ?? '-' }}</td>
                            <td>{{ $item->nama_ibu ?? '-' }}</td>
                            <td>{{ $item->nama_ayah ?? '-' }}</td>
                            <td align="center">
                                {{ optional($item->pendaftaran)->tanggal_lahir ? date('d/m/Y', strtotime($item->pendaftaran->tanggal_lahir)) : '-' }}
                            </td>
                            <td align="center">{{ calculateBalitaAge(optional($item->pendaftaran)->tanggal_lahir) }}
                            </td>
                            <td align="center">{{ $item->berat_badan_lahir ? $item->berat_badan_lahir . ' kg' : '-' }}
                            </td>
                            <td align="center">
                                {{ $item->panjang_badan_lahir ? $item->panjang_badan_lahir . ' cm' : '-' }}</td>
                            <td align="center">{{ $item->status_balita == 1 ? 'Aktif' : 'Lulus' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($showAll && $dataLansia->isNotEmpty())
                <div class="page-break"></div>
            @endif
        @elseif ($jenisSasaranFilter == 'Balita' && $dataBalita->isEmpty())
            <p class="no-data">Tidak ada data Balita yang ditemukan</p>
        @endif

        @if (($jenisSasaranFilter == 'Usia Produktif dan Lansia' || $showAll) && $dataLansia->isNotEmpty())
            <h3 style="margin: 10px 0 5px 0; font-size: 11px;">Data Usia Produktif dan Lansia</h3>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lansia</th>
                        <th>NIK</th>
                        <th>Tanggal Lahir</th>
                        <th>Umur (Tahun)</th>
                        <th>Riwayat Keluarga</th>
                        <th>Riwayat Diri Sendiri</th>
                        <th>Perilaku Berisiko</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataLansia as $item)
                        <tr>
                            <td align="center">{{ $loop->iteration }}</td>
                            <td>{{ optional($item->pendaftaran)->nama ?? '-' }}</td>
                            <td>{{ optional($item->pendaftaran)->nik ?? '-' }}</td>
                            <td align="center">
                                {{ optional($item->pendaftaran)->tanggal_lahir ? date('d/m/Y', strtotime($item->pendaftaran->tanggal_lahir)) : '-' }}
                            </td>
                            <td align="center">{{ calculateLansiaAge(optional($item->pendaftaran)->tanggal_lahir) }}
                            </td>
                            <td>
                                @php $riwayatKeluarga = json_decode($item->riwayat_keluarga, true); @endphp
                                {{ is_array($riwayatKeluarga) ? implode(', ', $riwayatKeluarga) : '-' }}
                            </td>
                            <td>
                                @php $riwayatDiri = json_decode($item->riwayat_diri_sendiri, true); @endphp
                                {{ is_array($riwayatDiri) ? implode(', ', $riwayatDiri) : '-' }}
                            </td>
                            <td>
                                @php $perilaku = json_decode($item->perilaku_berisiko, true); @endphp
                                {{ is_array($perilaku) ? implode(', ', $perilaku) : '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @elseif ($jenisSasaranFilter == 'Usia Produktif dan Lansia' && $dataLansia->isEmpty())
            <p class="no-data">Tidak ada data Usia Produktif dan Lansia yang ditemukan</p>
        @endif
    @endif

    <div class="footer">
        Dicetak pada: {{ date('d/m/Y H:i:s') }}
    </div>
</body>

</html>
