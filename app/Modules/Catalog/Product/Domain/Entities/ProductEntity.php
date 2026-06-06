<?php

//--------------------------------------------------------------------------
// ProductEntity: Entidad principal (Aggregate Root) que define la estructura y comportamiento de un producto
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Product\Domain\Entities;

use Illuminate\Support\Str;
use App\Modules\Catalog\Product\Domain\ValueObjects\Product\ProductName;
use App\Modules\Catalog\Product\Domain\ValueObjects\Product\ProductStock;
use App\Modules\Catalog\Product\Domain\ValueObjects\Product\ProductLength;
use App\Modules\Catalog\Product\Domain\ValueObjects\Product\ProductWidth;
use App\Modules\Catalog\Product\Domain\ValueObjects\Product\ProductThickness;

class ProductEntity
{
    private function __construct(
        private int $id,
        private string $code,
        private int $categoryId,
        private int $brandId,
        private ProductName $name,
        private ?string $description,
        private ProductLength $length,
        private ProductWidth $width,
        private ProductThickness $thickness,
        private ProductStock $stock,
        private bool $status,
        private ?\DateTime $createdAt,
        private ?\DateTime $updatedAt,
    ) {}

    public static function generateCode(int $id): string
    {
        $random = strtoupper(Str::random(8));
        $date = date('dmY');

        return "PRD{$date}{$random}";
    }

    public static function create(
        int $categoryId,
        int $brandId,
        ProductName $name,
        ?string $description,
        ProductLength $length,
        ProductWidth $width,
        ProductThickness $thickness,
        ProductStock $stock,
    ): self {
        return new self(
            id: 0,
            code: self::generateCode(0),
            categoryId: $categoryId,
            brandId: $brandId,
            name: $name,
            description: $description,
            length: $length,
            width: $width,
            thickness: $thickness,
            stock: $stock,
            status: true,
            createdAt: null,
            updatedAt: null,
        );
    }

    public static function reconstitute(
        int $id,
        string $code,
        int $categoryId,
        int $brandId,
        ProductName $name,
        ?string $description,
        ProductLength $length,
        ProductWidth $width,
        ProductThickness $thickness,
        ProductStock $stock,
        bool $status,
        ?\DateTime $createdAt,
        ?\DateTime $updatedAt,
    ): self {
        return new self(
            id: $id,
            code: $code,
            categoryId: $categoryId,
            brandId: $brandId,
            name: $name,
            description: $description,
            length: $length,
            width: $width,
            thickness: $thickness,
            stock: $stock,
            status: $status,
            createdAt: $createdAt,
            updatedAt: $updatedAt,
        );
    }

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
        return $this->name->value();
    }
    public function getDescription(): ?string
    {
        return $this->description;
    }
    public function getLength(): string
    {
        return $this->length->value();
    }
    public function getWidth(): string
    {
        return $this->width->value();
    }
    public function getThickness(): string
    {
        return $this->thickness->value();
    }
    public function getStock(): int
    {
        return $this->stock->value();
    }
    public function getStatus(): bool
    {
        return $this->status;
    }
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function changeCode(string $code): void
    {
        $this->code = $code;
    }
    public function changeCategoryId(int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }
    public function changeBrandId(int $brandId): void
    {
        $this->brandId = $brandId;
    }
    public function changeName(ProductName $name): void
    {
        $this->name = $name;
    }
    public function changeDescription(?string $description): void
    {
        $this->description = $description;
    }
    public function changeLength(ProductLength $length): void
    {
        $this->length = $length;
    }
    public function changeWidth(ProductWidth $width): void
    {
        $this->width = $width;
    }
    public function changeThickness(ProductThickness $thickness): void
    {
        $this->thickness = $thickness;
    }
    public function changeStock(ProductStock $stock): void
    {
        $this->stock = $stock;
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
