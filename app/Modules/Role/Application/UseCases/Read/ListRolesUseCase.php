<?php
//--------------------------------------------------------------------------
// ListRolesUseCase: Consulta de todos los roles registrados en el sistema.
//--------------------------------------------------------------------------

namespace App\Modules\Role\Application\UseCases\Read;

use App\Modules\Role\Application\Mappers\RoleMapper;
use App\Modules\Role\Domain\Interfaces\RoleInterface;

class ListRolesUseCase
{
    public function __construct(
        private RoleInterface $roleInterface,
    ) {}

    //--------------------------------------------------------------------------
    // EJECUTAR CASO DE USO -> Listar todos los roles
    //--------------------------------------------------------------------------
    public function execute(): array
    {
        $roles = $this->roleInterface->findAll();

        return RoleMapper::toDTOArray($roles);
    }
}
