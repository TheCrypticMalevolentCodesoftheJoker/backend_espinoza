<?php

namespace App\Modules\Role\Application\Services;

use Illuminate\Support\Facades\DB;
use App\Modules\Role\Application\DTOs\StoreRoleDTO;
use App\Modules\Role\Application\DTOs\UpdateRoleDTO;
use App\Modules\Role\Application\UseCases\ActivateRoleUseCase;
use App\Modules\Role\Application\UseCases\CreateRoleUseCase;
use App\Modules\Role\Application\UseCases\DeactivateRoleUseCase;
use App\Modules\Role\Application\UseCases\DeleteRoleUseCase;
use App\Modules\Role\Application\UseCases\UpdateRoleUseCase;

class RoleService
{
    public function __construct(
        private CreateRoleUseCase $createRoleUseCase,
        private UpdateRoleUseCase $updateRoleUseCase,
        private ActivateRoleUseCase $activateRoleUseCase,
        private DeactivateRoleUseCase $deactivateRoleUseCase,
        private DeleteRoleUseCase $deleteRoleUseCase,
    ) {}
    //--------------------------------------------------------------------------
    // OPERACIONES DE ESCRITURA
    //--------------------------------------------------------------------------
    public function createRole(StoreRoleDTO $storeRoleDTO): void
    {
        DB::transaction(fn() => $this->createRoleUseCase->execute($storeRoleDTO));
    }

    public function updateRole(int $id, UpdateRoleDTO $updateRoleDTO): void
    {
        DB::transaction(fn() => $this->updateRoleUseCase->execute($id, $updateRoleDTO));
    }

    public function activateRole(int $id): void
    {
        DB::transaction(fn() => $this->activateRoleUseCase->execute($id));
    }

    public function deactivateRole(int $id): void
    {
        DB::transaction(fn() => $this->deactivateRoleUseCase->execute($id));
    }

    public function deleteRole(int $id): void
    {
        DB::transaction(fn() => $this->deleteRoleUseCase->execute($id));
    }
}

