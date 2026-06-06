<?php
//--------------------------------------------------------------------------
// GetRoleByIdUseCase: Obtención de un rol específico por su identificador.
//--------------------------------------------------------------------------

namespace App\Modules\Role\Application\UseCases\Read;

use App\Modules\Role\Application\DTOs\Read\RoleDTO;
use App\Modules\Role\Application\Mappers\RoleMapper;
use App\Modules\Role\Domain\Interfaces\RoleInterface;
use App\Modules\Role\Domain\Exceptions\RoleNotFoundException;


class GetRoleByIdUseCase
{
    public function __construct(
        private RoleInterface $roleInterface,
    ) {}

    //--------------------------------------------------------------------------
    // EJECUTAR CASO DE USO -> Obtener un rol por ID
    //--------------------------------------------------------------------------
    public function execute(int $id): RoleDTO
    {
        $role = $this->roleInterface->findById($id);

        if (!$role) {
            throw new RoleNotFoundException();
        }

        return RoleMapper::toDTO($role);
    }
}

