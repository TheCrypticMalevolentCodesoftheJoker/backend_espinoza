<?php

namespace App\Modules\Catalog\Product\Domain\Interfaces;

use App\Modules\Catalog\Product\Domain\Entities\DiscountEntity;
use App\Modules\Catalog\Product\Domain\Entities\ImageEntity;
use App\Modules\Catalog\Product\Domain\Entities\PriceEntity;
use App\Modules\Catalog\Product\Domain\Entities\ProductEntity;

interface ProductInterface
{
    //--------------------------------------------------------------------------
    // OPERACIONES DE LECTURA
    //--------------------------------------------------------------------------
    public function findAll(): array;
    public function getNextSequenceValue(): int;

    public function findById(int $id): ?ProductEntity;

    public function findByCode(string $code): ?ProductEntity;

    public function countAll(): int;
    public function countActive(): int;
    public function countInactive(): int;
    //--------------------------------------------------------------------------
    // OPERACIONES DE ESCRITURA (AGGREGATE ROOT)
    //--------------------------------------------------------------------------

    public function save(ProductEntity $product): int;

    public function update(ProductEntity $product): void;

    public function delete(int $id): void;

    //--------------------------------------------------------------------------
    // OPERACIONES DE ESCRITURA (CHILD ENTITIES)
    //--------------------------------------------------------------------------

    public function replaceImages(int $productId, array $images): void;

    public function saveCurrentPrice(int $productId, PriceEntity $price): void;

    public function saveCurrentDiscount(int $productId, DiscountEntity $discount): void;
}
