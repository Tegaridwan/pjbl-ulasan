<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UlasanApiController;
use App\Http\Controllers\Api\PenjualApiController;

Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

// Tambahkan rute publik untuk pembeli di sini:
Route::get('/penjual', [PenjualApiController::class, 'index']);
Route::get('/penjual/{id}', [PenjualApiController::class, 'show']);
Route::get('/ulasan', [UlasanApiController::class, 'index']);   
Route::post('/ulasan', [UlasanApiController::class, 'store']);
Route::get('/ulasan/penjual/{id}', [UlasanApiController::class, 'byPenjual']);


// ==========================================
// 2. ROUTE AKSES KHUSUS PENJUAL (DIPROTEKSI)
// ==========================================
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);

    // Kelola data penjual
    Route::get('/penjual-saya', [App\Http\Controllers\Api\PenjualApiController::class, 'myStore']);
    Route::post('/simpan-penjual', [App\Http\Controllers\Api\PenjualApiController::class, 'store']);

    // Kelola data ulasan
    Route::get('/penjual/ulasan', [App\Http\Controllers\Api\PenjualApiController::class, 'myUlasan']);

    // Kelola respon ulasan
    Route::post('/respon', [App\Http\Controllers\Api\ResponApiController::class, 'store']);
    Route::put('/respon/{id}', [App\Http\Controllers\Api\ResponApiController::class, 'update']);
    Route::delete('/respon/{id}', [App\Http\Controllers\Api\ResponApiController::class, 'destroy']);
});
