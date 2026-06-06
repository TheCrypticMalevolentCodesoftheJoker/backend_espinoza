<?php
//--------------------------------------------------------------------------
// UpdateRoleDTO: Estructura de datos entrantes para la actualización de un rol.
//--------------------------------------------------------------------------

namespace App\Modules\Role\Application\DTOs\Write;

class UpdateRoleDTO
{
    public function __construct(
        public string $name,
    ) {}
}
