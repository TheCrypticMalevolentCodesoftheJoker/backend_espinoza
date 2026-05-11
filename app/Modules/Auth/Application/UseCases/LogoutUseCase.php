<?php

namespace App\Modules\Auth\Application\UseCases;

use App\Modules\Auth\Domain\Interfaces\AuthInterface;

class LogoutUseCase
{
    public function __construct(
        private readonly AuthInterface $authInterface
    ) {}

    public function execute(): void
    {
        $this->authInterface->logout();

        session()->invalidate();
        session()->regenerateToken();
    }
}
