<!DOCTYPE html>
<html>

<head>
    <title>Laporan Keuangan - {{ $bulan }} {{ $tahun }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }

        h2,
        h3 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>Laporan Keuangan Kas</h2>
    <h3>Periode {{ date('F Y', strtotime("$tahun-$bulan-01")) }}</h3>

    <table>
        <tr>
            <th>ID</th>
            <th>Tanggal</th>
            <th>Akun</th>
            <th>Keterangan</th>
            <th class="right">DEBIT</th>
            <th class="right">KREDIT</th>
        </tr>

        @foreach ($laporan as $item)
            <tr>
                <td>{{ $item['id'] }}</td>
                <td>{{ date('d M Y', strtotime($item['tanggal'])) }}</td>
                <td>{{ $item['akun'] }}</td>
                <td>{{ $item['deskripsi'] }}</td>
                <td class="right">
                    {{ $item['debit'] > 0 ? 'Rp ' . number_format($item['debit'], 0, ',', '.') : '-' }}
                </td>
                <td class="right">
                    {{ $item['kredit'] > 0 ? 'Rp ' . number_format($item['kredit'], 0, ',', '.') : '-' }}
                </td>
            </tr>
        @endforeach

        <tr class="bold">
            <td colspan="4" class="right">Total:</td>
            <td class="right">Rp {{ number_format($total_debit, 0, ',', '.') }}</td>
            <td class="right">Rp {{ number_format($total_kredit, 0, ',', '.') }}</td>
        </tr>
        <tr class="bold">
            <td colspan="4" class="right">Sisa Saldo:</td>
            <td colspan="2" class="right">Rp {{ number_format($sisa_saldo, 0, ',', '.') }}</td>
        </tr>
    </table>
</body>

</html>
