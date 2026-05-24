<?php

namespace App\Modules\User\Application\UseCases\Write;

use App\Modules\User\Domain\Exceptions\UserNotFoundException;
use App\Modules\User\Domain\Interfaces\UserInterface;

class DeactivateUserUseCase
{
    public function __construct(
        private UserInterface $userInterface,
    ) {}

    //--------------------------------------------------------------------------
    // EJECUTAR CASO DE USO -> Desactivar un usuario por ID
    //--------------------------------------------------------------------------
    public function execute(int $id): void
    {
        $entity = $this->userInterface->findById($id);

        if (!$entity) {
            throw new UserNotFoundException();
        }

        $entity->deactivate();

        $this->userInterface->update($entity);
    }
}


