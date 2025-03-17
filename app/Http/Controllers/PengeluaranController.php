<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use App\Models\Akun;

class PengeluaranController extends Controller
{
    public function index()
    {
        $pengeluaran = Pengeluaran::with('akun')->orderByDesc('id')->get();
        return view('pengeluaran.index', compact('pengeluaran'));
    }
    
    public function create()
    {
        // Generate kode pengeluaran otomatis dari model
        $kode_pengeluaran = Pengeluaran::generateKodePengeluaran();

        // Ambil semua akun kecuali 'Kas'
        $akun = Akun::where('nama_akun', '!=', 'Kas')->get();

        return view('pengeluaran.create', compact('akun', 'kode_pengeluaran'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'akun_id' => 'required|exists:akun,id',
            'deskripsi' => 'required|string',
            'jumlah' => 'required',
        ]);

        Pengeluaran::create([
            'kode_pengeluaran' => Pengeluaran::generateKodePengeluaran(), 
            'tanggal' => $request->tanggal,
            'akun_id' => $request->akun_id,
            'deskripsi' => $request->deskripsi,
            'jumlah' => str_replace(['Rp', '.', ','], '', $request->jumlah), // Pastikan hanya angka yang tersimpan
        ]);

        return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil ditambahkan');
    }

    public function edit(Pengeluaran $pengeluaran)
    {
        $akun = Akun::where('nama_akun', '!=', 'Kas')->get();
        return view('pengeluaran.edit', compact('pengeluaran', 'akun'));
    }

    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'akun_id' => 'required|exists:akun,id',
            'deskripsi' => 'required|string',
            'jumlah' => 'required',
        ]);

        $pengeluaran->update($request->only(['tanggal', 'akun_id', 'deskripsi', 'jumlah']));

        return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil diperbarui');
    }

    public function destroy(Pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();
        return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil dihapus');
    }
}