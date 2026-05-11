<?php

namespace App\Modules\Auth\Presentation\Http\Controllers;

use App\Modules\Auth\Application\UseCases\LoginUseCase;
use App\Modules\Auth\Application\UseCases\LogoutUseCase;
use App\Modules\Auth\Presentation\Http\Requests\LoginRequest;

class AuthController
{
    public function __construct(
        private readonly LoginUseCase $loginUseCase,
        private readonly LogoutUseCase $logoutUseCase
    ) {}

    public function create()
    {
        return view('auth::auth.login');
    }

    public function store(LoginRequest $loginRequest)
    {
        $this->loginUseCase->execute($loginRequest->toDto());

        return redirect()->route('dashboard')
            ->with('notification', [
                'statusCode' => 200,
                'errorCode' => 'LOGIN_SUCCESS',
                'message' => 'Inicio de sesión exitoso'
            ]);
    }

    public function destroy()
    {
        $this->logoutUseCase->execute();
        return redirect()->route('auth.login');
    }
}
