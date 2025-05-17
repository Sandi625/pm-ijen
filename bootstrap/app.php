<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
      // Daftarkan alias 'isAdmin' untuk middleware IsAdmin
        $middleware->alias([
            'isAdmin' => \App\Http\Middleware\IsAdmin::class,
            'isGuideOrAdmin' => \App\Http\Middleware\IsGuideOrAdmin::class,  // Tambahkan ini

        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
