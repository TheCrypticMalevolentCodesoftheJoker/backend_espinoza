<?php

namespace App\Modules\Catalog\Product\Application\DTOs\Read\Product;

use App\Modules\Catalog\Product\Application\DTOs\Read\Discount\DiscountDTO;
use App\Modules\Catalog\Product\Application\DTOs\Read\Price\PriceDTO;
use JsonSerializable;

class ProductDTO implements JsonSerializable
{
    public function __construct(
        public int $id,
        public string $code,
        public int $categoryId,
        public string $categoryName,
        public int $brandId,
        public string $brandName,
        public string $name,
        public ?string $description,
        public string $length,
        public string $width,
        public string $thickness,
        public int $stock,
        public bool $status,
        public ?string $createdAt,
        public ?string $updatedAt,

        public array $images = [],
        public ?PriceDTO $price = null,
        public ?DiscountDTO $discount = null,
    ) {}

    public function jsonSerialize(): mixed
    {
        return [
            'id'           => $this->id,
            'code'         => $this->code,
            'categoryId'   => $this->categoryId,
            'categoryName' => $this->categoryName,
            'brandId'      => $this->brandId,
            'brandName'    => $this->brandName,
            'name'         => $this->name,
            'description'  => $this->description,
            'length'       => $this->length,
            'width'        => $this->width,
            'thickness'    => $this->thickness,
            'stock'        => $this->stock,
            'status'       => $this->status,
            'createdAt'    => $this->createdAt,
            'updatedAt'    => $this->updatedAt,
            'images'       => $this->images,
            'price'        => $this->price,
            'discount'     => $this->discount,
        ];
    }
}
