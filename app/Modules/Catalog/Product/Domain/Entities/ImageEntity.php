<?php

namespace App\Modules\Catalog\Product\Domain\Entities;

use App\Modules\Catalog\Product\Domain\ValueObjects\Image\ImageType;

class ImageEntity
{
    private function __construct(
        private int $id,
        private int $productId,
        private string $url,
        private ImageType $type,
    ) {}

    //--------------------------------------------------------------------------
    // CREACIÓN -> Instanciar una nueva imagen
    //--------------------------------------------------------------------------
    public static function create(int $productId, string $url, ImageType $type): self
    {
        return new self(
            id: 0,
            productId: $productId,
            url: $url,
            type: $type
        );
    }

    //--------------------------------------------------------------------------
    // RECONSTRUCCIÓN -> Reconstituir imagen desde base de datos
    //--------------------------------------------------------------------------
    public static function reconstitute(int $id, int $productId, string $url, ImageType $type): self
    {
        return new self(
            id: $id,
            productId: $productId,
            url: $url,
            type: $type
        );
    }

    //--------------------------------------------------------------------------
    // CONSULTAS -> Getters de la entidad
    //--------------------------------------------------------------------------
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

    public function getType(): ImageType
    {
        return $this->type;
    }
}
