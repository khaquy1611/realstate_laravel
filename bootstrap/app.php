<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Role;
use App\Http\Middleware\RevalidateBackHistory;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\TwoFactorMiddleware;
use App\Http\Middleware\AuthenticateMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->alias([
            'role' => Role::class,
            'preventBackHistory' => RevalidateBackHistory::class,
            'preventBackPrevious' => RedirectIfAuthenticated::class,
            '2fa' => TwoFactorMiddleware::class,
            'auth' => AuthenticateMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();