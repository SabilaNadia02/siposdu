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
        <p>• Jenis Sasaran: Balita</p>
    </div>

    @if ($data->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Balita</th>
                    <th>NIK</th>
                    <th>Nama Ibu</th>
                    <th>Tanggal Lahir</th>
                    <th>Usia</th>
                    <th>No Telepon</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    @php
                        $tanggalLahir = new DateTime($item->pendaftaran->tanggal_lahir);
                        $tanggalSekarang = new DateTime();
                        $usia = $tanggalLahir->diff($tanggalSekarang);
                        $usiaText = $usia->y . ' tahun';
                        if ($usia->m > 0) {
                            $usiaText .= ', ' . $usia->m . ' bulan';
                        }

                        // Format nomor HP untuk WhatsApp
                        $noHp = $item->pendaftaran->no_hp ?? null;

                        // Data untuk template chat
                        $namaPosyandu = $item->pendaftaran->posyandus->nama ?? 'Posyandu';
                        $namaIbu = $item->nama_ibu ?? 'Bunda';
                        $namaBalita = $item->pendaftaran->nama ?? 'Ananda';
                        $bulanPeriode = date('F Y', strtotime($startDate));

                        // Template pesan WhatsApp
                        $message = rawurlencode(
                            "$namaPosyandu - Pemberitahuan Kunjungan Posyandu\n\nYth. Bunda $namaIbu,\n\nKami dari $namaPosyandu ingin menginformasikan bahwa berdasarkan data kunjungan terakhir, ananda $namaBalita belum hadir dalam kegiatan Posyandu bulan $bulanPeriode.\n\nKami mengajak Bunda untuk membawa ananda ke Posyandu agar tumbuh kembangnya dapat terus dipantau dan mendapatkan layanan kesehatan yang dibutuhkan.\n\nJika Bunda berhalangan hadir, silakan hubungi kader Posyandu atau petugas setempat untuk informasi lebih lanjut.\n\nTerima kasih atas perhatian dan kerja samanya.\n\nSalam sehat,\nTim $namaPosyandu",
                        );

                        $whatsappLink = $noHp
                            ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $noHp) . '?text=' . $message
                            : '#';
                    @endphp
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->pendaftaran->nama }}</td>
                        <td>{{ $item->pendaftaran->nik }}</td>
                        <td>{{ $item->nama_ibu }}</td>
                        <td>{{ date('d/m/Y', strtotime($item->pendaftaran->tanggal_lahir)) }}</td>
                        <td>{{ $usiaText }}</td>
                        <td>
                            @if ($noHp)
                                <a href="{{ $whatsappLink }}" class="whatsapp-link" target="_blank">
                                    {{ $noHp }}
                                </a>
                                <div class="chat-template">
                                    Template Chat:<br>
                                    {{ $namaPosyandu }} - Pemberitahuan Kunjungan Posyandu<br><br>
                                    Yth. Bunda {{ $namaIbu }},<br><br>
                                    Kami dari {{ $namaPosyandu }} ingin menginformasikan bahwa berdasarkan data
                                    kunjungan terakhir, ananda {{ $namaBalita }} belum hadir dalam kegiatan Posyandu
                                    bulan {{ $bulanPeriode }}.<br><br>
                                    Kami mengajak Bunda untuk membawa ananda ke Posyandu agar tumbuh kembangnya dapat
                                    terus dipantau dan mendapatkan layanan kesehatan yang dibutuhkan.<br><br>
                                    Jika Bunda berhalangan hadir, silakan hubungi kader Posyandu atau petugas setempat
                                    untuk informasi lebih lanjut.<br><br>
                                    Terima kasih atas perhatian dan kerja samanya.<br><br>
                                    Salam sehat,<br>
                                    Tim {{ $namaPosyandu }}
                                </div>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-data">
            Tidak ada data balita yang tidak kunjung pada periode ini.
        </div>
    @endif

    <div class="footer">
        Dicetak pada: {{ date('d/m/Y H:i:s') }}
    </div>
</body>

</html>
