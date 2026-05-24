<?php

namespace App\Modules\Catalog\Brand\Domain\Interfaces;

use App\Modules\Catalog\Brand\Domain\Entities\BrandEntity;

interface BrandInterface
{
    //--------------------------------------------------------------------------
    // CONSULTAS -> Métodos de lectura de marcas
    //--------------------------------------------------------------------------
    public function findAll(): array;

    public function findActive(): array;

    public function findById(int $id): ?BrandEntity;

    public function findByName(string $name): ?BrandEntity;

    //--------------------------------------------------------------------------
    // PERSISTENCIA -> Métodos de escritura y eliminación de marcas
    //--------------------------------------------------------------------------
    public function save(BrandEntity $brand): void;

    public function update(BrandEntity $brand): void;

    public function delete(int $id): void;
}
