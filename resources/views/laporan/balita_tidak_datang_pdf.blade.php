<!DOCTYPE html>
<html>

<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
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
            font-size: 18px;
            font-weight: bold;
        }

        .header p {
            margin: 3px 0;
            padding: 0;
        }

        .filter-info {
            margin-bottom: 10px;
            padding: 5px;
            background-color: #f5f5f5;
            border-radius: 3px;
        }

        .filter-info p {
            margin: 2px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            page-break-inside: auto;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px;
            text-align: left;
            font-size: 11px;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: #777;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            margin: 20px 0;
        }

        .footer {
            margin-top: 10px;
            text-align: right;
            font-size: 8px;
            color: #555;
        }

        .text-center {
            text-align: center;
        }

        .whatsapp-link {
            color: #0d6efd;
            text-decoration: underline;
        }

        .chat-template {
            display: none;
            font-size: 10px;
            color: #666;
            margin-top: 3px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>{{ $title }}</h1>
        <p>Posyandu ILP Desa Jambean</p>
        <p>Periode: {{ date('d/m/Y', strtotime($startDate)) }} - {{ date('d/m/Y', strtotime($endDate)) }}</p>
    </div>

    <div class="filter-info">
        <p><strong>Filter yang digunakan:</strong></p>
        <p>• Posyandu: {{ $posyanduFilter }}</p>
        <p>• Jenis Sasaran: {{ $jenisSasaranFilter }}</p>
    </div>

    @if ($data->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Tanggal Lahir</th>
                    <th>Usia</th>
                    <th>No Telepon</th>
                    <th>Keterangan</th>
                    <th>Terakhir Kunjung</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    @php
                        $pendaftaran = $item->pendaftaran;
                        $tanggalLahir = new DateTime($pendaftaran->tanggal_lahir);
                        $tanggalSekarang = new DateTime();
                        $usia = $tanggalLahir->diff($tanggalSekarang);

                        $usiaText = $usia->y . ' tahun';
                        if ($usia->y == 0 || $pendaftaran->jenis_sasaran == 2) {
                            $usiaText = $usia->m . ' bulan';
                            if ($usia->y > 0) {
                                $usiaText = $usia->y . ' tahun, ' . $usiaText;
                            }
                        }

                        $noHp = $pendaftaran->no_hp ?? null;
                        $namaPosyandu = $pendaftaran->posyandus->nama ?? 'Posyandu';
                        $bulanPeriode = date('F Y', strtotime($startDate));

                        // Cari kunjungan terakhir jika ada
                        $lastVisit = $item->pencatatanKunjungan()->orderBy('waktu_pencatatan', 'desc')->first();
                        $lastVisitDate = $lastVisit
                            ? date('d/m/Y', strtotime($lastVisit->waktu_pencatatan))
                            : 'Belum pernah';

                        $noHp = $pendaftaran->no_hp ?? null;
                        $whatsappLink = $noHp
                            ? 'https://wa.me/' .
                                preg_replace('/[^0-9]/', '', $noHp) .
                                '?text=' .
                                rawurlencode($item->whatsapp_message)
                            : '#';
                    @endphp
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $pendaftaran->nama }}</td>
                        <td>{{ $pendaftaran->nik }}</td>
                        <td>{{ date('d/m/Y', strtotime($pendaftaran->tanggal_lahir)) }}</td>
                        <td>{{ $usiaText }}</td>
                        <td>
                            @if ($noHp)
                                <a href="{{ $whatsappLink }}" class="whatsapp-link" target="_blank"
                                    rel="noopener noreferrer">
                                    {{ $noHp }}
                                </a>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @switch($pendaftaran->jenis_sasaran)
                                @case(1)
                                    Ibu Hamil
                                @break

                                @case(2)
                                    Balita
                                @break

                                @case(3)
                                    {{ $usia->y >= 60 ? 'Lansia' : 'Usia Produktif' }}
                                @break
                            @endswitch
                        </td>
                        <td>{{ $lastVisitDate }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-data">
            Tidak ada data peserta yang tidak kunjung pada periode ini.
        </div>
    @endif

    <div class="footer">
        Dicetak pada: {{ date('d/m/Y H:i:s') }}
    </div>
</body>

</html>
