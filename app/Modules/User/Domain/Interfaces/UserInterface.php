<?php
//--------------------------------------------------------------------------
// UserInterface: Contrato de repositorio para consulta y persistencia de usuarios.
//--------------------------------------------------------------------------

namespace App\Modules\User\Domain\Interfaces;

use App\Modules\User\Domain\Entities\UserEntity;

interface UserInterface
{
    //--------------------------------------------------------------------------
    // CONSULTAS -> Métodos de lectura de usuarios
    //--------------------------------------------------------------------------
    public function findAll(): array;

    public function findById(int $id): ?UserEntity;

    public function findByEmail(string $email): ?UserEntity;

    //--------------------------------------------------------------------------
    // PERSISTENCIA -> Métodos de escritura y eliminación de usuarios
    //--------------------------------------------------------------------------
    public function save(UserEntity $user): void;

    public function update(UserEntity $user): void;

    public function delete(int $id): void;
}
