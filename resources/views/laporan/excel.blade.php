<table>
    <tr>
        <th colspan="3">Laporan Bulanan - {{ $bulan }}/{{ $tahun }}</th>
    </tr>
    <tr>
        <td>Total Saldo Awal</td>
        <td colspan="2">Rp {{ number_format($total_debit, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <td>Total Pengeluaran</td>
        <td colspan="2">Rp {{ number_format($total_kredit, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <td><strong>Sisa Saldo</strong></td>
        <td colspan="2"><strong>Rp {{ number_format($sisa_saldo, 0, ',', '.') }}</strong></td>
    </tr>
    <tr>
        <th>Tanggal</th>
        <th>Akun</th>
        <th>Jumlah</th>
    </tr>
    @foreach ($pengeluaran as $p)
        <tr>
            <td>{{ $p->tanggal }}</td>
            <td>{{ $p->akun->nama }}</td>
            <td>Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
        </tr>
    @endforeach
</table>
