<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Respon;
use App\Models\Ulasan; 

class ResponApiController extends Controller
{
    // Balas ulasan
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Id_Respon' => 'required|exists:ulasan,Id_Ulasan',
            'Respon' => 'required|string',
        ]);

        $ulasan = Ulasan::findOrFail($validatedData['Id_Respon']);
        
        if ($ulasan->Id_Penjual !== $request->user()->id) {
            return response()->json(['message' => 'Anda tidak memiliki izin untuk membalas ulasan ini.'], 403);
        }

        $respon = Respon::updateOrCreate(
            ['Id_Respon' => $validatedData['Id_Respon']],
            ['Respon' => $validatedData['Respon']]
        );

        return response()->json(['message' => 'Respon berhasil disimpan.', 'respon' => $respon], 201);
    }

    // Edit balasan ulasan
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'Respon' => 'required|string',
        ]);

        $respon = Respon::with('ulasan')->findOrFail($id);

    
        if (!$respon->ulasan || $respon->ulasan->Id_Penjual !== $request->user()->id) {
            return response()->json(['message' => 'Anda tidak memiliki izin untuk mengubah respon ini.'], 403);
        }

        $respon->update($validatedData);

        return response()->json(['message' => 'Respon berhasil diperbarui.', 'respon' => $respon], 200);
    }

    // Hapus balasan ulasan
    public function destroy(Request $request, $id)
    {
        $respon = Respon::with('ulasan')->find($id);

        if (!$respon) {
            return response()->json(['message' => 'Data respon tidak ditemukan'], 404);
        }

        if (!$respon->ulasan || $respon->ulasan->Id_Penjual !== $request->user()->id) {
            return response()->json(['message' => 'Anda tidak berhak menghapus respon ini.'], 403);
        }

        $respon->delete();

        return response()->json(['message' => 'Respon berhasil dihapus!'], 200);
    }
}