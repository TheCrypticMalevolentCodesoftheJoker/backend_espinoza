<?php

namespace App\Modules\Catalog\Product\Domain\Interfaces\Product;

use App\Modules\Catalog\Product\Domain\Entities\ProductEntity;

interface ProductInterface
{
    //--------------------------------------------------------------------------
    // CONSULTAS -> Métodos de lectura de productos
    //--------------------------------------------------------------------------
    public function findAll(): array;

    public function findById(int $id): ?ProductEntity;

    public function findByName(string $name): ?ProductEntity;

    //--------------------------------------------------------------------------
    // PERSISTENCIA -> Métodos de escritura y eliminación de productos
    //--------------------------------------------------------------------------

    public function save(ProductEntity $product): int;

    public function update(ProductEntity $product): void;

    public function delete(int $id): void;
}
