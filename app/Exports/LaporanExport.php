<?php
namespace App\Exports;

use App\Models\Pengeluaran;
use App\Models\SaldoAwal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class LaporanExport implements FromCollection, WithHeadings
{
    protected $bulan, $dari_tahun, $sampai_tahun;

    public function __construct($bulan, $dari_tahun, $sampai_tahun)
    {
        $this->bulan = $bulan;
        $this->dari_tahun = $dari_tahun;
        $this->sampai_tahun = $sampai_tahun;
    }

    public function collection()
{
    // Pastikan variabel tahun tidak null
    $dari_tahun = $this->dari_tahun ?? date('Y');
    $sampai_tahun = $this->sampai_tahun ?? date('Y');
    $bulan = $this->bulan ?? date('m');

    // Ambil data saldo awal
    $saldo_awal = SaldoAwal::when($dari_tahun, function ($query) use ($dari_tahun) {
            return $query->whereYear('tanggal', '>=', $dari_tahun);
        })
        ->when($sampai_tahun, function ($query) use ($sampai_tahun) {
            return $query->whereYear('tanggal', '<=', $sampai_tahun);
        })
        ->get()
        ->map(function ($item) {
            return [
                'ID' => $item->kode_saldo,
                'Tanggal' => $item->tanggal,
                'Akun' => 'Saldo Awal',
                'Keterangan' => $item->deskripsi,
                'Debit' => $item->jumlah,
                'Kredit' => '-',
            ];
        });

    // Ambil data pengeluaran
    $pengeluaran = Pengeluaran::when($bulan, function ($query) use ($bulan) {
            return $query->whereMonth('tanggal', '=', $bulan);
        })
        ->when($dari_tahun, function ($query) use ($dari_tahun) {
            return $query->whereYear('tanggal', '>=', $dari_tahun);
        })
        ->when($sampai_tahun, function ($query) use ($sampai_tahun) {
            return $query->whereYear('tanggal', '<=', $sampai_tahun);
        })
        ->get()
        ->map(function ($item) {
            return [
                'ID' => $item->kode_pengeluaran,
                'Tanggal' => $item->tanggal,
                'Akun' => $item->akun->nama_akun,
                'Keterangan' => $item->deskripsi,
                'Debit' => '-',
                'Kredit' => $item->jumlah,
            ];
        });

    // Gabungkan saldo awal dan pengeluaran
    return collect(array_merge($saldo_awal->toArray(), $pengeluaran->toArray()));
}


    public function headings(): array
    {
        return ['ID', 'Tanggal', 'Akun', 'Keterangan', 'Debit', 'Kredit'];
    }
}