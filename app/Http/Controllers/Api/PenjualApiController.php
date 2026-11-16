<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\penjual;

class PenjualApiController extends Controller
{
    // logika untuk menampilkan semua penjual
    public function index()
    {
       
        $penjualList = penjual::all();

        return response()->json([
            'message' => 'List of sellers retrieved successfully',
            'data' => $penjualList
        ], 200);
    }

    // logika untuk menampilkan detail penjual berdasarkan ID
    public function show($id)
    {
        
        $penjual = penjual::find($id);

        if (!$penjual) {
            return response()->json([
                'message' => 'Seller not found',
                'data' => null
            ], 404);
        }

        return response()->json([
            'message' => 'Seller retrieved successfully',
            'data' => $penjual
        ], 200);
    }

    // logika untuk menampilkan detail penjual berdasarkan ID user yang sedang login
    public function myStore(Request $request)
    {
        
        $userId = $request->user()->id;

        $penjual = penjual::with(['ulasan.respon'])->find($userId);
    
        if (!$penjual) {
            return response()->json([
                'message' => 'Profil toko belum dibuat',
                'data'    => null
            ], 404);
        }

        return response()->json([
            'message' => 'Data toko penjual berhasil dimuat',
            'data'    => $penjual
        ], 200);
    }

    // logika untuk menampilkan semua ulasan penjual berdasarkan ID user yang sedang login
    public function myUlasan(Request $request)
    {
    
        $userId = $request->user()->id;
        $penjual = penjual::with('ulasan.respon')->find($userId);

        if (!$penjual) {
            return response()->json([
                'message' => 'Data penjual tidak ditemukan',
                'data'    => null
            ], 404);
        }

        return response()->json([
            'message' => 'Data ulasan penjual berhasil dimuat',
            'data'    => $penjual->ulasan
        ], 200);
    }

    // logika untuk menyimpan atau memperbarui data penjual
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'Nama_Penjual' => 'required|string|max:255',
            'Deskripsi' => 'nullable|string',
            'Alamat_Penjual' => 'required|string|max:255',
            'No_Telp_Penjual' => 'required|string|max:15',
        ]);

        
        $userId = $request->user()->id;

        // Simpan data penjual ke database
        $penjual = penjual::updateOrCreate(
            ['Id_Penjual' => $userId], // Gunakan Id_Penjual dari pengguna yang sedang login
            [
                'Nama_Penjual' => $request->Nama_Penjual,
                'Deskripsi' => $request->Deskripsi,
                'Alamat_Penjual' => $request->Alamat_Penjual,
                'No_Telp_Penjual' => $request->No_Telp_Penjual,
            ]
        );

        return response()->json([
            'message' => 'Toko berhasil disimpan!',
            'data'    => $penjual
        ], 200);
    }
}
