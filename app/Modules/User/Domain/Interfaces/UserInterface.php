<?php

namespace App\Modules\User\Domain\Interfaces;

use App\Modules\User\Domain\Entities\UserEntity;

interface UserInterface
{
    //--------------------------------------------------------------------------
    // OPERACIONES DE LECTURA
    //--------------------------------------------------------------------------
    public function findAll(): array;

    public function findById(int $id): ?UserEntity;

    public function findByEmail(string $email): ?UserEntity;

    //----------------------------------------------------------------------
    // KPIs / AGREGACIONES
    //----------------------------------------------------------------------
    public function countAll(): int;

    public function countActive(): int;

    public function countInactive(): int;

    //--------------------------------------------------------------------------
    // OPERACIONES DE ESCRITURA
    //--------------------------------------------------------------------------
    public function save(UserEntity $user): void;

    public function update(UserEntity $user): void;

    public function delete(int $id): void;
}
