<?php

namespace App\Modules\Catalog\Product\Domain\Entities;

class DimensionEntity
{
    private function __construct(
        private int $id,
        private int $productId,
        private string $length,
        private string $width,
        private string $thickness
    ) {}

    /*----------------------------------------------------------------------
    CREACIÓN
    ----------------------------------------------------------------------*/
    public static function create(
        int $productId,
        string $length,
        string $width,
        string $thickness
    ): self {
        return new self(
            id: 0,
            productId: $productId,
            length: $length,
            width: $width,
            thickness: $thickness
        );
    }

    /*----------------------------------------------------------------------
    RECONSTITUCIÓN
    ----------------------------------------------------------------------*/
    public static function reconstitute(
        int $id,
        int $productId,
        string $length,
        string $width,
        string $thickness
    ): self {
        return new self(
            id: $id,
            productId: $productId,
            length: $length,
            width: $width,
            thickness: $thickness
        );
    }

    /*----------------------------------------------------------------------
    GETTERS
    ----------------------------------------------------------------------*/
    public function getId(): int
    {
        return $this->id;
    }
    public function getProductId(): int
    {
        return $this->productId;
    }
    public function getLength(): string
    {
        return $this->length;
    }
    public function getWidth(): string
    {
        return $this->width;
    }
    public function getThickness(): string
    {
        return $this->thickness;
    }
}
