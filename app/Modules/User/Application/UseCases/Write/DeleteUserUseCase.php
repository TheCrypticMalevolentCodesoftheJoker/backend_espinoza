<?php
//--------------------------------------------------------------------------
// DeleteUserUseCase: Eliminación permanente de un usuario por su identificador.
//--------------------------------------------------------------------------

namespace App\Modules\User\Application\UseCases\Write;

use App\Modules\User\Domain\Exceptions\UserNotFoundException;
use App\Modules\User\Domain\Interfaces\UserInterface;

class DeleteUserUseCase
{
    public function __construct(
        private UserInterface $userInterface,
    ) {}

    //--------------------------------------------------------------------------
    // EJECUTAR CASO DE USO -> Eliminar un usuario por ID
    //--------------------------------------------------------------------------
    public function execute(int $id): void
    {
        $entity = $this->userInterface->findById($id);

        if (!$entity) {
            throw new UserNotFoundException();
        }

        $this->userInterface->delete($entity->getId());
    }
}


