<?php
//--------------------------------------------------------------------------
// RoleDTO: Estructura de transferencia de datos para la representación de lectura de un rol.
//--------------------------------------------------------------------------

namespace App\Modules\Role\Application\DTOs\Read;

class RoleDTO
{
    public function __construct(
        public int $id,
        public string $name,
        public bool $status,
        public ?string $createdAt,
        public ?string $updatedAt,
    ) {}
}
