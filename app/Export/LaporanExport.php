<?php

namespace App\Exports;

use App\Models\Pengeluaran;
use App\Models\SaldoAwal;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanExport implements FromView
{
    protected $bulan, $tahun;

    public function __construct($bulan, $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function view(): View
    {
        $saldo_awal = SaldoAwal::whereYear('tanggal', $this->tahun)
                                ->whereMonth('tanggal', $this->bulan)
                                ->get();
        $total_debit = $saldo_awal->sum('jumlah');

        $pengeluaran = Pengeluaran::whereYear('tanggal', $this->tahun)
                                  ->whereMonth('tanggal', $this->bulan)
                                  ->with('akun')
                                  ->get();
        $total_kredit = $pengeluaran->sum('jumlah');
        $sisa_saldo = $total_debit - $total_kredit;

        return view('laporan.excel', compact('saldo_awal', 'pengeluaran', 'total_debit', 'total_kredit', 'sisa_saldo', 'bulan', 'tahun'));
    }
}