<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ulasan;

class UlasanApiController extends Controller
{
    public function index()
    {
        // Logic to retrieve and return a list of reviews (ulasan)
        $data = Ulasan::all();
        
        return response()->json([
            'message' => 'Berhasil mengambil semua data',
            'data' => $data
        ], 200);
    }

    public function show($id)
    {
        $data = Ulasan::find($id);

        // Validasi jika data tidak ditemukan (Status 404)
        if (!$data) {
            return response()->json([
                'message' => 'Data tidak ditemukan',
                'data' => null
            ], 404);
        }

        return response()->json([
            'message' => 'Detail data ditemukan',
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        if ($request->bearerToken() !== 'TOKEN-RAHASIA-123' ) {
           return response()->json([
                'message' => 'Unauthorized',
                'data' => null
            ], 401);
        }
        // Validasi input data
        $validatedData = $request->validate([
            'Id_Penjual' => 'required|exists:penjual,Id_Penjual',
            'Nama_Pembeli' => 'required|string|max:255',
            'Ulasan' => 'required|string',
            'Rating' => 'required|integer|min:1|max:5',
        ]);

        // Simpan data ulasan baru ke database
        $ulasan = Ulasan::create([
            'Id_Penjual' => $validatedData['Id_Penjual'],
            'Nama_Pembeli' => $validatedData['Nama_Pembeli'],
            'Ulasan' => $validatedData['Ulasan'],
            'Rating' => $validatedData['Rating'],
        ]);

        return response()->json([
            'message' => 'Ulasan berhasil dibuat',
            'data' => $ulasan
        ], 201);
    }

    public function update(Request $request, $id)
    {
        // Validasi input data
        $validatedData = $request->validate([
            'Id_Penjual' => 'required|exists:penjual,Id_Penjual',
            'Nama_Pembeli' => 'required|string|max:255',
            'Ulasan' => 'required|string',
            'Rating' => 'required|integer|min:1|max:5',
        ]);

        // Cari ulasan berdasarkan ID
        $ulasan = Ulasan::find($id);

        // Validasi jika data tidak ditemukan (Status 404)
        if (!$ulasan) {
            return response()->json([
                'message' => 'Data tidak ditemukan',
                'data' => null
            ], 404);
        }

        // Update data ulasan
        $ulasan->update($validatedData);

        return response()->json([
            'message' => 'Ulasan berhasil diperbarui',
            'data' => $ulasan
        ], 200);
    }

    public function destroy($id)
    {
        // Cari ulasan berdasarkan ID
        $ulasan = Ulasan::find($id);

        // Validasi jika data tidak ditemukan (Status 404)
        if (!$ulasan) {
            return response()->json([
                'message' => 'Data tidak ditemukan',
                'data' => null
            ], 404);
        }

        // Hapus data ulasan
        $ulasan->delete();

        return response()->json([
            'message' => 'Ulasan berhasil dihapus',
            'data' => null
        ], 200);
    }
}
