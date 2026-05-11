<?php

use Illuminate\Foundation\Application;
use App\Shared\Exceptions\BusinessAppException;
use App\Shared\Exceptions\ValidationAppException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // --------------------------------------------------
        // 🌍 DOMAIN / APP ERRORS
        // --------------------------------------------------
        $exceptions->render(function (BusinessAppException $e) {
            return back()->with('notification', $e->toAlert());
        });
        // --------------------------------------------------
        // 🧾 FORM ERRORS
        // --------------------------------------------------
        $exceptions->render(function (ValidationAppException $e) {
            return back()->withErrors($e->errors())->withInput();
        });

        // --------------------------------------------------
        // 💥 FALLBACK
        // --------------------------------------------------
        $exceptions->render(function (Throwable $e) {
            return false;
        });
    })
    ->create();
