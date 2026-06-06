<?php

//--------------------------------------------------------------------------
// EloquentBrandRepository: Acceso y mutación física de registros de marcas con Eloquent
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Brand\Infrastructure\Persistence\Repositories;

use App\Modules\Catalog\Brand\Domain\Entities\BrandEntity;
use App\Modules\Catalog\Brand\Domain\Interfaces\BrandInterface;
use App\Modules\Catalog\Brand\Domain\ValueObjects\BrandName;
use App\Modules\Catalog\Brand\Infrastructure\Persistence\Models\TblBrand;

class EloquentBrandRepository implements BrandInterface
{
    //--------------------------------------------------------------------------
    // Consulta: Operaciones de lectura y búsqueda en base de datos
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


    public function findActive(): array
    {
        return TblBrand::where('status', true)
            ->get()
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
    // Persistencia: Transacciones físicas de almacenamiento, actualización y eliminación
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
