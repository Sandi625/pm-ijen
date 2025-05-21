<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PesananController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Tambahkan Api\ di depan nama controller untuk memperjelas namespace
// Route::get('/guides-by-kriteria/{kriteriaId}', [\App\Http\Controllers\Api\PesananController::class, 'getGuidesByKriteria']);

Route::get('/guides-by-kriteria/{pesananId}', [PesananController::class, 'getGuidesByKriteria']);


Route::get('/pesanan/{id}/kriteria', [PesananController::class, 'getKriteria']);

Route::get('/pesanan/{id}/edit', [PesananController::class, 'editApi']);
