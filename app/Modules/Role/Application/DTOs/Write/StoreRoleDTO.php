<?php
//--------------------------------------------------------------------------
// StoreRoleDTO: Estructura de datos entrantes para la creación de un rol.
//--------------------------------------------------------------------------

namespace App\Modules\Role\Application\DTOs\Write;

class StoreRoleDTO
{
    public function __construct(
        public string $name,
    ) {}
}
