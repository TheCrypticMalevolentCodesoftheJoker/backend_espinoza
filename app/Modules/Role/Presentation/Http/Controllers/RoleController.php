<?php

namespace App\Modules\Role\Presentation\Http\Controllers;

use App\Modules\Role\Application\Services\RoleService;
use App\Modules\Role\Application\UseCases\GetRoleByIdUseCase;
use App\Modules\Role\Application\UseCases\ListRolesUseCase;
use App\Modules\Role\Presentation\Http\Requests\StoreRoleRequest;
use App\Modules\Role\Presentation\Http\Requests\UpdateRoleRequest;

class RoleController
{
    public function __construct(
        private readonly RoleService $roleService,
        private readonly ListRolesUseCase $listRolesUseCase,
        private readonly GetRoleByIdUseCase $getRoleByIdUseCase,
    ) {}

    //----------------------------------------------------------------------------------
    // LISTAR ROLES
    //----------------------------------------------------------------------------------
    public function index()
    {
        $data = $this->listRolesUseCase->execute();
        return view('role::role.index', $data);
    }

    //----------------------------------------------------------------------------------
    // VER ROL
    //----------------------------------------------------------------------------------
    public function show(int $id)
    {
        $role = $this->getRoleByIdUseCase->execute($id);
        return view('role::role.show', compact('role'));
    }

    //----------------------------------------------------------------------------------
    // FORM CREAR
    //----------------------------------------------------------------------------------
    public function create()
    {
        return view('role::role.create');
    }

    //----------------------------------------------------------------------------------
    // CREAR ROL
    //----------------------------------------------------------------------------------
    public function store(StoreRoleRequest $storeRoleRequest)
    {
        $this->roleService->createRole(
            $storeRoleRequest->toDto()
        );

        return redirect()
            ->route('role.index')
            ->with('notification', [
                'statusCode' => 201,
                'errorCode' => null,
                'message' => 'Rol creado correctamente.'
            ]);
    }

    //----------------------------------------------------------------------------------
    // FORM ACTUALIZAR
    //----------------------------------------------------------------------------------
    public function edit(int $id)
    {
        $role = $this->getRoleByIdUseCase->execute($id);
        return view('role::role.edit', compact('role'));
    }

    //----------------------------------------------------------------------------------
    // ACTUALIZAR ROL
    //----------------------------------------------------------------------------------
    public function update(int $id, UpdateRoleRequest $updateRoleRequest)
    {
        $this->roleService->updateRole(
            $id,
            $updateRoleRequest->toDto()
        );

        return redirect()
            ->route('role.show', $id)
            ->with('notification', [
                'statusCode' => 200,
                'errorCode' => null,
                'message' => 'Rol actualizado correctamente.'
            ]);
    }

    //----------------------------------------------------------------------------------
    // ACTIVAR ROL
    //----------------------------------------------------------------------------------
    public function activate(int $id)
    {
        $this->roleService->activateRole($id);

        return redirect()
            ->route('role.show', $id)
            ->with('notification', [
                'statusCode' => 200,
                'errorCode' => null,
                'message' => 'Rol activado correctamente.'
            ]);
    }


    //----------------------------------------------------------------------------------
    // DESACTIVAR ROL
    //----------------------------------------------------------------------------------
    public function deactivate(int $id)
    {
        $this->roleService->deactivateRole($id);

        return redirect()
            ->route('role.show', $id)
            ->with('notification', [
                'statusCode' => 200,
                'errorCode' => null,
                'message' => 'Rol desactivado correctamente.'
            ]);
    }

    //----------------------------------------------------------------------------------
    // ELIMINAR ROL
    //----------------------------------------------------------------------------------
    public function destroy(int $id)
    {
        $this->roleService->deleteRole($id);

        return redirect()
            ->route('role.index')
            ->with('notification', [
                'statusCode' => 200,
                'errorCode' => null,
                'message' => 'Rol eliminado correctamente.'
            ]);
    }
}
