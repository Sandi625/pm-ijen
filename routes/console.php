<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\SendNotifGuide;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('queue:dev-start', function () {
    $this->info('Starting queue...');
    passthru('php artisan queue:work');
});

// Daftarkan command kamu
// Artisan::starting(function ($artisan) {
//     $artisan->resolveCommands([
//         SendNotifGuide::class,
//     ]);
// });
