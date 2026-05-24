<?php

namespace App\Modules\Auth\Presentation\Controllers;

use App\Modules\Auth\Application\UseCases\LoginUseCase;
use App\Modules\Auth\Application\UseCases\LogoutUseCase;
use App\Modules\Auth\Presentation\Requests\LoginRequest;
use App\Shared\Responses\ApiResponse;

class AuthController
{
    public function __construct(
        private readonly LoginUseCase $loginUseCase,
        private readonly LogoutUseCase $logoutUseCase
    ) {}

    //----------------------------------------------------------------------------------
    // INICIAR SESIÓN
    //----------------------------------------------------------------------------------
    public function store(LoginRequest $loginRequest)
    {
        $token = $this->loginUseCase->execute($loginRequest->toDto());

        return ApiResponse::success(
            statusCode: 200,
            message: 'Inicio de sesión exitoso.',
            data: $token
        );
    }

    //----------------------------------------------------------------------------------
    // CERRAR SESIÓN
    //----------------------------------------------------------------------------------
    public function destroy()
    {
        $this->logoutUseCase->execute();

        return ApiResponse::success(
            statusCode: 200,
            message: 'Sesión cerrada correctamente.'
        );
    }
}
