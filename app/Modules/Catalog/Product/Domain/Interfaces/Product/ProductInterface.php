<?php

//--------------------------------------------------------------------------
// ProductInterface: Contrato del repositorio para la gestión del catálogo de productos
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Product\Domain\Interfaces\Product;

use App\Modules\Catalog\Product\Domain\Entities\ProductEntity;

interface ProductInterface
{
    public function findAll(): array;

    public function findActive(): array;

    public function findById(int $id): ?ProductEntity;

    public function findByName(string $name): ?ProductEntity;

    public function save(ProductEntity $product): int;

    public function update(ProductEntity $product): void;

    public function delete(int $id): void;
}
