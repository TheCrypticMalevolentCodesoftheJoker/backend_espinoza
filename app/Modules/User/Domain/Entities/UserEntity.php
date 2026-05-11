<?php

namespace App\Modules\User\Domain\Entities;

use App\Modules\User\Domain\ValueObjects\UserName;
use App\Modules\User\Domain\ValueObjects\UserEmail;
use App\Modules\User\Domain\ValueObjects\UserPassword;
use App\Modules\User\Domain\ValueObjects\UserRoleId;

class UserEntity
{
    private function __construct(
        private int $id,
        private UserRoleId $roleId,
        private UserName $name,
        private UserEmail $email,
        private UserPassword $password,
        private bool $status,
        private ?\DateTime $createdAt,
        private ?\DateTime $updatedAt,
    ) {}

    /*--------------------------------------------------------------------------
    MÉTODOS DE CREACIÓN
    --------------------------------------------------------------------------*/
    public static function create(UserRoleId $roleId, UserName $name, UserEmail $email, UserPassword $password): self
    {
        return new self(
            id: 0,
            roleId: $roleId,
            name: $name,
            email: $email,
            password: $password,
            status: true,
            createdAt: null,
            updatedAt: null,
        );
    }

    /*--------------------------------------------------------------------------
    MÉTODOS DE RECONSTRUCCIÓN
    --------------------------------------------------------------------------*/
    public static function reconstitute(int $id, UserRoleId $roleId, UserName $name, UserEmail $email, UserPassword $password, bool $status, ?\DateTime $createdAt, ?\DateTime $updatedAt): self
    {
        return new self(
            id: $id,
            roleId: $roleId,
            name: $name,
            email: $email,
            password: $password,
            status: $status,
            createdAt: $createdAt,
            updatedAt: $updatedAt,
        );
    }

    /*--------------------------------------------------------------------------
    MÉTODOS DE CONSULTA (Getters)
    --------------------------------------------------------------------------*/

    public function getId(): int
    {
        return $this->id;
    }
    public function getRoleId(): int
    {
        return $this->roleId->value();
    }
    public function getName(): string
    {
        return $this->name->value();
    }
    public function getEmail(): string
    {
        return $this->email->value();
    }
    public function getPassword(): string
    {
        return $this->password->value();
    }
    public function getStatus(): bool
    {
        return $this->status;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /*--------------------------------------------------------------------------
    MÉTODOS DE COMPORTAMIENTO
    --------------------------------------------------------------------------*/
    public function changeRole(UserRoleId $roleId): void
    {
        $this->roleId = $roleId;
    }

    public function changeName(UserName $name): void
    {
        $this->name = $name;
    }

    public function changeEmail(UserEmail $email): void
    {
        $this->email = $email;
    }

    public function changePassword(UserPassword $password): void
    {
        $this->password = $password;
    }

    public function activate(): void
    {
        $this->status = true;
    }

    public function deactivate(): void
    {
        $this->status = false;
    }
}
