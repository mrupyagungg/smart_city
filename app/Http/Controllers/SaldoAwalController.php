<?php

namespace App\Http\Controllers;

use App\Models\SaldoAwal;
use App\Models\Akun;
use Illuminate\Http\Request;

class SaldoAwalController extends Controller
{
    public function index()
    {
        $saldo = SaldoAwal::with('akun')->get();
        return view('saldo_awal.view', compact('saldo'));
    }

    public function create()
    {
        // Generate kode saldo baru
        $kode_saldo = SaldoAwal::getKodeSaldo();

        // Ambil hanya akun "Kas"
        $akun = Akun::where('nama_akun', 'Kas')->first();

        // Jika akun "Kas" tidak ditemukan, kembali dengan error
        if (!$akun) {
            return redirect()->back()->withErrors(['akun' => 'Akun "Kas" tidak ditemukan.']);
        }

        return view('saldo_awal.create', compact('kode_saldo', 'akun'));
    }

    /**
     * Simpan saldo awal ke dalam database.
     */
    public function store(Request $request)
    {
        // Hapus format mata uang dari input jumlah
        $jumlah = str_replace(['Rp', '.', ','], '', $request->jumlah);

        // Validasi input
        $request->validate([
            'tanggal' => 'required|date',
            'akun_id' => 'required|exists:akun,id',
            'deskripsi' => 'required|string',
            'jumlah' => 'required',
        ]);

        // Pastikan hanya akun "Kas" yang bisa dipilih
        $akun = Akun::find($request->akun_id);
        if (!$akun || $akun->nama_akun !== 'Kas') {
            return back()->withErrors(['akun_id' => 'Hanya akun "Kas" yang diperbolehkan.']);
        }

        // Simpan data saldo awal
        SaldoAwal::create([
            'kode_saldo' => $request->kode_saldo,
            'tanggal' => $request->tanggal,
            'akun_id' => $request->akun_id,
            'deskripsi' => $request->deskripsi,
            'jumlah' => number_format($jumlah, 2, '.', ''), // Format jumlah ke angka desimal
            'posisi_db_cr' => 'debit',
        ]);

        return redirect()->route('saldo_awal.index')->with('success', 'Saldo Awal berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $saldo_awal = SaldoAwal::findOrFail($id);
        $akun = Akun::all();
        return view('saldo_awal.edit', compact('saldo_awal', 'akun'));
    }

    public function update(Request $request, $id)
    {
        $saldo_awal = SaldoAwal::findOrFail($id);

        // Pastikan jumlah tetap dalam format angka
        $jumlah = str_replace(['Rp', '.', ','], '', $request->jumlah);
        if (!is_numeric($jumlah)) {
            return back()->withErrors(['jumlah' => 'Format jumlah tidak valid.']);
        }

        $request->validate([
            'tanggal' => 'required|date',
            'akun_id' => 'required|exists:akun,id',
            'deskripsi' => 'required',
            'jumlah' => 'required|numeric|min:0',
        ]);

        // Pastikan posisi debit/kredit diperbarui sesuai akun
        $akun = Akun::findOrFail($request->akun_id);
        $posisi_db_cr = ($akun->nama_akun == 'Kas') ? 'debit' : 'kredit';

        $saldo_awal->update([
            'tanggal' => $request->tanggal,
            'akun_id' => $request->akun_id,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $jumlah,
            'posisi_db_cr' => $posisi_db_cr,
        ]);

        return redirect()->route('saldo_awal.index')->with('success', 'Saldo Awal berhasil diperbarui');
    }

    public function destroy(SaldoAwal $saldo_awal)
    {
        $saldo_awal->delete();
        return redirect()->route('saldo_awal.index')->with('success', 'Saldo Awal berhasil dihapus');
    }
}