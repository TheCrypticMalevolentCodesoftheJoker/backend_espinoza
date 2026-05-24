<?php

namespace App\Modules\User\Infrastructure\Persistence\Repositories;

use App\Modules\User\Domain\Entities\UserEntity;
use App\Modules\User\Domain\Interfaces\UserInterface;
use App\Modules\User\Domain\ValueObjects\UserName;
use App\Modules\User\Domain\ValueObjects\UserEmail;
use App\Modules\User\Domain\ValueObjects\UserPassword;
use App\Modules\User\Domain\ValueObjects\UserRoleId;
use App\Modules\User\Infrastructure\Persistence\Models\TblUser;

class EloquentUserRepository implements UserInterface
{
    //--------------------------------------------------------------------------
    // CONSULTA -> Obtener todos los usuarios
    //--------------------------------------------------------------------------
    public function findAll(): array
    {
        return TblUser::all()
            ->map(fn($model) => UserEntity::reconstitute(
                id: $model->id,
                roleId: new UserRoleId($model->role_id),
                name: new UserName($model->name),
                email: new UserEmail($model->email),
                password: new UserPassword($model->password),
                status: $model->status,
                createdAt: $model->created_at?->toDateTime(),
                updatedAt: $model->updated_at?->toDateTime(),
            ))
            ->toArray();
    }

    //--------------------------------------------------------------------------
    // CONSULTA -> Obtener usuario por ID
    //--------------------------------------------------------------------------
    public function findById(int $id): ?UserEntity
    {
        $model = TblUser::find($id);

        return $model ? UserEntity::reconstitute(
            id: $model->id,
            roleId: new UserRoleId($model->role_id),
            name: new UserName($model->name),
            email: new UserEmail($model->email),
            password: new UserPassword($model->password),
            status: $model->status,
            createdAt: $model->created_at?->toDateTime(),
            updatedAt: $model->updated_at?->toDateTime(),
        ) : null;
    }

    //--------------------------------------------------------------------------
    // CONSULTA -> Obtener usuario por correo electrónico
    //--------------------------------------------------------------------------
    public function findByEmail(string $email): ?UserEntity
    {
        $model = TblUser::where('email', $email)->first();

        return $model ? UserEntity::reconstitute(
            id: $model->id,
            roleId: new UserRoleId($model->role_id),
            name: new UserName($model->name),
            email: new UserEmail($model->email),
            password: new UserPassword($model->password),
            status: $model->status,
            createdAt: $model->created_at?->toDateTime(),
            updatedAt: $model->updated_at?->toDateTime(),
        ) : null;
    }

    //--------------------------------------------------------------------------
    // PERSISTENCIA -> Guardar un nuevo usuario
    //--------------------------------------------------------------------------
    public function save(UserEntity $userEntity): void
    {
        TblUser::create([
            'role_id'  => $userEntity->getRoleId(),
            'name'     => $userEntity->getName(),
            'email'    => $userEntity->getEmail(),
            'password' => $userEntity->getPassword(),
            'status'   => $userEntity->getStatus(),
        ]);
    }

    //--------------------------------------------------------------------------
    // PERSISTENCIA -> Actualizar usuario existente
    //--------------------------------------------------------------------------
    public function update(UserEntity $user): void
    {
        $model = TblUser::findOrFail($user->getId());
        $model->update([
            'role_id'  => $user->getRoleId(),
            'name'     => $user->getName(),
            'email'    => $user->getEmail(),
            'password' => $user->getPassword(),
            'status'   => $user->getStatus(),
        ]);
    }

    //--------------------------------------------------------------------------
    // PERSISTENCIA -> Eliminar usuario por ID
    //--------------------------------------------------------------------------
    public function delete(int $id): void
    {
        TblUser::destroy($id);
    }
}
