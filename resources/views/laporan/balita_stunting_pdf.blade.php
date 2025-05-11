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

    @include('laporan.partials.filter_info')

    <table>
        <thead>
            <tr>
                <th width="3%">No</th>
                <th width="15%">Nama Balita</th>
                <th width="12%">NIK</th>
                <th width="10%">Usia</th>
                <th width="10%">Berat Badan</th>
                <th width="10%">Tinggi Badan</th>
                <th width="10%">Status Gizi</th>
                <th width="15%">Tanggal Kunjungan</th>
                <th width="15%">Intervensi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                @php
                    $latestKunjungan = $item->pencatatanKunjungan->first();
                @endphp
                <tr>
                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                    <td>{{ $item->pendaftaran->nama ?? '-' }}</td>
                    <td>{{ $item->pendaftaran->nik ?? '-' }}</td>
                    <td>{{ $item->getAgeString() }}</td>
                    <td>{{ $latestKunjungan->berat_badan ?? '-' }} kg</td>
                    <td>{{ $latestKunjungan->tinggi_badan ?? '-' }} cm</td>
                    <td>
                        <span class="stunting-badge">STUNTING</span>
                    </td>
                    <td>{{ $latestKunjungan ? date('d/m/Y', strtotime($latestKunjungan->waktu_pencatatan)) : '-' }}
                    </td>
                    <td>{{ $latestKunjungan->catatan_kesehatan ?? 'Belum ada intervensi' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="no-data">Tidak ada balita stunting dalam periode ini</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @include('laporan.partials.footer')
</body>

</html>
