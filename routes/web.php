<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\HalguideController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\ShowBlogController;


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
Route::get('/pesanan/create/{id_paket?}', [PesananController::class, 'create'])->name('pesanan.create');
// web.php
Route::get('/halamanguide', [HalguideController::class, 'index'])->name('halamanguide.index');


Route::resource('galeris', GaleriController::class);

// Route::get('/galeri', [GaleriController::class, 'showGaleri'])->name('galeri.page');

Route::get('/galeri', [GaleriController::class, 'showGaleri'])->name('galeri'); // utama
Route::get('/galeri/video', [GaleriController::class, 'showVideo'])->name('galeri.video');




Route::resource('blogs', BlogController::class);

Route::get('/sblog', [BlogController::class, 'listBlogs'])->name('blog.list');








Route::get('/reviews', function () {
    return view('review.review');
})->name('review');




Route::get('/review', [ReviewController::class, 'index'])->name('review.review');

Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');

Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');

Route::get('/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('review.edit');
Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('review.update');
Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');

Route::get('/admin/reviews', [ReviewController::class, 'allReviews'])->name('review.all');



//paket
Route::get('/', [PaketController::class, 'showPakets'])->name('home');

Route::resource('users', UserController::class);


Route::get('/chart/pesanan-per-bulan', [DashboardController::class, 'chartPesananPerBulan'])->name('chart.pesanan.bulanan');

