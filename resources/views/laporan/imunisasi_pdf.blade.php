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
            <p>• Jenis Sasaran: Balita</p>
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th width="3%">No</th>
                <th width="20%">Nama Balita</th>
                <th width="20%">NIK</th>
                <th width="10%">Usia Saat Imunisasi</th>
                <th width="20%">Jenis Imunisasi</th>
                <th width="30%">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                @php
                    // Hitung usia balita saat imunisasi
                    $usia = '-';
                    if ($item->pendaftaran->tanggal_lahir && $item->waktu_pemberian) {
                        $birthDate = new DateTime($item->pendaftaran->tanggal_lahir);
                        $imunisasiDate = new DateTime($item->waktu_pemberian);
                        $interval = $birthDate->diff($imunisasiDate);

                        $usia = '';
                        if ($interval->y > 0) {
                            $usia .= $interval->y . ' tahun ';
                        }
                        if ($interval->m > 0) {
                            $usia .= $interval->m . ' bulan ';
                        }
                        if ($interval->d > 0 && $interval->y == 0) {
                            $usia .= $interval->d . ' hari';
                        }
                        $usia = trim($usia);
                    }
                @endphp
                <tr>
                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                    <td>{{ $item->pendaftaran->nama ?? '-' }}</td>
                    <td>{{ $item->pendaftaran->nik ?? '-' }}</td>
                    <td>{{ $usia }}</td>
                    <td>{{ $item->imunisasi->nama ?? '-' }}</td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="no-data">Tidak ada data pemberian imunisasi yang ditemukan</td>
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
