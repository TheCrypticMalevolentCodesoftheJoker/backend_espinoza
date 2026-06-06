<?php
//--------------------------------------------------------------------------
// RoleController: Punto de entrada HTTP para operaciones CRUD del módulo Role.
// Delega toda la lógica de negocio a los casos de uso correspondientes.
//--------------------------------------------------------------------------

namespace App\Modules\Role\Presentation\Controllers;

use App\Modules\Role\Application\UseCases\Write\ActivateRoleUseCase;
use App\Modules\Role\Application\UseCases\Write\CreateRoleUseCase;
use App\Modules\Role\Application\UseCases\Write\DeactivateRoleUseCase;
use App\Modules\Role\Application\UseCases\Write\DeleteRoleUseCase;
use App\Modules\Role\Application\UseCases\Read\GetRoleByIdUseCase;
use App\Modules\Role\Application\UseCases\Read\ListActiveRolesUseCase;
use App\Modules\Role\Application\UseCases\Read\ListRolesUseCase;
use App\Modules\Role\Application\UseCases\Write\UpdateRoleUseCase;
use App\Modules\Role\Presentation\Requests\StoreRoleRequest;
use App\Modules\Role\Presentation\Requests\UpdateRoleRequest;
use App\Shared\Responses\ApiResponse;

class RoleController
{
    public function __construct(
        //--------------------------------------------------------------------------
        // CASOS DE USO -> Lectura de datos
        //--------------------------------------------------------------------------
        private readonly ListRolesUseCase $listRolesUseCase,
        private readonly ListActiveRolesUseCase $listActiveRolesUseCase,
        private readonly GetRoleByIdUseCase $getRoleByIdUseCase,
        //--------------------------------------------------------------------------
        // CASOS DE USO -> Escritura y persistencia de datos
        //--------------------------------------------------------------------------
        private readonly CreateRoleUseCase $createRoleUseCase,
        private readonly UpdateRoleUseCase $updateRoleUseCase,
        private readonly ActivateRoleUseCase $activateRoleUseCase,
        private readonly DeactivateRoleUseCase $deactivateRoleUseCase,
        private readonly DeleteRoleUseCase $deleteRoleUseCase
    ) {}

    //--------------------------------------------------------------------------
    // ACCIÓN -> Listar todos los roles
    //--------------------------------------------------------------------------
    public function index()
    {
        $roles = $this->listRolesUseCase->execute();

        return ApiResponse::success(
            statusCode: 200,
            message: 'Roles listados correctamente',
            data: $roles
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Listar roles activos
    //--------------------------------------------------------------------------
    public function active()
    {
        $roles = $this->listActiveRolesUseCase->execute();

        return ApiResponse::success(
            statusCode: 200,
            message: 'Roles activos listados correctamente',
            data: $roles
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Obtener rol por ID
    //--------------------------------------------------------------------------
    public function show(int $id)
    {
        $rol = $this->getRoleByIdUseCase->execute($id);

        return ApiResponse::success(
            statusCode: 200,
            message: 'Rol obtenido correctamente',
            data: $rol
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Crear un nuevo rol
    //--------------------------------------------------------------------------
    public function store(StoreRoleRequest $storeRoleRequest)
    {
        $this->createRoleUseCase->execute($storeRoleRequest->toDto());

        return ApiResponse::success(
            statusCode: 201,
            message: 'Rol creado correctamente.'
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Actualizar rol existente
    //--------------------------------------------------------------------------
    public function update(int $id, UpdateRoleRequest $updateRoleRequest)
    {
        $this->updateRoleUseCase->execute($id, $updateRoleRequest->toDto());

        return ApiResponse::success(
            statusCode: 200,
            message: 'Rol actualizado correctamente.'
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Activar rol
    //--------------------------------------------------------------------------
    public function activate(int $id)
    {
        $this->activateRoleUseCase->execute($id);

        return ApiResponse::success(
            statusCode: 200,
            message: 'Rol activado correctamente.'
        );
    }


    //--------------------------------------------------------------------------
    // ACCIÓN -> Desactivar rol
    //--------------------------------------------------------------------------
    public function deactivate(int $id)
    {
        $this->deactivateRoleUseCase->execute($id);

        return ApiResponse::success(
            statusCode: 200,
            message: 'Rol desactivado correctamente.'
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Eliminar un rol
    //--------------------------------------------------------------------------
    public function destroy(int $id)
    {
        $this->deleteRoleUseCase->execute($id);

        return ApiResponse::success(
            statusCode: 200,
            message: 'Rol eliminado correctamente.'
        );
    }
}
