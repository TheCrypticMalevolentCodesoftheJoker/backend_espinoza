<?php

//--------------------------------------------------------------------------
// ImageEntity: Entidad que define la estructura y lógica de negocio de las imágenes de productos
//--------------------------------------------------------------------------

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

    public static function create(int $productId, string $url, ImageType $type): self
    {
        return new self(
            id: 0,
            productId: $productId,
            url: $url,
            type: $type
        );
    }

    public static function reconstitute(int $id, int $productId, string $url, ImageType $type): self
    {
        return new self(
            id: $id,
            productId: $productId,
            url: $url,
            type: $type
        );
    }

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
