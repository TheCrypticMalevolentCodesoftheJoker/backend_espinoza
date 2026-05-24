<?php

namespace App\Modules\User\Presentation\Controllers;

use App\Modules\User\Application\UseCases\Read\GetUserByIdUseCase;
use App\Modules\User\Application\UseCases\Read\ListUsersUseCase;
use App\Modules\User\Application\UseCases\Write\ActivateUserUseCase;
use App\Modules\User\Application\UseCases\Write\CreateUserUseCase;
use App\Modules\User\Application\UseCases\Write\DeactivateUserUseCase;
use App\Modules\User\Application\UseCases\Write\DeleteUserUseCase;
use App\Modules\User\Application\UseCases\Write\UpdateUserUseCase;
use App\Modules\User\Presentation\Requests\StoreUserRequest;
use App\Modules\User\Presentation\Requests\UpdateUserRequest;
use App\Shared\Responses\ApiResponse;

class UserController
{
    public function __construct(
        //--------------------------------------------------------------------------
        // CASOS DE USO -> Lectura de datos
        //--------------------------------------------------------------------------
        private readonly ListUsersUseCase $listUsersUseCase,
        private readonly GetUserByIdUseCase $getUserByIdUseCase,
        //--------------------------------------------------------------------------
        // CASOS DE USO -> Escritura y persistencia de datos
        //--------------------------------------------------------------------------
        private readonly CreateUserUseCase $createUserUseCase,
        private readonly UpdateUserUseCase $updateUserUseCase,
        private readonly ActivateUserUseCase $activateUserUseCase,
        private readonly DeactivateUserUseCase $deactivateUserUseCase,
        private readonly DeleteUserUseCase $deleteUserUseCase,
    ) {}

    //--------------------------------------------------------------------------
    // ACCIÓN -> Listar todos los usuarios
    //--------------------------------------------------------------------------
    public function index()
    {
        $users = $this->listUsersUseCase->execute();

        return ApiResponse::success(
            statusCode: 200,
            message: 'Usuarios listados correctamente',
            data: $users
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Obtener usuario por ID
    //--------------------------------------------------------------------------
    public function show(int $id)
    {
        $user = $this->getUserByIdUseCase->execute($id);

        return ApiResponse::success(
            statusCode: 200,
            message: 'Usuario obtenido correctamente',
            data: $user
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Crear un nuevo usuario
    //--------------------------------------------------------------------------
    public function store(StoreUserRequest $storeUserRequest)
    {
        $this->createUserUseCase->execute($storeUserRequest->toDto());

        return ApiResponse::success(
            statusCode: 201,
            message: 'Usuario creado correctamente.'
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Actualizar usuario existente
    //--------------------------------------------------------------------------
    public function update(int $id, UpdateUserRequest $updateUserRequest)
    {
        $this->updateUserUseCase->execute($id, $updateUserRequest->toDto());

        return ApiResponse::success(
            statusCode: 200,
            message: 'Usuario actualizado correctamente.'
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Activar usuario
    //--------------------------------------------------------------------------
    public function activate(int $id)
    {
        $this->activateUserUseCase->execute($id);

        return ApiResponse::success(
            statusCode: 200,
            message: 'Usuario activado correctamente.'
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Desactivar usuario
    //--------------------------------------------------------------------------
    public function deactivate(int $id)
    {
        $this->deactivateUserUseCase->execute($id);

        return ApiResponse::success(
            statusCode: 200,
            message: 'Usuario desactivado correctamente.'
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Eliminar un usuario
    //--------------------------------------------------------------------------
    public function destroy(int $id)
    {
        $this->deleteUserUseCase->execute($id);

        return ApiResponse::success(
            statusCode: 200,
            message: 'Usuario eliminado correctamente.'
        );
    }
}
