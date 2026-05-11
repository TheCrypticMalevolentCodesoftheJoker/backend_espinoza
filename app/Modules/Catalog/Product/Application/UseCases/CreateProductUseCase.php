<?php

namespace App\Modules\Catalog\Product\Application\UseCases;

use App\Modules\Catalog\Product\Application\DTOs\StoreProductDTO;
use App\Modules\Catalog\Product\Domain\Entities\DiscountEntity;
use App\Modules\Catalog\Product\Domain\Entities\ImageEntity;
use App\Modules\Catalog\Product\Domain\Entities\PriceEntity;
use App\Modules\Catalog\Product\Domain\Entities\ProductEntity;
use App\Modules\Catalog\Product\Domain\Exceptions\InvalidBrandException;
use App\Modules\Catalog\Product\Domain\Exceptions\InvalidCategoryException;
use App\Modules\Catalog\Product\Domain\Exceptions\ProductAlreadyExistsException;
use App\Modules\Catalog\Product\Domain\Interfaces\BrandAccessGateway;
use App\Modules\Catalog\Product\Domain\Interfaces\CategoryAccessGateway;
use App\Modules\Catalog\Product\Domain\Interfaces\ProductInterface;
use App\Modules\Catalog\Product\Domain\ValueObjects\ImageType;
use App\Modules\Catalog\Product\Domain\ValueObjects\PriceAmount;
use App\Modules\Catalog\Product\Domain\ValueObjects\ProductCode;
use App\Modules\Catalog\Product\Domain\ValueObjects\ProductDimension;
use App\Modules\Catalog\Product\Domain\ValueObjects\ProductName;
use App\Modules\Catalog\Product\Domain\ValueObjects\ProductStock;
use Illuminate\Support\Facades\Storage;

class CreateProductUseCase
{
    public function __construct(
        private ProductInterface $productInterface,
        private CategoryAccessGateway $categoryAccessGateway,
        private BrandAccessGateway $brandAccessGateway,
    ) {}

    public function execute(StoreProductDTO $dto): void
    {
        //--------------------------------------------------------------------------
        // USECASE -> Crear producto
        //--------------------------------------------------------------------------

        //--------------------------------------------------------------------------
        // GENERAR CÓDIGO AUTOMÁTICO
        //--------------------------------------------------------------------------
        $generatedCode = $dto->code;
        if (empty($generatedCode)) {
            $sequence = $this->productInterface->getNextSequenceValue();
            $generatedCode = 'PRD-' . date('Y') . '-' . str_pad((string)$sequence, 4, '0', STR_PAD_LEFT);
        }

        //--------------------------------------------------------------------------
        // CONSTRUIR VALUE OBJECTS
        //--------------------------------------------------------------------------
        $code      = new ProductCode($generatedCode);
        $name      = new ProductName($dto->name);
        $stock     = new ProductStock($dto->stock);
        $length    = new ProductDimension($dto->length, 'length');
        $width     = new ProductDimension($dto->width, 'width');
        $thickness = new ProductDimension($dto->thickness, 'thickness');

        //--------------------------------------------------------------------------
        // VALIDAR CATEGORÍA Y MARCA
        //--------------------------------------------------------------------------
        if (!$this->categoryAccessGateway->exists($dto->categoryId)) {
            throw new InvalidCategoryException();
        }

        if (!$this->brandAccessGateway->exists($dto->brandId)) {
            throw new InvalidBrandException();
        }

        //--------------------------------------------------------------------------
        // VALIDAR CÓDIGO ÚNICO
        //--------------------------------------------------------------------------
        if ($this->productInterface->findByCode($code->value())) {
            throw new ProductAlreadyExistsException();
        }

        //--------------------------------------------------------------------------
        // CREAR Y PERSISTIR EL AGGREGATE ROOT
        //--------------------------------------------------------------------------
        $entity = ProductEntity::create(
            categoryId: $dto->categoryId,
            brandId: $dto->brandId,
            code: $code,
            name: $name,
            description: $dto->description,
            unitMeasure: $dto->unitMeasure,
            length: $length,
            width: $width,
            thickness: $thickness,
            stock: $stock,
        );

        $productId = $this->productInterface->save($entity);

        //--------------------------------------------------------------------------
        // ALMACENAR IMÁGENES Y REGISTRAR EN BD
        //--------------------------------------------------------------------------
        if (!empty($dto->images)) {
            $imageEntities = [];

            foreach ($dto->images as $imageInput) {
                $path = Storage::disk('public')->putFile(
                    "products/{$productId}",
                    $imageInput->file
                );

                $imageEntities[] = ImageEntity::create(
                    productId: $productId,
                    path: $path,
                    type: new ImageType($imageInput->type),
                );
            }

            $this->productInterface->replaceImages($productId, $imageEntities);
        }

        //--------------------------------------------------------------------------
        // PRECIO INICIAL
        //--------------------------------------------------------------------------
        if ($dto->price) {
            $priceEntity = PriceEntity::create(
                productId: $productId,
                amount: new PriceAmount($dto->price->amount),
                startDate: new \DateTime($dto->price->startDate),
                endDate: $dto->price->endDate ? new \DateTime($dto->price->endDate) : null,
            );

            $this->productInterface->saveCurrentPrice($productId, $priceEntity);
        }

        //--------------------------------------------------------------------------
        // DESCUENTO INICIAL
        //--------------------------------------------------------------------------
        if ($dto->discount) {
            $discountEntity = DiscountEntity::create(
                productId: $productId,
                amount: new PriceAmount($dto->discount->amount, 'discount'),
                startDate: new \DateTime($dto->discount->startDate),
                endDate: $dto->discount->endDate ? new \DateTime($dto->discount->endDate) : null,
            );

            $this->productInterface->saveCurrentDiscount($productId, $discountEntity);
        }
    }
}

