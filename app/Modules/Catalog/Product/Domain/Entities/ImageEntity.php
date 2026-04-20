<?php

namespace App\Modules\Catalog\Product\Domain\Entities;

class ImageEntity
{
    private function __construct(
        private int $id,
        private int $productId,
        private string $url,
        private string $type
    ) {}

    /*----------------------------------------------------------------------
    CREACIÓN
    ----------------------------------------------------------------------*/
    public static function create(
        int $productId,
        string $url,
        string $type
    ): self {
        return new self(
            id: 0,
            productId: $productId,
            url: $url,
            type: $type
        );
    }

    /*----------------------------------------------------------------------
    RECONSTITUCIÓN
    ----------------------------------------------------------------------*/
    public static function reconstitute(
        int $id,
        int $productId,
        string $url,
        string $type
    ): self {
        return new self(
            id: $id,
            productId: $productId,
            url: $url,
            type: $type
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
    public function getUrl(): string
    {
        return $this->url;
    }
    public function getType(): string
    {
        return $this->type;
    }
}
