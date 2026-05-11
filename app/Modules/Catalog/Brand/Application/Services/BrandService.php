<?php

namespace App\Modules\Catalog\Brand\Application\Services;

use Illuminate\Support\Facades\DB;
use App\Modules\Catalog\Brand\Application\DTOs\StoreBrandDTO;
use App\Modules\Catalog\Brand\Application\DTOs\UpdateBrandDTO;
use App\Modules\Catalog\Brand\Application\UseCases\ActivateBrandUseCase;
use App\Modules\Catalog\Brand\Application\UseCases\CreateBrandUseCase;
use App\Modules\Catalog\Brand\Application\UseCases\DeactivateBrandUseCase;
use App\Modules\Catalog\Brand\Application\UseCases\DeleteBrandUseCase;
use App\Modules\Catalog\Brand\Application\UseCases\UpdateBrandUseCase;

class BrandService
{
    public function __construct(
        private CreateBrandUseCase $createBrandUseCase,
        private UpdateBrandUseCase $updateBrandUseCase,
        private ActivateBrandUseCase $activateBrandUseCase,
        private DeactivateBrandUseCase $deactivateBrandUseCase,
        private DeleteBrandUseCase $deleteBrandUseCase,
    ) {}
    //--------------------------------------------------------------------------
    // OPERACIONES DE ESCRITURA
    //--------------------------------------------------------------------------
    public function createBrand(StoreBrandDTO $storeBrandDTO): void
    {
        DB::transaction(fn() => $this->createBrandUseCase->execute($storeBrandDTO));
    }

    public function updateBrand(int $id, UpdateBrandDTO $updateBrandDTO): void
    {
        DB::transaction(fn() => $this->updateBrandUseCase->execute($id, $updateBrandDTO));
    }

    public function activateBrand(int $id): void
    {
        DB::transaction(fn() => $this->activateBrandUseCase->execute($id));
    }

    public function deactivateBrand(int $id): void
    {
        DB::transaction(fn() => $this->deactivateBrandUseCase->execute($id));
    }

    public function deleteBrand(int $id): void
    {
        DB::transaction(fn() => $this->deleteBrandUseCase->execute($id));
    }
}

