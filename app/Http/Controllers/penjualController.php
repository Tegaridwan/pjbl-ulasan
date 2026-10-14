<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\penjual;
use App\Models\Ulasan;

class penjualController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'Nama_Penjual' => 'required|string|max:255',
            'Deskripsi' => 'nullable|string',
            'Alamat_Penjual' => 'required|string|max:255',
            'No_Telp_Penjual' => 'required|string|max:15',
        ]);

        // Simpan data penjual ke database
        Penjual::updateOrCreate(
            ['Id_Penjual' => Auth::id()], // Gunakan Id_Penjual dari pengguna yang sedang login
            [
                'Nama_Penjual' => $request->Nama_Penjual,
                'Deskripsi' => $request->Deskripsi,
                'Alamat_Penjual' => $request->Alamat_Penjual,
                'No_Telp_Penjual' => $request->No_Telp_Penjual,
            ]
        );

        // Redirect ke halaman home setelah berhasil menyimpan penjual
        return redirect()->route('homePenjual')->with('success', 'Toko berhasil disimpan!');
    }

    public function destroy($id)
    {
        // Temukan ulasan berdasarkan ID
        $ulasan = Ulasan::findOrFail($id);
        $id_penjual = $ulasan->Id_Penjual; // Ambil Id_Penjual dari ulasan yang akan dihapus
        $ulasan->delete();
        return redirect()->route('penjual.ulasan', ['id' => $id_penjual])->with('success', 'Ulasan berhasil dihapus!');
    }

    public function balas(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'respon' => 'nullable|string|max:250',
        ]);

        // Temukan ulasan berdasarkan ID
        $ulasan = Ulasan::findOrFail($id);

        // Cek hak akses penjual
        if ($ulasan->Id_Penjual != Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki hak akses untuk membalas ulasan ini.'
            ], 403);
        }

        // Update kolom 'respon'
        $ulasan->update([
            'respon' => $request->respon,
        ]);

        // Kembalikan JSON agar dibaca oleh fetch di Javascript
        return response()->json([
            'success' => true,
            'message' => 'Respon berhasil disimpan!'
        ]);
    }
}
