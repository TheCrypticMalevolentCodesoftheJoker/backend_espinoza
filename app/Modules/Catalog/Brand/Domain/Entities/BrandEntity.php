<?php

namespace App\Modules\Catalog\Brand\Domain\Entities;

use App\Modules\Catalog\Brand\Domain\ValueObjects\BrandName;

class BrandEntity
{
    private function __construct(
        private int $id,
        private BrandName $name,
        private bool $status
    ) {}
    /*--------------------------------------------------------------------------
    MÉTODOS DE CREACIÓN
    --------------------------------------------------------------------------*/

    public static function create(BrandName $name): self
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
    public static function reconstitute(int $id, BrandName $name, bool $status): self
    {
        return new self($id, $name, $status);
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
    public function rename(BrandName $name): void
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
