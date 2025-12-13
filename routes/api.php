<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BarangApiController;

Route::get('/ping', function () {
    return response()->json([
        'status' => 'API berjalan',
        'waktu' => now()
    ]);
});

// API BARANG (aman, read-only)
Route::get('/barang', [BarangApiController::class, 'index']);
Route::get('/barang/{id}', [BarangApiController::class, 'show']);
