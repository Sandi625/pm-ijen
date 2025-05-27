<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Foundation\Application;
use App\Http\Middleware\CheckPelanggan;
use App\Http\Middleware\IsGuideOrAdmin;
use App\Console\Commands\SendNotifGuide;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
      // Daftarkan alias 'isAdmin' untuk middleware IsAdmin
        $middleware->alias([
            'isAdmin' => \App\Http\Middleware\IsAdmin::class,
            'isGuideOrAdmin' => \App\Http\Middleware\IsGuideOrAdmin::class,  // Tambahkan ini
            'pelanggan' => \App\Http\Middleware\CheckPelanggan::class,


        ]);

    })
     ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->withCommands([
        SendNotifGuide::class,  // <-- Daftarkan command di sini
    ])
    ->create();
