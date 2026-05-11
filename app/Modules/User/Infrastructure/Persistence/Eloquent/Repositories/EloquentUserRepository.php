<?php

namespace App\Modules\User\Infrastructure\Persistence\Eloquent\Repositories;

use App\Modules\User\Domain\Entities\UserEntity;
use App\Modules\User\Domain\Interfaces\UserInterface;
use App\Modules\User\Domain\ValueObjects\UserName;
use App\Modules\User\Domain\ValueObjects\UserEmail;
use App\Modules\User\Domain\ValueObjects\UserPassword;
use App\Modules\User\Domain\ValueObjects\UserRoleId;
use App\Modules\User\Infrastructure\Persistence\Eloquent\Models\TblUser;

class EloquentUserRepository implements UserInterface
{
    //--------------------------------------------------------------------------
    // OPERACIONES DE LECTURA
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
    //----------------------------------------------------------------------
    // KPIs / AGREGACIONES
    //----------------------------------------------------------------------

    public function countAll(): int
    {
        return TblUser::count();
    }

    public function countActive(): int
    {
        return TblUser::where('status', 1)->count();
    }

    public function countInactive(): int
    {
        return TblUser::where('status', 0)->count();
    }
    //--------------------------------------------------------------------------
    // OPERACIONES DE ESCRITURA
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

    public function delete(int $id): void
    {
        TblUser::destroy($id);
    }
}
