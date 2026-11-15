<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UlasanApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/ulasan', [UlasanApiController::class, 'index']);
Route::get('/ulasan/{id}', [UlasanApiController::class, 'show']);
Route::post('/ulasan', [UlasanApiController::class, 'store']);
Route::put('/ulasan/{id}', [UlasanApiController::class, 'update']);
Route::delete('/ulasan/{id}', [UlasanApiController::class, 'destroy']);