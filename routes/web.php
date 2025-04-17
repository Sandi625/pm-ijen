<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\KriteriaController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SubKriteriaController;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected route
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('kriteria', KriteriaController::class);
    Route::resource('subkriteria', SubKriteriaController::class);

    Route::get('/penilaian/all', [PenilaianController::class, 'all'])->name('penilaian.all');
    Route::resource('penilaian', PenilaianController::class);

});
Route::get('/pdf/candidates', [PenilaianController::class, 'generateCandidatesReport'])->name('candidates.report');
route::get('/pdf/penilaian/all', [PenilaianController::class, 'generatePenilaianPdf'])->name('penilaian.pdf.all');
route::get('/pdf/penilaian/accepted', [PenilaianController::class, 'generatePenilaianPdf'])     ->name('penilaian.pdf.accepted') ->defaults('status', 'accepted');

route::get('/pdf/penilaian/rejected', [PenilaianController::class, 'generatePenilaianPdf'])     ->name('penilaian.pdf.rejected')->defaults('status', 'rejected');



// Guide route
Route::resource('guide', GuideController::class);

// Paket
Route::resource('paket', PaketController::class);

// Pesanan
Route::resource('pesanan', controller: PesananController::class);
// Route::get('pesanan/create/{paket_id}', [PesananController::class, 'create'])->name('pesanan.create');
Route::get('/pesanan/create/{id_paket?}', [PesananController::class, 'create'])->name('pesanan.create');
// web.php
// Route::get('/pesanan/create/{id}', action: [PesananController::class, 'create'])->name('pesanan.create');













//route landing page
Route::get('/galeri', function () {
    return view('galeri.galeri');
})->name('galeri');

Route::get('/reviews', function () {
    return view('review.review');
})->name('review');




Route::get('/review', [ReviewController::class, 'index'])->name('review.review');

Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');


//paket
Route::get('/', [PaketController::class, 'showPakets'])->name('home');
// Route::get('/', [PesananController::class, 'showPakets']);

// Route::get('/', [PaketController::class, 'showPakets']);






