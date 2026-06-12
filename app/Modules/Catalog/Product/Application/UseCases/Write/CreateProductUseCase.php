<?php

//--------------------------------------------------------------------------
// CreateProductUseCase: Creación y registro de productos con precios, descuentos e imágenes
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Product\Application\UseCases\Write;

use App\Modules\Catalog\Product\Application\DTOs\Write\Product\StoreProductDTO;
use App\Modules\Catalog\Product\Domain\Entities\ProductEntity;
use App\Modules\Catalog\Product\Domain\Entities\PriceEntity;
use App\Modules\Catalog\Product\Domain\Entities\DiscountEntity;
use App\Modules\Catalog\Product\Domain\Entities\ImageEntity;
use App\Modules\Catalog\Product\Domain\Exceptions\Gateways\InvalidBrandException;
use App\Modules\Catalog\Product\Domain\Exceptions\Gateways\InvalidCategoryException;
use App\Modules\Catalog\Product\Domain\Exceptions\Product\ProductAlreadyExistsException;
use App\Modules\Catalog\Product\Domain\Interfaces\Product\ProductInterface;
use App\Modules\Catalog\Product\Domain\Interfaces\Price\PriceInterface;
use App\Modules\Catalog\Product\Domain\Interfaces\Discount\DiscountInterface;
use App\Modules\Catalog\Product\Domain\Interfaces\Image\ImageInterface;
use App\Modules\Catalog\Product\Domain\Interfaces\Gateways\CategoryAccessGateway;
use App\Modules\Catalog\Product\Domain\Interfaces\Gateways\BrandAccessGateway;
use App\Modules\Catalog\Product\Domain\Interfaces\Gateways\S3Gateway;
use App\Modules\Catalog\Product\Domain\ValueObjects\Product\ProductName;
use App\Modules\Catalog\Product\Domain\ValueObjects\Product\ProductStock;
use App\Modules\Catalog\Product\Domain\ValueObjects\Product\ProductLength;
use App\Modules\Catalog\Product\Domain\ValueObjects\Product\ProductWidth;
use App\Modules\Catalog\Product\Domain\ValueObjects\Product\ProductThickness;
use App\Modules\Catalog\Product\Domain\ValueObjects\Price\PriceAmount;
use App\Modules\Catalog\Product\Domain\ValueObjects\Discount\DiscountAmount;
use App\Modules\Catalog\Product\Domain\ValueObjects\Image\ImageType;
use Illuminate\Support\Facades\DB;

class CreateProductUseCase
{
    public function __construct(
        private ProductInterface $productInterface,
        private PriceInterface $priceInterface,
        private DiscountInterface $discountInterface,
        private ImageInterface $imageInterface,
        private BrandAccessGateway $brandAccessGateway,
        private CategoryAccessGateway $categoryAccessGateway,
        private S3Gateway $s3Gateway,
    ) {}

    //--------------------------------------------------------------------------
    // Orquestación: Validación, construcción transaccional y persistencia de agregados
    //--------------------------------------------------------------------------
    public function execute(StoreProductDTO $storeProductDTO): void
    {
        if (!$this->categoryAccessGateway->exists($storeProductDTO->categoryId)) {
            throw new InvalidCategoryException();
        }

        if (!$this->brandAccessGateway->exists($storeProductDTO->brandId)) {
            throw new InvalidBrandException();
        }

        if ($this->productInterface->findByName($storeProductDTO->name)) {
            throw new ProductAlreadyExistsException();
        }

        DB::beginTransaction();

        try {
            $name = new ProductName($storeProductDTO->name);
            $length = new ProductLength($storeProductDTO->length);
            $width = new ProductWidth($storeProductDTO->width);
            $thickness = new ProductThickness($storeProductDTO->thickness);
            $stock = new ProductStock($storeProductDTO->stock);

            $entity = ProductEntity::create(
                categoryId: $storeProductDTO->categoryId,
                brandId: $storeProductDTO->brandId,
                name: $name,
                description: $storeProductDTO->description,
                length: $length,
                width: $width,
                thickness: $thickness,
                stock: $stock,
            );

            $productId = $this->productInterface->save($entity);

            foreach ($storeProductDTO->images as $imageDto) {
                $uploadResult = $this->s3Gateway->upload($productId, $imageDto->file->value());
                $type = new ImageType($uploadResult['type']);

                $imageEntity = ImageEntity::create(
                    productId: $productId,
                    url: $uploadResult['url'],
                    type: $type
                );

                $this->imageInterface->save($imageEntity);
            }

            if ($storeProductDTO->price) {
                $priceAmount = new PriceAmount($storeProductDTO->price->amount);

                $priceEntity = PriceEntity::create(
                    productId: $productId,
                    amount: $priceAmount,
                    startDate: $storeProductDTO->price->startDate,
                    endDate: $storeProductDTO->price->endDate ?? null,
                );

                $this->priceInterface->save($priceEntity);
            }

            if ($storeProductDTO->discount) {
                $discountAmount = new DiscountAmount($storeProductDTO->discount->amount);

                $discountEntity = DiscountEntity::create(
                    productId: $productId,
                    amount: $discountAmount,
                    startDate: $storeProductDTO->discount->startDate,
                    endDate: $storeProductDTO->discount->endDate ?? null,
                );

                $this->discountInterface->save($discountEntity);
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            if (isset($productId)) {
                try {
                    $this->s3Gateway->deleteAll($productId);
                } catch (\Throwable $err) {
                    // Ignore S3 deletion error during rollback
                }
            }
            throw $e;
        }
    }
}
