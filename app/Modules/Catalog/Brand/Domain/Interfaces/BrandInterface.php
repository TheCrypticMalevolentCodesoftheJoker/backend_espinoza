<?php

namespace App\Modules\Catalog\Brand\Domain\Interfaces;

use App\Modules\Catalog\Brand\Domain\Entities\BrandEntity;

interface BrandInterface
{
    public function findAll(): array;

    public function save(BrandEntity $brand): BrandEntity;

    public function findById(int $id): ?BrandEntity;

    public function findByName(string $name): ?BrandEntity;

    public function update(BrandEntity $brand): BrandEntity;

    public function delete(int $id): void;
}
