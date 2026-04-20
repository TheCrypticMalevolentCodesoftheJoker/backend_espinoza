<?php

use Illuminate\Foundation\Application;
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
        // VALIDATION EXCEPTIONS
        // --------------------------------------------------
        $exceptions->render(function (\Illuminate\Validation\ValidationException $e) {
            return back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('alert', [
                    'variant' => 'error',
                    'code' => 422,
                    'message' => 'Revisa los campos del formulario',
                ]);
        });

        // --------------------------------------------------
        // DOMAIN EXCEPTIONS
        // --------------------------------------------------
        $exceptions->render(function (\DomainException $e) {
            return back()
                ->with('alert', [
                    'variant' => 'error',
                    'code' => 400,
                    'message' => $e->getMessage(),
                ]);
        });

        // --------------------------------------------------
        // GENERIC EXCEPTIONS
        // --------------------------------------------------
        $exceptions->render(function (\Throwable $e) {
            return back()->with('alert', [
                'variant' => 'error',
                'code' => 500,
                'message' => $e->getMessage(),
            ]);
        });

        // --------------------------------------------------
        // MODULE HANDLERS
        // --------------------------------------------------
        \App\Modules\Catalog\Category\Infrastructure\Exceptions\CategoryExceptionHandler::register($exceptions);
        \App\Modules\Catalog\Brand\Infrastructure\Exceptions\BrandExceptionHandler::register($exceptions);
        \App\Modules\Catalog\Product\Infrastructure\Exceptions\ProductExceptionHandler::register($exceptions);
    })
    ->create();
