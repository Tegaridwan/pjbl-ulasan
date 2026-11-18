<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ulasan;

class UlasanApiController extends Controller
{
    // 1. READ (GET): Menampilkan semua ulasan (Bisa diakses publik)
    public function index()
    {
        // Mengambil data ulasan beserta data penjualnya (jika relasi Eloquent sudah dibuat)
        $ulasan = ulasan::with('penjual')->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar seluruh ulasan',
            'data' => $ulasan
        ], 200);
    }

    public function byPenjual($id)
    {
        $ulasan = ulasan::with('penjual')->where('Id_Penjual', $id)->get();

        return response()->json([
            'success' => true,
            'message' => 'Ulasan berdasarkan penjual',
            'data' => $ulasan
        ], 200);
    }

    // 2. CREATE (POST): Menambahkan ulasan baru (Bisa diakses publik)
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Id_Penjual'   => 'required|exists:penjual,Id_Penjual', // Pastikan ID penjual valid di database
            'Nama_Pembeli' => 'required|string|max:255',
            'Ulasan'       => 'required|string',
            'Rating'       => 'required|integer|min:1|max:5', // Rating antara 1 sampai 5
        ]);

        $ulasan = ulasan::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Ulasan berhasil ditambahkan!',
            'data' => $ulasan
        ], 201);
    }

    // 3. READ DETAIL (GET): Menampilkan detail satu ulasan berdasarkan ID
    public function show($id)
    {
        $ulasan = ulasan::with('penjual')->find($id);

        if (!$ulasan) {
            return response()->json([
                'success' => false,
                'message' => 'Ulasan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail ulasan',
            'data' => $ulasan
        ], 200);
    }
}