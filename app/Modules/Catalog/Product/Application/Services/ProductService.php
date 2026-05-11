<?php

namespace App\Modules\Catalog\Product\Application\Services;

use Illuminate\Support\Facades\DB;
use App\Modules\Catalog\Product\Application\DTOs\StoreProductDTO;
use App\Modules\Catalog\Product\Application\DTOs\UpdateProductDTO;
use App\Modules\Catalog\Product\Application\UseCases\ActivateProductUseCase;
use App\Modules\Catalog\Product\Application\UseCases\CreateProductUseCase;
use App\Modules\Catalog\Product\Application\UseCases\DeactivateProductUseCase;
use App\Modules\Catalog\Product\Application\UseCases\DeleteProductUseCase;
use App\Modules\Catalog\Product\Application\UseCases\UpdateProductUseCase;

class ProductService
{
    public function __construct(
        private CreateProductUseCase $createProductUseCase,
        private UpdateProductUseCase $updateProductUseCase,
        private ActivateProductUseCase $activateProductUseCase,
        private DeactivateProductUseCase $deactivateProductUseCase,
        private DeleteProductUseCase $deleteProductUseCase,
    ) {}

    //--------------------------------------------------------------------------
    // OPERACIONES DE ESCRITURA
    //--------------------------------------------------------------------------
    public function createProduct(StoreProductDTO $dto): void
    {
        DB::transaction(fn() => $this->createProductUseCase->execute($dto));
    }

    public function updateProduct(int $id, UpdateProductDTO $dto): void
    {
        DB::transaction(fn() => $this->updateProductUseCase->execute($id, $dto));
    }

    public function activateProduct(int $id): void
    {
        DB::transaction(fn() => $this->activateProductUseCase->execute($id));
    }

    public function deactivateProduct(int $id): void
    {
        DB::transaction(fn() => $this->deactivateProductUseCase->execute($id));
    }

    public function deleteProduct(int $id): void
    {
        DB::transaction(fn() => $this->deleteProductUseCase->execute($id));
    }
}

