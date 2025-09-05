<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Tangani kasus belum login (401)
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            session(['url.intended' => $request->fullUrl()]);
            return redirect()->route('login');
        });

        // Tangani 403 yang muncul saat user belum login
        $exceptions->render(function (HttpException $e, Request $request) {
            if ($e->getStatusCode() === 403 && !auth()->check()) {
                session(['url.intended' => $request->fullUrl()]);
                return redirect()->route('login');
            }
        });

        // Tangani 404
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if (!auth()->check()) {
                session(['url.intended' => $request->fullUrl()]);
                return redirect()->route('login');
            }
        });
    })
    ->create();
