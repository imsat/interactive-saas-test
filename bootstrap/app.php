<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->group('api', [
//             'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
//            \App\Http\Middleware\LoginRateLimitMiddleware::class,
        ]);
        $middleware->alias([
            'incremental.block' => \App\Http\Middleware\IncrementalBlockMiddleware::class,
//            'login.rate_limit' => \App\Http\Middleware\LoginRateLimitMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Custom NotFoundHttpException handle
        $exceptions->renderable(function (NotFoundHttpException $e) {
            return response()->json([
                'message' => 'Record not found.'
            ], 404);
        });

//        $exceptions->renderable(function (ThrottleRequestsException $e) {
//            return response()->json([
//                'message' => $e->getMessage() ?? 'Too Many Attempts.'
//            ], 404);
//        });
    })->create();
