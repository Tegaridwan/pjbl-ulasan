<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penjual;

class TambahPenjualController extends Controller
{
    public function index()
    {
        return view('tambah-penjual');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Nama_Penjual' => 'required|string|max:255',
            'Deskripsi' => 'nullable|string',
            'Alamat_Penjual' => 'required|string|max:255',
            'No_Telp_Penjual' => 'required|string|max:20',
        ]);

        penjual::create($validatedData);

        return redirect()->back()->with('success', 'Penjual berhasil ditambahkan!');
    }
}
