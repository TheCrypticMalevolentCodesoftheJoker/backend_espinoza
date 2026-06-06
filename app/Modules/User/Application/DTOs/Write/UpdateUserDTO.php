<?php
//--------------------------------------------------------------------------
// UpdateUserDTO: Estructura de datos entrantes para la actualización de un usuario.
// La contraseña es opcional para permitir actualización parcial.
//--------------------------------------------------------------------------

namespace App\Modules\User\Application\DTOs\Write;

class UpdateUserDTO
{
    public function __construct(
        public int $roleId,
        public string $name,
        public string $email,
        public ?string $password = null
    ) {}
}
