<?php
//--------------------------------------------------------------------------
// UserDTO: Estructura de transferencia para la representación de lectura de un usuario.
// Incluye el nombre del rol resuelto desde el módulo Role.
//--------------------------------------------------------------------------

namespace App\Modules\User\Application\DTOs\Read;

class UserDTO
{
    public function __construct(
        public int $id,
        public int $roleId,
        public string $roleName,
        public string $name,
        public string $email,
        public bool $status,
        public ?string $createdAt,
        public ?string $updatedAt,
    ) {}
}
