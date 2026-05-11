<?php

namespace App\Modules\Catalog\Product\Domain\Entities;

use App\Modules\Catalog\Product\Domain\ValueObjects\ProductCode;
use App\Modules\Catalog\Product\Domain\ValueObjects\ProductName;
use App\Modules\Catalog\Product\Domain\ValueObjects\ProductStock;
use App\Modules\Catalog\Product\Domain\ValueObjects\ProductDimension;

class ProductEntity
{
    private function __construct(
        private int $id,
        private int $categoryId,
        private int $brandId,
        private ProductCode $code,
        private ProductName $name,
        private ?string $description,
        private string $unitMeasure,
        private ProductDimension $length,
        private ProductDimension $width,
        private ProductDimension $thickness,
        private ProductStock $stock,
        private bool $status,
        private array $images,
        private ?PriceEntity $currentPrice,
        private ?DiscountEntity $currentDiscount,
        private ?\DateTime $createdAt,
        private ?\DateTime $updatedAt,
    ) {}

    //--------------------------------------------------------------------------
    // MÉTODOS DE CREACIÓN
    //--------------------------------------------------------------------------
    public static function create(
        int $categoryId,
        int $brandId,
        ProductCode $code,
        ProductName $name,
        ?string $description,
        string $unitMeasure,
        ProductDimension $length,
        ProductDimension $width,
        ProductDimension $thickness,
        ProductStock $stock,
    ): self {
        return new self(
            id: 0,
            categoryId: $categoryId,
            brandId: $brandId,
            code: $code,
            name: $name,
            description: $description,
            unitMeasure: $unitMeasure,
            length: $length,
            width: $width,
            thickness: $thickness,
            stock: $stock,
            status: true,
            images: [],
            currentPrice: null,
            currentDiscount: null,
            createdAt: null,
            updatedAt: null,
        );
    }

    //--------------------------------------------------------------------------
    // MÉTODOS DE RECONSTRUCCIÓN
    //--------------------------------------------------------------------------
    public static function reconstitute(
        int $id,
        int $categoryId,
        int $brandId,
        ProductCode $code,
        ProductName $name,
        ?string $description,
        string $unitMeasure,
        ProductDimension $length,
        ProductDimension $width,
        ProductDimension $thickness,
        ProductStock $stock,
        bool $status,
        array $images,
        ?PriceEntity $currentPrice,
        ?DiscountEntity $currentDiscount,
        ?\DateTime $createdAt,
        ?\DateTime $updatedAt,
    ): self {
        return new self(
            id: $id,
            categoryId: $categoryId,
            brandId: $brandId,
            code: $code,
            name: $name,
            description: $description,
            unitMeasure: $unitMeasure,
            length: $length,
            width: $width,
            thickness: $thickness,
            stock: $stock,
            status: $status,
            images: $images,
            currentPrice: $currentPrice,
            currentDiscount: $currentDiscount,
            createdAt: $createdAt,
            updatedAt: $updatedAt,
        );
    }

    //--------------------------------------------------------------------------
    // MÉTODOS DE CONSULTA (GETTERS)
    //--------------------------------------------------------------------------
    public function getId(): int { return $this->id; }
    public function getCategoryId(): int { return $this->categoryId; }
    public function getBrandId(): int { return $this->brandId; }
    public function getCode(): string { return $this->code->value(); }
    public function getName(): string { return $this->name->value(); }
    public function getDescription(): ?string { return $this->description; }
    public function getUnitMeasure(): string { return $this->unitMeasure; }
    public function getLength(): string { return $this->length->value(); }
    public function getWidth(): string { return $this->width->value(); }
    public function getThickness(): string { return $this->thickness->value(); }
    public function getStock(): int { return $this->stock->value(); }
    public function getStatus(): bool { return $this->status; }
    public function getImages(): array { return $this->images; }
    public function getCurrentPrice(): ?PriceEntity { return $this->currentPrice; }
    public function getCurrentDiscount(): ?DiscountEntity { return $this->currentDiscount; }
    public function getCreatedAt(): ?\DateTime { return $this->createdAt; }
    public function getUpdatedAt(): ?\DateTime { return $this->updatedAt; }

    //--------------------------------------------------------------------------
    // MÉTODOS DE COMPORTAMIENTO
    //--------------------------------------------------------------------------
    public function activate(): void { $this->status = true; }
    public function deactivate(): void { $this->status = false; }

    public function changeCategoryId(int $categoryId): void { $this->categoryId = $categoryId; }
    public function changeBrandId(int $brandId): void { $this->brandId = $brandId; }
    public function changeCode(ProductCode $code): void { $this->code = $code; }
    public function changeName(ProductName $name): void { $this->name = $name; }
    public function changeDescription(?string $description): void { $this->description = $description; }
    public function changeUnitMeasure(string $unitMeasure): void { $this->unitMeasure = $unitMeasure; }
    public function changeLength(ProductDimension $length): void { $this->length = $length; }
    public function changeWidth(ProductDimension $width): void { $this->width = $width; }
    public function changeThickness(ProductDimension $thickness): void { $this->thickness = $thickness; }
    public function changeStock(ProductStock $stock): void { $this->stock = $stock; }
    public function replaceImages(array $images): void { $this->images = $images; }
}

