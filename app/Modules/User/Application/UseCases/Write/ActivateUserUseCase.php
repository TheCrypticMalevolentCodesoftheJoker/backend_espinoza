<?php

namespace App\Modules\User\Application\UseCases\Write;

use App\Modules\User\Domain\Exceptions\UserNotFoundException;
use App\Modules\User\Domain\Interfaces\UserInterface;

class ActivateUserUseCase
{
    public function __construct(
        private UserInterface $userInterface,
    ) {}

    //--------------------------------------------------------------------------
    // EJECUTAR CASO DE USO -> Activar un usuario por ID
    //--------------------------------------------------------------------------
    public function execute(int $id): void
    {
        $entity = $this->userInterface->findById($id);

        if (!$entity) {
            throw new UserNotFoundException();
        }

        $entity->activate();

        $this->userInterface->update($entity);
    }
}


