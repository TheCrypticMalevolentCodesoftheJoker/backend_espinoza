<?php

//--------------------------------------------------------------------------
// AuthController: Controlador que gestiona los flujos HTTP de sesión y credenciales
//--------------------------------------------------------------------------

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

    //--------------------------------------------------------------------------
    // Autenticación: Inicio de sesión del usuario y retorno de token API
    //--------------------------------------------------------------------------
    public function store(LoginRequest $loginRequest)
    {
        $data = $this->loginUseCase->execute($loginRequest->toDto());

        return ApiResponse::success(
            statusCode: 200,
            message: 'Inicio de sesión exitoso.',
            data: $data
        );
    }

    //--------------------------------------------------------------------------
    // Autenticación: Finalización y revocación de la sesión del usuario
    //--------------------------------------------------------------------------
    public function destroy()
    {
        $this->logoutUseCase->execute();

        return ApiResponse::success(
            statusCode: 200,
            message: 'Sesión cerrada correctamente.'
        );
    }
}
