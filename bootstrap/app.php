<?php

use App\Http\Middleware\UserAccessDashboardMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        // using: function () {
        //         Route::middleware('api')
        //             ->prefix('api')
        //             ->group(base_path('routes/api.php'));

        //         Route::middleware('web')
        //             ->prefix('internals')
        //             ->group(base_path('routes/web.php'));

        //         Route::middleware('auth:web')
        //             ->prefix('admin')
        //             ->group(base_path('routes/admin.php'));
        // },
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web', 'auth', UserAccessDashboardMiddleware::class                     )
            // Route::middleware('auth:web')
                ->prefix('admin')
                ->as('admin.')
                ->group(base_path('routes/admin.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
