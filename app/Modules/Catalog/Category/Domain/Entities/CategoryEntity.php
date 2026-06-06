<?php

//--------------------------------------------------------------------------
// CategoryEntity: Entidad que define la estructura y lógica de dominio de las categorías
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Category\Domain\Entities;

use App\Modules\Catalog\Category\Domain\ValueObjects\CategoryName;

class CategoryEntity
{
    private function __construct(
        private int $id,
        private CategoryName $name,
        private bool $status,
        private ?\DateTime $createdAt,
        private ?\DateTime $updatedAt,
    ) {}

    public static function create(CategoryName $name): self
    {
        return new self(
            id: 0,
            name: $name,
            status: true,
            createdAt: null,
            updatedAt: null,
        );
    }

    public static function reconstitute(int $id, CategoryName $name, bool $status, ?\DateTime $createdAt, ?\DateTime $updatedAt): self
    {
        return new self(
            id: $id,
            name: $name,
            status: $status,
            createdAt: $createdAt,
            updatedAt: $updatedAt,
        );
    }

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

    public function rename(CategoryName $name): void
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
