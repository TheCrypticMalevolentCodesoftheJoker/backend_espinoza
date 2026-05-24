<?php

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
    // EJECUTAR CASO DE USO -> Iniciar sesión
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
