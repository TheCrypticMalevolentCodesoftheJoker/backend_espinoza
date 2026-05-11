<?php

namespace App\Modules\Catalog\Product\Domain\Entities;

use App\Modules\Catalog\Product\Domain\ValueObjects\ImageType;

class ImageEntity
{
    private function __construct(
        private int $id,
        private int $productId,
        private string $path,
        private ImageType $type,
    ) {}

    //--------------------------------------------------------------------------
    // MÉTODOS DE CREACIÓN
    //--------------------------------------------------------------------------
    public static function create(int $productId, string $path, ImageType $type): self
    {
        return new self(id: 0, productId: $productId, path: $path, type: $type);
    }

    //--------------------------------------------------------------------------
    // MÉTODOS DE RECONSTRUCCIÓN
    //--------------------------------------------------------------------------
    public static function reconstitute(int $id, int $productId, string $path, ImageType $type): self
    {
        return new self(id: $id, productId: $productId, path: $path, type: $type);
    }

    //--------------------------------------------------------------------------
    // MÉTODOS DE CONSULTA (GETTERS)
    //--------------------------------------------------------------------------
    public function getId(): int { return $this->id; }
    public function getProductId(): int { return $this->productId; }
    public function getPath(): string { return $this->path; }
    public function getType(): string { return $this->type->value(); }
}

