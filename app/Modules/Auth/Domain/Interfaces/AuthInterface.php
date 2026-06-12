<?php

//--------------------------------------------------------------------------
// AuthInterface: Contrato para los servicios de autenticación y sesión de usuario
//--------------------------------------------------------------------------

namespace App\Modules\Auth\Domain\Interfaces;

interface AuthInterface
{
    public function login(string $email, string $password): ?array;

    public function logout(): void;
}
