<?php
//--------------------------------------------------------------------------
// UserRoleDTO: Representación mínima de un rol en el contexto del módulo User.
//--------------------------------------------------------------------------

namespace App\Modules\User\Application\DTOs\Read;

class UserRoleDTO
{
    public function __construct(
        public int $id,
        public string $name
    ) {}
}
