<?php

namespace App\Modules\Catalog\Product\Application\UseCases;

use App\Modules\Catalog\Product\Application\DTOs\UpdateProductDTO;
use App\Modules\Catalog\Product\Domain\Entities\DiscountEntity;
use App\Modules\Catalog\Product\Domain\Entities\ImageEntity;
use App\Modules\Catalog\Product\Domain\Entities\PriceEntity;
use App\Modules\Catalog\Product\Domain\Exceptions\InvalidBrandException;
use App\Modules\Catalog\Product\Domain\Exceptions\InvalidCategoryException;
use App\Modules\Catalog\Product\Domain\Exceptions\ProductAlreadyExistsException;
use App\Modules\Catalog\Product\Domain\Exceptions\ProductNotFoundException;
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

class UpdateProductUseCase
{
    public function __construct(
        private ProductInterface $productInterface,
        private CategoryAccessGateway $categoryAccessGateway,
        private BrandAccessGateway $brandAccessGateway,
    ) {}

    public function execute(int $id, UpdateProductDTO $dto): void
    {
        //--------------------------------------------------------------------------
        // USECASE -> Actualizar producto
        //--------------------------------------------------------------------------

        $entity = $this->productInterface->findById($id);

        if (!$entity) {
            throw new ProductNotFoundException();
        }

        //--------------------------------------------------------------------------
        // CAMPOS ESCALARES
        //--------------------------------------------------------------------------
        if ($dto->categoryId !== null) {
            if (!$this->categoryAccessGateway->exists($dto->categoryId)) {
                throw new InvalidCategoryException();
            }
            $entity->changeCategoryId($dto->categoryId);
        }

        if ($dto->brandId !== null) {
            if (!$this->brandAccessGateway->exists($dto->brandId)) {
                throw new InvalidBrandException();
            }
            $entity->changeBrandId($dto->brandId);
        }

        if ($dto->code !== null) {
            $newCode = new ProductCode($dto->code);

            $existing = $this->productInterface->findByCode($newCode->value());
            if ($existing && $existing->getId() !== $entity->getId()) {
                throw new ProductAlreadyExistsException();
            }

            $entity->changeCode($newCode);
        }

        if ($dto->name !== null) {
            $entity->changeName(new ProductName($dto->name));
        }

        if (array_key_exists('description', (array) $dto)) {
            $entity->changeDescription($dto->description);
        }

        if ($dto->unitMeasure !== null) {
            $entity->changeUnitMeasure($dto->unitMeasure);
        }

        if ($dto->length !== null) {
            $entity->changeLength(new ProductDimension($dto->length, 'length'));
        }

        if ($dto->width !== null) {
            $entity->changeWidth(new ProductDimension($dto->width, 'width'));
        }

        if ($dto->thickness !== null) {
            $entity->changeThickness(new ProductDimension($dto->thickness, 'thickness'));
        }

        if ($dto->stock !== null) {
            $entity->changeStock(new ProductStock($dto->stock));
        }

        $this->productInterface->update($entity);

        //--------------------------------------------------------------------------
        // IMÁGENES
        //--------------------------------------------------------------------------
        if ($dto->images !== null) {
            $imageEntities = [];

            if ($dto->replaceImages) {
                foreach ($entity->getImages() as $old) {
                    Storage::disk('public')->delete($old->getPath());
                }
            } else {
                $imageEntities = $entity->getImages();
            }

            foreach ($dto->images as $imageInput) {
                $path = Storage::disk('public')->putFile(
                    "products/{$id}",
                    $imageInput->file
                );

                $imageEntities[] = ImageEntity::create(
                    productId: $id,
                    path: $path,
                    type: new ImageType($imageInput->type),
                );
            }

            $this->productInterface->replaceImages($id, $imageEntities);
        }

        //--------------------------------------------------------------------------
        // PRECIO
        //--------------------------------------------------------------------------
        if ($dto->price !== null) {
            $priceEntity = PriceEntity::create(
                productId: $id,
                amount: new PriceAmount($dto->price->amount),
                startDate: new \DateTime($dto->price->startDate),
                endDate: $dto->price->endDate ? new \DateTime($dto->price->endDate) : null,
            );

            $this->productInterface->saveCurrentPrice($id, $priceEntity);
        }

        //--------------------------------------------------------------------------
        // DESCUENTO
        //--------------------------------------------------------------------------
        if ($dto->discount !== null) {
            $discountEntity = DiscountEntity::create(
                productId: $id,
                amount: new PriceAmount($dto->discount->amount, 'discount'),
                startDate: new \DateTime($dto->discount->startDate),
                endDate: $dto->discount->endDate ? new \DateTime($dto->discount->endDate) : null,
            );

            $this->productInterface->saveCurrentDiscount($id, $discountEntity);
        }
    }
}

