<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UlasanApiController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

//route akses umum pembeli
Route::post('/register' , [App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login' , [App\Http\Controllers\Api\AuthController::class, 'login']);
// lanjutan route akses umum pembeli


// Route akses khusus penjual
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

    //kelola respon ulasan
    Route::post('/respon', [App\Http\Controllers\Api\ResponApiController::class, 'store']);
    Route::put('/respon/{id}', [App\Http\Controllers\Api\ResponApiController::class, 'update']);
    Route::delete('/respon/{id}', [App\Http\Controllers\Api\ResponApiController::class, 'destroy']);
});


















// Route::get('/ulasan/{id}', [UlasanApiController::class, 'show']);
// Route::post('/ulasan', [UlasanApiController::class, 'store']);
// Route::put('/ulasan/{id}', [UlasanApiController::class, 'update']);
// Route::delete('/ulasan/{id}', [UlasanApiController::class, 'destroy']);

// // Authentication routes
// Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'register']);
// Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);
// Route::get('/ulasan', [UlasanApiController::class, 'index']);