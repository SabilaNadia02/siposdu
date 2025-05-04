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

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
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
            color: #777;
        }
    </style>
</head>

<body>
    @php
        $jenisSasaranList = [
            1 => 'Ibu Hamil',
            2 => 'Balita',
            3 => 'Usia Produktif dan Lansia',
        ];
    @endphp

    <div class="header">
        <h1>{{ $title }}</h1>
        <p>Posyandu ILP Desa Jambean</p>
        <p>Periode: {{ date('d/m/Y', strtotime($startDate)) }} - {{ date('d/m/Y', strtotime($endDate)) }}</p>
    </div>

    @if (isset($posyanduFilter) || isset($jenisSasaranFilter))
        <div class="filter-info">
            <p><strong>Filter yang digunakan:</strong></p>
            @if (isset($posyanduFilter))
                <p>• Posyandu: {{ $posyanduFilter }}</p>
            @endif
            @if (isset($jenisSasaranFilter))
                <p>• Jenis Sasaran: {{ $jenisSasaranFilter }}</p>
            @elseif(in_array($jenis, ['imunisasi', 'kelulusan']))
                <p>• Jenis Sasaran: Balita (otomatis)</p>
            @endif
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Penerima</th>
                <th>NIK</th>
                <th>Nama Vitamin</th>
                <th>Dosis</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                @php
                    $vitaminData = json_decode($item->data, true) ?? [];
                    $sasaran = $jenisSasaranOptions[$item->pendaftaran->jenis_sasaran] ?? '-';
                @endphp

                @if (count($vitaminData) > 0)
                    @foreach ($vitaminData as $vitamin)
                        <tr>
                            @if ($loop->first)
                                <td rowspan="{{ count($vitaminData) }}">{{ $loop->parent->iteration }}</td>
                                <td rowspan="{{ count($vitaminData) }}">{{ $item->pendaftaran->nama }}</td>
                                <td rowspan="{{ count($vitaminData) }}">{{ $item->pendaftaran->nik }}</td>
                            @endif
                            <td>{{ $vitamins[$vitamin['id_vitamin']] ?? 'Vitamin Tidak Dikenal' }}</td>
                            <td>{{ $vitamin['dosis'] ?? '-' }}</td>
                            <td>{{ $item->keterangan ?? '-' }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->pendaftaran->nama }}</td>
                        <td>{{ $item->pendaftaran->nik }}</td>
                        <td>-</td>
                        <td>-</td>
                        <td>{{ $item->keterangan ?? '-' }}</td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="5" class="no-data">Tidak ada data yang ditemukan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ date('d/m/Y H:i:s') }} | Hal. <span class="pageNumber"></span> dari <span
            class="totalPages"></span>
    </div>

    <script type="text/javascript">
        // Add page numbers if the PDF has multiple pages
        var vars = {};
        var x = document.location.search.substring(1).split('&');
        for (var i in x) {
            var z = x[i].split('=', 2);
            vars[z[0]] = unescape(z[1]);
        }
        var x = ['frompage', 'topage', 'page', 'webpage', 'section', 'subsection', 'subsubsection'];
        for (var i in x) {
            var y = document.getElementsByClassName(x[i]);
            for (var j = 0; j < y.length; ++j) y[j].textContent = vars[x[i]];
        }
    </script>
</body>

</html>
