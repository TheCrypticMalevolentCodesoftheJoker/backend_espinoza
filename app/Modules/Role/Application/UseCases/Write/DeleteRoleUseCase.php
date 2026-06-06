<?php
//--------------------------------------------------------------------------
// DeleteRoleUseCase: Eliminación permanente de un rol por su identificador.
//--------------------------------------------------------------------------

namespace App\Modules\Role\Application\UseCases\Write;

use App\Modules\Role\Domain\Exceptions\RoleNotFoundException;
use App\Modules\Role\Domain\Interfaces\RoleInterface;

class DeleteRoleUseCase
{
    public function __construct(
        private RoleInterface $roleInterface,
    ) {}

    //--------------------------------------------------------------------------
    // EJECUTAR CASO DE USO -> Eliminar un rol por ID
    //--------------------------------------------------------------------------
    public function execute(int $id): void
    {
        $entity = $this->roleInterface->findById($id);

        if (!$entity) {
            throw new RoleNotFoundException();
        }

        $this->roleInterface->delete($entity->getId());
    }
}
