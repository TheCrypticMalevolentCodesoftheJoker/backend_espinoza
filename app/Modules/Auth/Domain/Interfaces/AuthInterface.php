<?php

namespace App\Modules\Auth\Domain\Interfaces;

interface AuthInterface
{
    public function login(string $email, string $password): ?string;

    public function logout(): void;
}
