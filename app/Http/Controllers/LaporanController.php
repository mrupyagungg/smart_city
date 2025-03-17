<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use App\Models\SaldoAwal;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanExport;
use PDF; // Import pustaka DomPDF

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan', Carbon::now()->month);
        $tahun = $request->input('tahun', Carbon::now()->year);

        // Ambil data saldo awal (debit)
        $saldo_awal = SaldoAwal::whereYear('tanggal', $tahun)
                                ->whereMonth('tanggal', $bulan)
                                ->get();
        $total_debit = $saldo_awal->sum('jumlah');

        // Ambil data pengeluaran (kredit)
        $pengeluaran = Pengeluaran::whereYear('tanggal', $tahun)
                                  ->whereMonth('tanggal', $bulan)
                                  ->with('akun')
                                  ->get();
        $total_kredit = $pengeluaran->sum('jumlah');

        // Hitung sisa saldo
        $sisa_saldo = $total_debit - $total_kredit;

        return view('laporan.index', compact(
            'saldo_awal', 'pengeluaran', 'total_debit', 
            'total_kredit', 'sisa_saldo', 'bulan', 'tahun'
        ));
    }

    public function cetakPDF(Request $request)
    {
        $bulan = $request->input('bulan', Carbon::now()->month);
        $tahun = $request->input('tahun', Carbon::now()->year);

        // Ambil data saldo awal sebagai debit
        $saldo_awal = SaldoAwal::whereYear('tanggal', $tahun)
                                ->whereMonth('tanggal', $bulan)
                                ->get();
        $total_debit = $saldo_awal->sum('jumlah');

        // Ambil data pengeluaran sebagai kredit
        $pengeluaran = Pengeluaran::whereYear('tanggal', $tahun)
                                  ->whereMonth('tanggal', $bulan)
                                  ->with('akun')
                                  ->get();
        $total_kredit = $pengeluaran->sum('jumlah');

        // Gabungkan saldo awal dan pengeluaran dalam satu koleksi
        $laporan = collect();

        // Tambahkan saldo awal sebagai debit
        foreach ($saldo_awal as $s) {
            $laporan->push([
                'id' => 'S-' . str_pad($s->id, 3, '0', STR_PAD_LEFT),
                'tanggal' => $s->tanggal,
                'akun' => 'Saldo Awal',
                'deskripsi' => $s->deskripsi,
                'debit' => $s->jumlah,
                'kredit' => 0,
            ]);
        }

        // Tambahkan pengeluaran sebagai kredit
        foreach ($pengeluaran as $p) {
            $laporan->push([
                'id' => 'PG-' . str_pad($p->id, 3, '0', STR_PAD_LEFT),
                'tanggal' => $p->tanggal,
                'akun' => $p->akun->nama_akun,
                'deskripsi' => $p->deskripsi,
                'debit' => 0,
                'kredit' => $p->jumlah,
            ]);
        }

        // Hitung sisa saldo
        $sisa_saldo = $total_debit - $total_kredit;

        // Buat PDF menggunakan tampilan laporan.pdf
        $pdf = PDF::loadView('laporan.pdf', [
            'laporan' => $laporan,
            'total_debit' => $total_debit,
            'total_kredit' => $total_kredit,
            'sisa_saldo' => $sisa_saldo,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);

        return $pdf->download('Laporan_Pengeluaran' . '_' . $bulan . '_' . $tahun . '.pdf');
    }

    
public function cetakExcel(Request $request)
{
    return Excel::download(new LaporanExport($request->bulan, $request->dari_tahun, $request->sampai_tahun), 'Laporan_Pengeluaran.xlsx');
}
    
}