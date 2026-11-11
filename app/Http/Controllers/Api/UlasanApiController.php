<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\ulasan;
use Illuminate\Http\Request;

class UlasanApiController extends Controller
{
    /**
     * Menampilkan seluruh data (Get All)
     */
    public function index()
    {
        $data = ulasan::all();
        
        return response()->json([
            'message' => 'Berhasil mengambil semua data',
            'data' => $data
        ], 200);
    }

    /**
     * Menampilkan data spesifik berdasarkan ID (Get By ID)
     */
    public function show($id)
    {
        $data = ulasan::find($id);

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

    /**
     * Menyimpan ulasan baru (Create)
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Id_Penjual' => 'required|exists:penjual,Id_Penjual',
            'Nama_Pembeli' => 'required|string|max:100',
            'Ulasan' => 'required|string|max:250',
            'Rating' => 'required|integer|min:1|max:5',
        ]);

        $data = ulasan::create($validatedData);

        return response()->json([
            'message' => 'Ulasan berhasil ditambahkan',
            'data' => $data
        ], 201);
    }
}