<?php

//--------------------------------------------------------------------------
// LoginDTO: Estructura de datos para los parámetros de inicio de sesión
//--------------------------------------------------------------------------

namespace App\Modules\Auth\Application\DTOs;

class LoginDTO
{
    public function __construct(
        public string $email,
        public string $password,
    ) {}
}
