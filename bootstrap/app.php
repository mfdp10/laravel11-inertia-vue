<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        // function (Router $router) {
        //     $router->middleware('api')
        //         ->prefix('task_categories')
        //         ->group(base_path('src/admin/task_category/infrastructure/routes/api.php'));
        // },
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
            \App\Http\Middleware\Language::class
        ]);
        // ->trustProxies(
        //     at: [
        //         '*',
        //     ],
        //     headers: Request::HEADER_X_FORWARDED_FOR |
        //         Request::HEADER_X_FORWARDED_HOST |
        //         Request::HEADER_X_FORWARDED_PORT |
        //         Request::HEADER_X_FORWARDED_PROTO |
        //         Request::HEADER_X_FORWARDED_AWS_ELB
        // );

        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
