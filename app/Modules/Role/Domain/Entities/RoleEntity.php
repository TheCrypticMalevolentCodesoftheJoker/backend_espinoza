<?php

namespace App\Modules\Role\Domain\Entities;

use App\Modules\Role\Domain\ValueObjects\RoleName;
use App\Modules\Role\Domain\ValueObjects\RoleDescription;

class RoleEntity
{
    private function __construct(
        private int $id,
        private RoleName $name,
        private RoleDescription $description,
        private bool $status,
        private ?\DateTime $createdAt,
        private ?\DateTime $updatedAt,
    ) {}

    /*--------------------------------------------------------------------------
    MÉTODOS DE CREACIÓN
    --------------------------------------------------------------------------*/
    public static function create(RoleName $name, RoleDescription $description): self
    {
        return new self(
            id: 0,
            name: $name,
            description: $description,
            status: true,
            createdAt: null,
            updatedAt: null,
        );
    }

    /*--------------------------------------------------------------------------
    MÉTODOS DE RECONSTRUCCIÓN
    --------------------------------------------------------------------------*/
    public static function reconstitute(int $id, RoleName $name, RoleDescription $description, bool $status, ?\DateTime $createdAt, ?\DateTime $updatedAt): self
    {
        return new self(
            id: $id,
            name: $name,
            description: $description,
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
    public function getName(): string
    {
        return $this->name->value();
    }
    public function getDescription(): ?string
    {
        return $this->description->value();
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
    public function changeName(RoleName $name): void
    {
        $this->name = $name;
    }

    public function changeDescription(RoleDescription $description): void
    {
        $this->description = $description;
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

