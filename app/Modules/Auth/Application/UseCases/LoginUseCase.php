<?php

//--------------------------------------------------------------------------
// LoginUseCase: Ejecución de la lógica de autenticación e inicio de sesión
//--------------------------------------------------------------------------

namespace App\Modules\Auth\Application\UseCases;

use App\Modules\Auth\Application\DTOs\LoginDTO;
use App\Modules\Auth\Domain\Interfaces\AuthInterface;
use App\Modules\Auth\Domain\Exceptions\InvalidCredentialsException;

class LoginUseCase
{
    public function __construct(
        private readonly AuthInterface $authInterface
    ) {}

    //--------------------------------------------------------------------------
    // Autenticación: Validación de credenciales y generación del token de acceso
    //--------------------------------------------------------------------------
    public function execute(LoginDTO $loginDTO): string
    {
        $token = $this->authInterface->login($loginDTO->email, $loginDTO->password);

        if (!$token) {
            throw new InvalidCredentialsException();
        }

        return $token;
    }
}
