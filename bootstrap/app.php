<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isAgent;
use App\Http\Middleware\RevalidateBackHistory;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\TwoFactorMiddleware;
use App\Http\Middleware\AuthenticateMiddleware;
use App\Http\Middleware\Impersonate;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'isAdmin' => isAdmin::class,
            'isAgent' => isAgent::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            'preventBackHistory' => RevalidateBackHistory::class,
            'preventBackPrevious' => RedirectIfAuthenticated::class,
            '2fa' => TwoFactorMiddleware::class,
            'auth' => AuthenticateMiddleware::class,
            'impersonate' => Impersonate::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();