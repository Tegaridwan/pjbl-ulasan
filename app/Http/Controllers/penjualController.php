<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\penjual;

class penjualController extends Controller
{
        public function store(Request $request) {
        // Validasi input
        $request->validate([
            'Nama_Penjual' => 'required|string|max:255',
            'Deskripsi' => 'nullable|string',
            'Alamat_Penjual' => 'required|string|max:255',
            'No_Telp_Penjual' => 'required|string|max:15',
        ]);

        Penjual::updateOrCreate(
            ['Id_User' => Auth::id()],
            [
                'Nama_Penjual' => $request->Nama_Penjual,
                'Deskripsi' => $request->Deskripsi,
                'Alamat_Penjual' => $request->Alamat_Penjual,
                'No_Telp_Penjual' => $request->No_Telp_Penjual,
            ]
        );

        return redirect()->route('homePenjual')->with('success', 'Toko berhasil disimpan!');
    }
}
