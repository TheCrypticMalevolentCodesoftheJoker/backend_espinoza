<?php
//--------------------------------------------------------------------------
// UpdateRoleUseCase: Actualización de un rol con validación de nombre único.
//--------------------------------------------------------------------------

namespace App\Modules\Role\Application\UseCases\Write;

use App\Modules\Role\Application\DTOs\Write\UpdateRoleDTO;
use App\Modules\Role\Domain\Exceptions\RoleAlreadyExistsException;
use App\Modules\Role\Domain\Exceptions\RoleNotFoundException;
use App\Modules\Role\Domain\Interfaces\RoleInterface;
use App\Modules\Role\Domain\ValueObjects\RoleName;

class UpdateRoleUseCase
{
    public function __construct(
        private RoleInterface $roleInterface,
    ) {}

    //--------------------------------------------------------------------------
    // EJECUTAR CASO DE USO -> Actualizar un rol existente
    //--------------------------------------------------------------------------
    public function execute(int $id, UpdateRoleDTO $updateRoleDTO): void
    {
        $entity = $this->roleInterface->findById($id);

        if (!$entity) {
            throw new RoleNotFoundException();
        }

        $newName = new RoleName($updateRoleDTO->name);

        $existing = $this->roleInterface->findByName($newName->value());
        if ($existing && $existing->getId() !== $entity->getId()) {
            throw new RoleAlreadyExistsException();
        }

        $entity->changeName($newName);

        $this->roleInterface->update($entity);
    }
}
