<?php

use App\Http\Controllers\TambahUlasanController;
use App\Models\penjual;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// 1. Route Beranda / Dashboard: Mengambil semua data penjual
Route::get('/', function () {
    $penjualList = penjual::all();
    return view('dashboard', compact('penjualList'));
})->name('dashboard');

// Auth Routes (Login & Register khusus Penjual)
Route::middleware('guest')->group(function () {
    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register.submit');
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.submit');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/homePenjual', function () {
        $penjual = \App\Models\penjual::find(Auth::id());
        return view('homePenjual', compact('penjual'));
    })->name('homePenjual');
    Route::post('simpan-penjual', [\App\Http\Controllers\penjualController::class, 'store'])->name('penjual.store');
});

Route::get('/penjual/{id}', function ($id) {
    $penjual = penjual::findOrFail($id);
    return view('detail', compact('penjual'));
})->name('penjual.detail');

Route::get('/ulasan/{id}', function ($id) {
    $penjual = penjual::findOrFail($id);
    return view('formulasan', compact('penjual'));
})->name('ulasan.create');

Route::post('/ulasan', [TambahUlasanController::class, 'store'])->name('ulasan.store');