<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staff = Staff::all();
        return view('staff.view', compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.create', [
            'kode_staff' => Staff::getKodeStaff()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_staff' => 'required|unique:staff,kode_staff',
            'nama_staff' => 'required|max:255',
            'jenis_kelamin' => 'required|max:255',
            'alamat' => 'required|max:255',
            'no_telepon' => 'required|max:255',
            'email_staff' => 'required|email|unique:staff,email_staff',
            'kategori_staff' => 'required'
        ]);

        Staff::create($validated);

        return redirect()->route('staff.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        return view('staff.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'kode_staff' => 'required|unique:staff,kode_staff,' . $staff->id,
            'nama_staff' => 'required|max:255',
            'jenis_kelamin' => 'required|max:255',
            'alamat' => 'required|max:255',
            'no_telepon' => 'required|max:255',
            'email_staff' => 'required|email|unique:staff,email_staff,' . $staff->id,
            'kategori_staff' => 'required'
        ]);

        $staff->update($validated);

        return redirect()->route('staff.index')->with('success', 'Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Staff $staff)
    // {
    //     if (!$staff) {
    //         return redirect()->route('staff.index')->with('error', 'Data tidak ditemukan');
    //     }
    
    //     $staff->delete();
    //     return redirect()->route('staff.index')->with('success', 'Data berhasil dihapus');
    // }
}