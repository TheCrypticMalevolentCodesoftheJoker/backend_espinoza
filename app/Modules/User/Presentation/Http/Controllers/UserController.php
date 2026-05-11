<?php

namespace App\Modules\User\Presentation\Http\Controllers;

use App\Modules\User\Application\Services\UserService;
use App\Modules\User\Application\UseCases\GetActiveRolesUseCase;
use App\Modules\User\Application\UseCases\GetUserByIdUseCase;
use App\Modules\User\Application\UseCases\ListUsersUseCase;
use App\Modules\User\Presentation\Http\Requests\StoreUserRequest;
use App\Modules\User\Presentation\Http\Requests\UpdateUserRequest;

class UserController
{
    public function __construct(
        private readonly UserService $userService,
        private readonly ListUsersUseCase $listUsersUseCase,
        private readonly GetUserByIdUseCase $getUserByIdUseCase,
        private readonly GetActiveRolesUseCase $getActiveRolesUseCase,
    ) {}

    //----------------------------------------------------------------------------------
    // LISTAR USUARIOS
    //----------------------------------------------------------------------------------
    public function index()
    {
        $data = $this->listUsersUseCase->execute();
        return view('user::user.index', $data);
    }

    //----------------------------------------------------------------------------------
    // VER USUARIO
    //----------------------------------------------------------------------------------
    public function show(int $id)
    {
        $user = $this->getUserByIdUseCase->execute($id);
        return view('user::user.show', compact('user'));
    }

    //----------------------------------------------------------------------------------
    // FORM CREAR
    //----------------------------------------------------------------------------------
    public function create()
    {
        $roles = $this->getActiveRolesUseCase->execute();
        return view('user::user.create', compact('roles'));
    }

    //----------------------------------------------------------------------------------
    // CREAR USUARIO
    //----------------------------------------------------------------------------------
    public function store(StoreUserRequest $storeUserRequest)
    {
        $this->userService->createUser(
            $storeUserRequest->toDto()
        );

        return redirect()
            ->route('user.index')
            ->with('notification', [
                'statusCode' => 201,
                'errorCode' => null,
                'message' => 'Usuario creado correctamente.'
            ]);
    }

    //----------------------------------------------------------------------------------
    // FORM ACTUALIZAR
    //----------------------------------------------------------------------------------
    public function edit(int $id)
    {
        $user = $this->getUserByIdUseCase->execute($id);
        $roles = $this->getActiveRolesUseCase->execute();
        return view('user::user.edit', compact('user', 'roles'));
    }

    //----------------------------------------------------------------------------------
    // ACTUALIZAR USUARIO
    //----------------------------------------------------------------------------------
    public function update(int $id, UpdateUserRequest $updateUserRequest)
    {
        $this->userService->updateUser(
            $id,
            $updateUserRequest->toDto()
        );

        return redirect()
            ->route('user.show', $id)
            ->with('notification', [
                'statusCode' => 200,
                'errorCode' => null,
                'message' => 'Usuario actualizado correctamente.'
            ]);
    }

    //----------------------------------------------------------------------------------
    // ACTIVAR USUARIO
    //----------------------------------------------------------------------------------
    public function activate(int $id)
    {
        $this->userService->activateUser($id);

        return redirect()
            ->route('user.show', $id)
            ->with('notification', [
                'statusCode' => 200,
                'errorCode' => null,
                'message' => 'Usuario activado correctamente.'
            ]);
    }


    //----------------------------------------------------------------------------------
    // DESACTIVAR USUARIO
    //----------------------------------------------------------------------------------
    public function deactivate(int $id)
    {
        $this->userService->deactivateUser($id);

        return redirect()
            ->route('user.show', $id)
            ->with('notification', [
                'statusCode' => 200,
                'errorCode' => null,
                'message' => 'Usuario desactivado correctamente.'
            ]);
    }

    //----------------------------------------------------------------------------------
    // ELIMINAR USUARIO
    //----------------------------------------------------------------------------------
    public function destroy(int $id)
    {
        $this->userService->deleteUser($id);

        return redirect()
            ->route('user.index')
            ->with('notification', [
                'statusCode' => 200,
                'errorCode' => null,
                'message' => 'Usuario eliminado correctamente.'
            ]);
    }
}
