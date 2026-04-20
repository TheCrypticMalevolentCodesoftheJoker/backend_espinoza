<?php

namespace App\Modules\Catalog\Brand\Infrastructure\Persistence\Eloquent\Repositories;

use App\Modules\Catalog\Brand\Domain\Entities\BrandEntity;
use App\Modules\Catalog\Brand\Domain\Interfaces\BrandInterface;
use App\Modules\Catalog\Brand\Domain\ValueObjects\BrandName;
use App\Modules\Catalog\Brand\Infrastructure\Persistence\Eloquent\Models\TblBrand;

class EloquentBrandRepository implements BrandInterface
{
    /*----------------------------------------------------------------------------------
    LISTAR MARCAS
    ----------------------------------------------------------------------------------*/
    public function findAll(): array
    {
        return TblBrand::all()->map(function ($tblBrand) {
            return BrandEntity::reconstitute(
                id: $tblBrand->id,
                name: new BrandName($tblBrand->name),
                status: $tblBrand->status,
            );
        })->all();
    }

    /*----------------------------------------------------------------------------------
    GUARDAR MARCA
    ----------------------------------------------------------------------------------*/
    public function save(BrandEntity $brandEntity): BrandEntity
    {
        $model = TblBrand::create([
            'name' => $brandEntity->getName(),
            'status' => $brandEntity->getStatus(),
        ]);

        return BrandEntity::reconstitute(
            id: $model->id,
            name: new BrandName($model->name),
            status: $model->status,
        );
    }

    /*----------------------------------------------------------------------------------
    BUSCAR MARCA POR ID
    ----------------------------------------------------------------------------------*/
    public function findById(int $id): ?BrandEntity
    {
        $model = TblBrand::find($id);

        if (!$model) {
            return null;
        }

        return BrandEntity::reconstitute(
            id: $model->id,
            name: new BrandName($model->name),
            status: $model->status,
        );
    }

    /*----------------------------------------------------------------------------------
    BUSCAR MARCA POR NOMBRE
    ----------------------------------------------------------------------------------*/
    public function findByName(string $name): ?BrandEntity
    {
        $model = TblBrand::where('name', $name)->first();

        if (!$model) {
            return null;
        }

        return BrandEntity::reconstitute(
            id: $model->id,
            name: new BrandName($model->name),
            status: $model->status,
        );
    }

    /*----------------------------------------------------------------------------------
    ACTUALIZAR MARCA
    ----------------------------------------------------------------------------------*/
    public function update(BrandEntity $brand): BrandEntity
    {
        $model = TblBrand::findOrFail($brand->getId());

        $model->update([
            'name' => $brand->getName(),
            'status' => $brand->getStatus(),
        ]);

        return BrandEntity::reconstitute(
            id: $model->id,
            name: new BrandName($model->name),
            status: $model->status,
        );
    }

    /*----------------------------------------------------------------------------------
    ELIMINAR MARCA
    ----------------------------------------------------------------------------------*/
    public function delete(int $id): void
    {
        TblBrand::destroy($id);
    }
}
