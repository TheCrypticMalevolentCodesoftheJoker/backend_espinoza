<?php

namespace App\Modules\User\Application\Services;

use Illuminate\Support\Facades\DB;
use App\Modules\User\Application\DTOs\StoreUserDTO;
use App\Modules\User\Application\DTOs\UpdateUserDTO;
use App\Modules\User\Application\UseCases\ActivateUserUseCase;
use App\Modules\User\Application\UseCases\CreateUserUseCase;
use App\Modules\User\Application\UseCases\DeactivateUserUseCase;
use App\Modules\User\Application\UseCases\DeleteUserUseCase;
use App\Modules\User\Application\UseCases\UpdateUserUseCase;

class UserService
{
    public function __construct(
        private CreateUserUseCase $createUserUseCase,
        private UpdateUserUseCase $updateUserUseCase,
        private ActivateUserUseCase $activateUserUseCase,
        private DeactivateUserUseCase $deactivateUserUseCase,
        private DeleteUserUseCase $deleteUserUseCase,
    ) {}
    //--------------------------------------------------------------------------
    // OPERACIONES DE ESCRITURA
    //--------------------------------------------------------------------------
    public function createUser(StoreUserDTO $storeUserDTO): void
    {
        DB::transaction(fn() => $this->createUserUseCase->execute($storeUserDTO));
    }

    public function updateUser(int $id, UpdateUserDTO $updateUserDTO): void
    {
        DB::transaction(fn() => $this->updateUserUseCase->execute($id, $updateUserDTO));
    }

    public function activateUser(int $id): void
    {
        DB::transaction(fn() => $this->activateUserUseCase->execute($id));
    }

    public function deactivateUser(int $id): void
    {
        DB::transaction(fn() => $this->deactivateUserUseCase->execute($id));
    }

    public function deleteUser(int $id): void
    {
        DB::transaction(fn() => $this->deleteUserUseCase->execute($id));
    }
}


