<?php

namespace App\Modules\Catalog\Product\Application\Services;

use App\Modules\Catalog\Product\Application\DTOs\Product\ProductDetailDTO;
use Illuminate\Support\Facades\DB;
use App\Modules\Catalog\Product\Application\DTOs\ProductAssetsDTO;
use App\Modules\Catalog\Product\Application\UseCases\Dimension\CreateDimensionUseCase;
use App\Modules\Catalog\Product\Application\UseCases\Discount\CreateDiscountUseCase;
use App\Modules\Catalog\Product\Application\UseCases\Image\CreateImageUseCase;
use App\Modules\Catalog\Product\Application\UseCases\Price\CreatePriceUseCase;
use App\Modules\Catalog\Product\Application\UseCases\Product\CreateProductUseCase;
use App\Modules\Catalog\Product\Application\UseCases\Product\GetProductByIdUseCase;
use App\Modules\Catalog\Product\Application\UseCases\Product\ListProductsUseCase;

class ProductService
{
    public function __construct(
        // --------------------------------------------------
        // PRODUCTO
        // --------------------------------------------------
        private ListProductsUseCase $listProductsUseCase,
        private GetProductByIdUseCase $getProductByIdUseCase,
        private CreateProductUseCase $createProductUseCase,

        // --------------------------------------------------
        // IMÁGENES
        // --------------------------------------------------
        private CreateImageUseCase $createImageUseCase,

        // --------------------------------------------------
        // PRECIO
        // --------------------------------------------------
        private CreatePriceUseCase $createPriceUseCase,

        // --------------------------------------------------
        // DESCUENTO
        // --------------------------------------------------
        private CreateDiscountUseCase $createDiscountUseCase,

        // --------------------------------------------------
        // DIMENSIÓN
        // --------------------------------------------------
        private CreateDimensionUseCase $createDimensionUseCase,
    ) {}

    //----------------------------------------------------------------------------------
    // LISTAR PRODUCTOS
    //----------------------------------------------------------------------------------
    public function listProducts(): array
    {
        return $this->listProductsUseCase->Execute();
    }

    //----------------------------------------------------------------------------------
    // OBTENER PRODUCTO POR ID
    //----------------------------------------------------------------------------------
    public function getProductById(string $id): ?ProductDetailDTO
    {
        return $this->getProductByIdUseCase->execute($id);
    }
    
    //----------------------------------------------------------------------------------
    // CREAR PRODUCTO
    //----------------------------------------------------------------------------------
    public function createProduct(ProductAssetsDTO $productAssetsDTO)
    {
        return DB::transaction(function () use ($productAssetsDTO) {

            // -------------------------
            // 1. CREAR PRODUCTO BASE
            // -------------------------
            $product = $this->createProductUseCase->execute(
                $productAssetsDTO->storeProductDTO
            );

            $productId = $product->id;

            // -------------------------
            // 2. IMÁGENES
            // -------------------------
            $this->createImageUseCase->execute(
                $productId,
                $productAssetsDTO->images
            );

            // -------------------------
            // 3. PRECIO
            // -------------------------
            $this->createPriceUseCase->execute(
                $productId,
                $productAssetsDTO->storePriceDTO
            );

            // -------------------------
            // 4. DESCUENTO (opcional)
            // -------------------------
            if ($productAssetsDTO->storeDiscountDTO) {
                $this->createDiscountUseCase->execute(
                    $productId,
                    $productAssetsDTO->storeDiscountDTO
                );
            }

            // -------------------------
            // 5. DIMENSIÓN
            // -------------------------
            $this->createDimensionUseCase->execute(
                $productId,
                $productAssetsDTO->storeDimensionDTO
            );

            return $product;
        });
    }
}
