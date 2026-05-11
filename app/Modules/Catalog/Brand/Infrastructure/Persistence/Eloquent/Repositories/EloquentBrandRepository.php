<?php

namespace App\Modules\Catalog\Brand\Infrastructure\Persistence\Eloquent\Repositories;

use App\Modules\Catalog\Brand\Domain\Entities\BrandEntity;
use App\Modules\Catalog\Brand\Domain\Interfaces\BrandInterface;
use App\Modules\Catalog\Brand\Domain\ValueObjects\BrandName;
use App\Modules\Catalog\Brand\Infrastructure\Persistence\Eloquent\Models\TblBrand;

class EloquentBrandRepository implements BrandInterface
{
    //--------------------------------------------------------------------------
    // OPERACIONES DE LECTURA
    //--------------------------------------------------------------------------
    public function findAll(): array
    {
        return TblBrand::all()
            ->map(fn($model) => BrandEntity::reconstitute(
                id: $model->id,
                name: new BrandName($model->name),
                status: $model->status,
                createdAt: $model->created_at?->toDateTime(),
                updatedAt: $model->updated_at?->toDateTime(),
            ))
            ->toArray();
    }

    public function findById(int $id): ?BrandEntity
    {
        $model = TblBrand::find($id);

        return $model ? BrandEntity::reconstitute(
            id: $model->id,
            name: new BrandName($model->name),
            status: $model->status,
            createdAt: $model->created_at?->toDateTime(),
            updatedAt: $model->updated_at?->toDateTime(),
        ) : null;
    }

    public function findByName(string $name): ?BrandEntity
    {
        $model = TblBrand::where('name', $name)->first();

        return $model ? BrandEntity::reconstitute(
            id: $model->id,
            name: new BrandName($model->name),
            status: $model->status,
            createdAt: $model->created_at?->toDateTime(),
            updatedAt: $model->updated_at?->toDateTime(),
        ) : null;
    }
    //--------------------------------------------------------------------------
    // KPIs / AGREGACIONES
    //--------------------------------------------------------------------------

    public function countAll(): int
    {
        return TblBrand::count();
    }

    public function countActive(): int
    {
        return TblBrand::where('status', 1)->count();
    }

    public function countInactive(): int
    {
        return TblBrand::where('status', 0)->count();
    }
    //--------------------------------------------------------------------------
    // OPERACIONES DE ESCRITURA
    //--------------------------------------------------------------------------
    public function save(BrandEntity $brandEntity): void
    {
        TblBrand::create([
            'name'   => $brandEntity->getName(),
            'status' => $brandEntity->getStatus(),
        ]);
    }

    public function update(BrandEntity $brand): void
    {
        $model = TblBrand::findOrFail($brand->getId());
        $model->update([
            'name'   => $brand->getName(),
            'status' => $brand->getStatus(),
        ]);
    }

    public function delete(int $id): void
    {
        TblBrand::destroy($id);
    }
}
