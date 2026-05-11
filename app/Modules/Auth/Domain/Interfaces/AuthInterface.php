<?php

namespace App\Modules\Auth\Domain\Interfaces;

interface AuthInterface
{
    public function attempt(array $credentials, bool $remember): bool;
    public function logout(): void;
}
