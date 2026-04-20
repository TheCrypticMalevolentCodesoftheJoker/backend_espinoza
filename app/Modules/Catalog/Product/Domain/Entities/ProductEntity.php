<?php

namespace App\Modules\Catalog\Product\Domain\Entities;

class ProductEntity
{
    private function __construct(
        private int $id,
        public string $code,
        private int $categoryId,
        private int $brandId,
        private string $name,
        private ?string $description,
        private string $unitMeasure,
        private int $stock,
        private bool $status
    ) {}

    /*----------------------------------------------------------------------
    MÉTODOS DE CREACIÓN
    ----------------------------------------------------------------------*/
    public static function create(
        int $categoryId,
        int $brandId,
        string $name,
        ?string $description,
        string $unitMeasure,
        int $stock,
    ): self {
        return new self(
            id: 0,
            code: self::generateCode(),
            categoryId: $categoryId,
            brandId: $brandId,
            name: $name,
            description: $description,
            unitMeasure: $unitMeasure,
            stock: $stock,
            status: true
        );
    }

    /*----------------------------------------------------------------------
    MÉTODOS DE RECONSTRUCCIÓN
    ----------------------------------------------------------------------*/
    public static function reconstitute(
        int $id,
        string $code,
        int $categoryId,
        int $brandId,
        string $name,
        ?string $description,
        string $unitMeasure,
        int $stock,
        bool $status
    ): self {
        return new self(
            id: $id,
            code: $code,
            categoryId: $categoryId,
            brandId: $brandId,
            name: $name,
            description: $description,
            unitMeasure: $unitMeasure,
            stock: $stock,
            status: $status
        );
    }
    /*----------------------------------------------------------------------
    GETTERS
    ----------------------------------------------------------------------*/
    public function getId(): int
    {
        return $this->id;
    }
    public function getCode(): string
    {
        return $this->code;
    }
    public function getCategoryId(): int
    {
        return $this->categoryId;
    }
    public function getBrandId(): int
    {
        return $this->brandId;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getDescription(): ?string
    {
        return $this->description;
    }
    public function getUnitMeasure(): string
    {
        return $this->unitMeasure;
    }
    public function getStock(): int
    {
        return $this->stock;
    }
    public function getStatus(): bool
    {
        return $this->status;
    }

    /*----------------------------------------------------------------------
    COMPORTAMIENTO DE DOMINIO
    ----------------------------------------------------------------------*/
    public function rename(string $name): void
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

    /*----------------------------------------------------------------------
    MÉTODOS PRIVADOS AUXILIARES
    ----------------------------------------------------------------------*/
    private static function generateCode(): string
    {
        return 'PRD-' . strtoupper(bin2hex(random_bytes(4)));
    }
}
