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
        // Menambahkan pengecualian CSRF
        $middleware->validateCsrfTokens(except: [
            'stripe/*', // Untuk webhook Stripe
            'api/*', // Contoh rute lain yang ingin dikecualikan
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Atur exception handler di sini
    })
    ->create();
