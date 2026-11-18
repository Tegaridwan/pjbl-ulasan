<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ulasan;

class UlasanApiController extends Controller
{
    // 1. READ (GET): Menampilkan semua ulasan (Bisa diakses publik)
    public function index()
    {
        // Mengambil data ulasan beserta data penjualnya (jika relasi Eloquent sudah dibuat)
        $ulasan = Ulasan::with('penjual')->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar seluruh ulasan',
            'data' => $ulasan
        ], 200);
    }

    // 2. CREATE (POST): Menambahkan ulasan baru (Bisa diakses publik)
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_penjual'   => 'required|exists:penjual,id', // Pastikan ID penjual valid di database
            'nama_pembeli' => 'required|string|max:255',
            'ulasan'       => 'required|string',
            'rating'       => 'required|integer|min:1|max:5', // Rating antara 1 sampai 5
        ]);

        $ulasan = Ulasan::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Ulasan berhasil ditambahkan!',
            'data' => $ulasan
        ], 201);
    }

    // 3. READ DETAIL (GET): Menampilkan detail satu ulasan berdasarkan ID
    public function show($id)
    {
        $ulasan = Ulasan::with('penjual')->find($id);

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