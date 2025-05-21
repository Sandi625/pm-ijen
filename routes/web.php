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
use App\Http\Controllers\HalPelangganController;
use App\Http\Controllers\GuideKriteriaController;
use App\Http\Controllers\NotifGuideController;

use App\Http\Controllers\LandingPageController;




Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');


// Halaman admin semua dibungkus 'auth' dan 'isAdmin'
Route::middleware(['auth', 'isAdmin'])->group(function () {
    // Dashboard

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Kriteria & Subkriteria
    Route::resource('kriteria', KriteriaController::class);
    Route::resource('subkriteria', SubKriteriaController::class);

    // Penilaian
    Route::get('/penilaian/all', [PenilaianController::class, 'all'])->name('penilaian.all');
    Route::resource('penilaian', PenilaianController::class);

    // Users
    Route::resource('users', UserController::class);

    // Guide
    Route::resource('guide', GuideController::class);

    // Paket
    Route::resource('paket', PaketController::class);

    // Galeri
    Route::resource('galeris', GaleriController::class);
    Route::get('/galeri/video', [GaleriController::class, 'showVideo'])->name('galeri.video');

    // Chart pesanan
    Route::get('/chart/pesanan-per-bulan', [DashboardController::class, 'chartPesananPerBulan'])
        ->name('chart.pesanan.bulanan');

    // Review (CRUD dari admin panel)
    Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::get('/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('review.edit');
    Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('review.update');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');
    Route::get('/admin/reviews', [ReviewController::class, 'allReviews'])->name('review.all');
    Route::get('/reviews/{id}', [ReviewController::class, 'show'])->name('review.show');
});





// Route::get('/pdf/candidates', [PenilaianController::class, 'generateCandidatesReport'])->name('candidates.report');
// route::get('/pdf/penilaian/all', [PenilaianController::class, 'generatePenilaianPdf'])->name('penilaian.pdf.all');
// route::get('/pdf/penilaian/accepted', [PenilaianController::class, 'generatePenilaianPdf'])->name('penilaian.pdf.accepted')->defaults('status', 'accepted');

// route::get('/pdf/penilaian/rejected', [PenilaianController::class, 'generatePenilaianPdf'])->name('penilaian.pdf.rejected')->defaults('status', 'rejected');









Route::get('/halamanguide', [HalguideController::class, 'index'])
    ->name('halamanguide.index')
    ->middleware(['auth', 'isGuideOrAdmin']);

Route::get('/halaman-guide/{id}', [HalguideController::class, 'showguide'])
    ->name('halamanguide.show')
    ->middleware(['auth', 'isGuideOrAdmin']);







// Route::get('/galeri', [GaleriController::class, 'showGaleri'])->name('galeri.page');





// halaman pelanggan
Route::resource('blogs', BlogController::class)
->except(['show'])
->middleware('auth');
// Route 'show' tidak menggunakan middleware auth
Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');
Route::get('/sblog', [BlogController::class, 'listBlogs'])->name('blog.list');
    Route::get('/galeri', [GaleriController::class, 'showGaleri'])->name('galeri');


//Pelanggan
// 2. Route create & store TANPA middleware auth
Route::get('/pesanan/create/{id_paket?}', [PesananController::class, 'create'])->name('pesanan.create');
Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');

Route::prefix('customer')->middleware(['auth'])->group(function () {
    Route::get('/packages', [HalPelangganController::class, 'showPackages'])->name('customer.packages');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/review', [ReviewController::class, 'index'])->name('review.review');
    Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');
});




// Pesanan
// 1. Route resource untuk pesanan TANPA create dan store, yang lainnya tetap pakai auth
Route::resource('pesanan', PesananController::class)
->except(['create', 'store'])
->middleware('auth');

// paket di halaman welcome
// Route::get('/', [PaketController::class, 'showPakets'])->name('home');


// Route::get('/reviews', function () {
    //     return view('review.review');
    // })->name('review');




// Route dengan middleware 'auth' untuk proteksi














// // Admin
// Route::prefix('dashboard')->middleware(['auth', 'ceklevel:admin'])->group(function () {
//     Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
// });

// // Guide
// Route::prefix('halamanguide')->middleware(['auth', 'ceklevel:guide'])->group(function () {
//     Route::get('/', [GuideController::class, 'index'])->name('guide.dashboard');
// });

// // Pelanggan
// Route::prefix('customer')->middleware(['auth', 'ceklevel:pelanggan'])->group(function () {
//     Route::get('/packages', [HalPelangganController::class, 'showPackages'])->name('customer.packages');
// });



// routes/web.php
Route::get('/get-guides-by-kriteria/{kriteriaId}', [PesananController::class, 'getGuidesByKriteria']);


Route::get('/notif-guide', [NotifGuideController::class, 'guidesWithPesanan'])->name('notif.guide');

// Route::get('/guide/{id}/send-notif', [NotifGuideController::class, 'sendNotifToGuide'])->name('guide.sendNotif');
// Route::post('/guide/{id}/send-notif', [GuideController::class, 'sendNotif'])->name('guide.sendNotif');
// Route::post('/guide/{id}/send-notif', [NotifGuideController::class, 'sendNotifToGuide'])->name('guide.send-notif');
Route::get('/guide/{id}/send-notif', [NotifGuideController::class, 'sendNotifToGuide'])->name('guide.sendNotif');

// Route::get('/landing-reviews', [ReviewController::class, 'getActiveReviews'])->name('landing.reviews');

// Route::get('/', [ReviewController::class, 'getActiveReviews'])->name('home');
// Route::resource('guide_kriteria', GuideKriteriaController::class);

Route::get('/', [LandingPageController::class, 'index'])->name('home');
