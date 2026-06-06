<?php
//--------------------------------------------------------------------------
// RoleEntity: Agregado raíz del dominio Role con estado, comportamiento y factory methods.
//--------------------------------------------------------------------------

namespace App\Modules\Role\Domain\Entities;

use App\Modules\Role\Domain\ValueObjects\RoleName;

class RoleEntity
{
    private function __construct(
        private int $id,
        private RoleName $name,
        private bool $status,
        private ?\DateTime $createdAt,
        private ?\DateTime $updatedAt,
    ) {}

    //--------------------------------------------------------------------------
    // CREACIÓN -> Instanciar una nueva entidad
    //--------------------------------------------------------------------------
    public static function create(RoleName $name): self
    {
        return new self(
            id: 0,
            name: $name,
            status: true,
            createdAt: null,
            updatedAt: null,
        );
    }

    //--------------------------------------------------------------------------
    // RECONSTRUCCIÓN -> Reconstituir entidad desde base de datos
    //--------------------------------------------------------------------------
    public static function reconstitute(int $id, RoleName $name, bool $status, ?\DateTime $createdAt, ?\DateTime $updatedAt): self
    {
        return new self(
            id: $id,
            name: $name,
            status: $status,
            createdAt: $createdAt,
            updatedAt: $updatedAt,
        );
    }

    //--------------------------------------------------------------------------
    // CONSULTAS -> Getters de la entidad
    //--------------------------------------------------------------------------

    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name->value();
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

    //--------------------------------------------------------------------------
    // COMPORTAMIENTO -> Lógica de dominio de la entidad
    //--------------------------------------------------------------------------
    public function changeName(RoleName $name): void
    {
        $this->name = $name;
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
