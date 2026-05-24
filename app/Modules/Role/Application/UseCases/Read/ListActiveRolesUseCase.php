<?php

namespace App\Modules\Role\Application\UseCases\Read;

use App\Modules\Role\Application\Mappers\RoleMapper;
use App\Modules\Role\Domain\Interfaces\RoleInterface;

class ListActiveRolesUseCase
{
    public function __construct(
        private RoleInterface $roleInterface,
    ) {}

    //--------------------------------------------------------------------------
    // EJECUTAR CASO DE USO -> Listar roles activos
    //--------------------------------------------------------------------------
    public function execute(): array
    {
        $roles = $this->roleInterface->findActive();

        return RoleMapper::toDTOArray($roles);
    }
}
