<?php

namespace App\Modules\Catalog\Category\Domain\Entities;

use App\Modules\Catalog\Category\Domain\ValueObjects\CategoryName;

class CategoryEntity
{
    private function __construct(
        private int $id,
        private CategoryName $name,
        private bool $status
    ) {}

    /*--------------------------------------------------------------------------
    MÉTODOS DE CREACIÓN
    --------------------------------------------------------------------------*/
    public static function create(CategoryName $name): self
    {
        return new self(
            id: 0,
            name: $name,
            status: true
        );
    }

    /*--------------------------------------------------------------------------
    MÉTODOS DE RECONSTRUCCIÓN
    --------------------------------------------------------------------------*/
    public static function reconstitute(int $id, CategoryName $name, bool $status): self
    {
        return new self(
            id: $id,
            name: $name,
            status: $status
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
    public function getStatus(): bool
    {
        return $this->status;
    }

    /*--------------------------------------------------------------------------
    MÉTODOS DE COMPORTAMIENTO
    --------------------------------------------------------------------------*/
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
