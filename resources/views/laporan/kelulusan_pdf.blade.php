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
    </style>
</head>

<body>
    <div class="header">
        <h1>{{ $title }}</h1>
        <p>Posyandu ILP Desa Jambean</p>
        <p>Periode: {{ date('d/m/Y', strtotime($startDate)) }} - {{ date('d/m/Y', strtotime($endDate)) }}</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (isset($posyanduFilter))
        <div class="filter-info">
            <p><strong>Filter yang digunakan:</strong></p>
            <p>• Posyandu: {{ $posyanduFilter }}</p>
            <p>• Jenis Sasaran: Balita</p>
        </div>
    @endif

    @if ($data->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Balita</th>
                    <th>NIK</th>
                    <th>Usia</th>
                    <th>Tanggal Kelulusan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    @php
                        $tanggalLahir = new DateTime($item->pendaftaran->tanggal_lahir);
                        $tanggalSekarang = new DateTime();
                        $usia = $tanggalLahir->diff($tanggalSekarang);
                        $usiaText = $usia->y . ' tahun, ' . $usia->m . ' bulan, ' . $usia->d . ' hari';
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->pendaftaran->nama }}</td>
                        <td>{{ $item->pendaftaran->nik }}</td>
                        <td>{{ $usiaText }}</td>
                        <td>{{ date('d/m/Y', strtotime($item->updated_at)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-data">
            Tidak ada data Balita LULUS yang ditemukan untuk periode yang dipilih.
        </div>
    @endif

    <div class="footer">
        Dicetak pada: {{ date('d/m/Y H:i:s') }}
    </div>
</body>

</html>
