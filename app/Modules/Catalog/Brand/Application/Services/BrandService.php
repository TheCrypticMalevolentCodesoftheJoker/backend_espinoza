<?php

namespace App\Modules\Catalog\Brand\Application\Services;

use App\Modules\Catalog\Brand\Application\DTOs\StoreBrandDTO;
use App\Modules\Catalog\Brand\Application\DTOs\UpdateBrandDTO;
use Illuminate\Support\Facades\DB;
use App\Modules\Catalog\Brand\Application\UseCases\ActivateBrandUseCase;
use App\Modules\Catalog\Brand\Application\UseCases\CreateBrandUseCase;
use App\Modules\Catalog\Brand\Application\UseCases\DeactivateBrandUseCase;
use App\Modules\Catalog\Brand\Application\UseCases\DeleteBrandUseCase;
use App\Modules\Catalog\Brand\Application\UseCases\GetBrandByIdUseCase;
use App\Modules\Catalog\Brand\Application\UseCases\ListBrandsUseCase;
use App\Modules\Catalog\Brand\Application\UseCases\UpdateBrandUseCase;

class BrandService
{
    public function __construct(
        private ListBrandsUseCase $listBrandsUseCase,
        private CreateBrandUseCase $createBrandUseCase,
        private GetBrandByIdUseCase $getBrandByIdUseCase,
        private UpdateBrandUseCase $updateBrandUseCase,
        private ActivateBrandUseCase $activateBrandUseCase,
        private DeactivateBrandUseCase $deactivateBrandUseCase,
        private DeleteBrandUseCase $deleteBrandUseCase,
    ) {}

    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_//

    //----------------------------------------------------------------------------------
    // LISTAR MARCAS
    //----------------------------------------------------------------------------------
    public function listBrands(): array
    {
        return $this->listBrandsUseCase->execute();
    }

    //----------------------------------------------------------------------------------
    // OBTENER MARCA POR ID
    //----------------------------------------------------------------------------------
    public function getBrand(string $id)
    {
        return $this->getBrandByIdUseCase->execute($id);
    }

    //----------------------------------------------------------------------------------
    // CREAR MARCA
    //----------------------------------------------------------------------------------
    public function createBrand(StoreBrandDTO $storeBrandDTO)
    {
        return DB::transaction(
            fn() =>
            $this->createBrandUseCase->execute($storeBrandDTO)
        );
    }

    //----------------------------------------------------------------------------------
    // ACTUALIZAR MARCA
    //----------------------------------------------------------------------------------
    public function updateBrand(string $id, UpdateBrandDTO $updateBrandDTO)
    {
        return DB::transaction(
            fn() =>
            $this->updateBrandUseCase->execute($id, $updateBrandDTO)
        );
    }

    //----------------------------------------------------------------------------------
    // ACTIVAR MARCA
    //----------------------------------------------------------------------------------
    public function activateBrand(string $id)
    {
        return DB::transaction(
            fn() => $this->activateBrandUseCase->execute($id)
        );
    }

    //----------------------------------------------------------------------------------
    // DESACTIVAR MARCA
    //----------------------------------------------------------------------------------
    public function deactivateBrand(string $id)
    {
        return DB::transaction(
            fn() => $this->deactivateBrandUseCase->execute($id)
        );
    }

    //----------------------------------------------------------------------------------
    // ELIMINAR MARCA
    //----------------------------------------------------------------------------------
    public function deleteBrand(string $id)
    {
        return DB::transaction(function () use ($id) {
            return $this->deleteBrandUseCase->execute($id);
        });
    }
}
