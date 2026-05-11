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

    public function execute(LoginDTO $loginDTO): void
    {
        $credentials = [
            'email' => $loginDTO->email,
            'password' => $loginDTO->password,
        ];

        if (!$this->authInterface->attempt($credentials, $loginDTO->remember)) {
            throw new InvalidCredentialsException();
        }

        session()->regenerate();
    }
}
