<?php

use App\Shared\Responses\ApiResponse;
use Illuminate\Foundation\Application;
use App\Shared\Exceptions\BusinessAppException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;

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
        // DOMAIN
        // --------------------------------------------------
        $exceptions->render(function (BusinessAppException $e) {
            return ApiResponse::error(
                statusCode: $e->getStatusCode(),
                errorCode: $e->getErrorCode(),
                message: $e->getMessage(),
            );
        });

        // --------------------------------------------------
        // AUTHENTICATION
        // --------------------------------------------------
        $exceptions->render(function (\Illuminate\Auth\AuthenticationException $e) {
            throw new \App\Modules\Auth\Domain\Exceptions\TokenExpiredOrInvalidException();
        });

        // --------------------------------------------------
        // VALIDATION
        // --------------------------------------------------
        $exceptions->render(function (ValidationException $e) {
            return ApiResponse::error(
                statusCode: 422,
                errorCode: 'VALIDATION_ERROR',
                message: 'Error de validación.',
                data: $e->errors()
            );
        });

        // --------------------------------------------------
        // FALLBACK
        // --------------------------------------------------
        $exceptions->render(function (Throwable $e) {

            return ApiResponse::error(
                statusCode: 500,
                errorCode: 'SERVER_ERROR',
                message: 'Error interno del servidor.'
            );
        });
    })
    ->create();
