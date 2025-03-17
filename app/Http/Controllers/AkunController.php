<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $akun = Akun::all();
        return view('akun.view', compact('akun'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kodeAkun = Akun::getKodeAkun(); // Generate kode_akun otomatis
        return view('akun.create', compact('kodeAkun'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_akun' => 'required|unique:akun,nama_akun|max:255',
            'header_akun' => 'required',
            'db_cr' => 'required',
        ]);

        // Simpan data dengan kode_akun yang dibuat otomatis dari model
        Akun::create([
            'kode_akun' => Akun::getKodeAkun(),
            'nama_akun' => $validated['nama_akun'],
            'header_akun' => $validated['header_akun'],
            'db_cr' => $validated['db_cr'],
        ]);

        return redirect()->route('akun.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Akun $akun)
    {
        return view('akun.edit', compact('akun'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Akun $akun)
    {
        $validated = $request->validate([
            'nama_akun' => 'required|unique:akun,nama_akun,' . $akun->id . '|max:255',
            'header_akun' => 'required',
            'db_cr' => 'required',
        ]);

        $akun->update($validated);

        return redirect()->route('akun.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
//     public function destroy(Akun $akun)
// {
//     if (!$akun) {
//         return redirect()->route('akun.index')->with('error', 'Data tidak ditemukan');
//     }

//     $akun->delete();
//     return redirect()->route('akun.index')->with('success', 'Data berhasil dihapus');
// }

}