<?php

namespace App\Modules\Catalog\Product\Application\UseCases\Write;

use App\Modules\Catalog\Product\Application\DTOs\Write\Product\UpdateProductDTO;
use App\Modules\Catalog\Product\Domain\Entities\PriceEntity;
use App\Modules\Catalog\Product\Domain\Entities\DiscountEntity;
use App\Modules\Catalog\Product\Domain\Entities\ImageEntity;
use App\Modules\Catalog\Product\Domain\Exceptions\Gateways\InvalidBrandException;
use App\Modules\Catalog\Product\Domain\Exceptions\Gateways\InvalidCategoryException;
use App\Modules\Catalog\Product\Domain\Exceptions\Product\ProductNotFoundException;
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

class UpdateProductUseCase
{
    public function __construct(
        private ProductInterface $productInterface,
        private PriceInterface $priceInterface,
        private DiscountInterface $discountInterface,
        private ImageInterface $imageInterface,
        private CategoryAccessGateway $categoryAccessGateway,
        private BrandAccessGateway $brandAccessGateway,
        private S3Gateway $s3Gateway,
    ) {}

    //--------------------------------------------------------------------------
    // EJECUTAR CASO DE USO -> Actualizar un producto existente
    //--------------------------------------------------------------------------
    public function execute(int $id, UpdateProductDTO $dto): void
    {
        //--------------------------------------------------------------------------
        // LÓGICA -> Obtener entidad del producto
        //--------------------------------------------------------------------------
        $entity = $this->productInterface->findById($id);

        if (!$entity) {
            throw new ProductNotFoundException();
        }

        DB::beginTransaction();

        try {
            //--------------------------------------------------------------------------
            // LÓGICA -> Actualización de campos de la entidad
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

            if ($dto->name !== null) {
                $entity->changeName(new ProductName($dto->name));
            }

            if ($dto->description !== null) {
                $entity->changeDescription($dto->description);
            }

            if ($dto->length !== null) {
                $entity->changeLength(new ProductLength($dto->length));
            }

            if ($dto->width !== null) {
                $entity->changeWidth(new ProductWidth($dto->width));
            }

            if ($dto->thickness !== null) {
                $entity->changeThickness(new ProductThickness($dto->thickness));
            }

            if ($dto->stock !== null) {
                $entity->changeStock(new ProductStock($dto->stock));
            }

            $this->productInterface->update($entity);

            //--------------------------------------------------------------------------
            // PERSISTENCIA -> Gestión de imágenes del producto (reemplazo o adición)
            //--------------------------------------------------------------------------
            if ($dto->replaceImages) {
                $this->s3Gateway->deleteAll($id);
                $this->imageInterface->deleteByProductId($id);
            }

            if (!empty($dto->images)) {
                foreach ($dto->images as $imageDto) {
                    $uploadResult = $this->s3Gateway->upload($id, $imageDto->file);
                    $type = new ImageType($uploadResult['type']);

                    $imageEntity = ImageEntity::create(
                        productId: $id,
                        url: $uploadResult['url'],
                        type: $type
                    );

                    $this->imageInterface->save($imageEntity);
                }
            }

            //--------------------------------------------------------------------------
            // PERSISTENCIA -> Registrar nuevo precio del producto (opcional)
            //--------------------------------------------------------------------------
            if ($dto->price) {
                $priceAmount = new PriceAmount($dto->price->amount);
                $priceEntity = PriceEntity::create(
                    productId: $id,
                    amount: $priceAmount,
                    startDate: $dto->price->startDate,
                    endDate: $dto->price->endDate ?? null,
                );

                $this->priceInterface->save($priceEntity);
            }

            //--------------------------------------------------------------------------
            // PERSISTENCIA -> Registrar nuevo descuento del producto (opcional)
            //--------------------------------------------------------------------------
            if ($dto->discount) {
                $discountAmount = new DiscountAmount($dto->discount->amount);
                $discountEntity = DiscountEntity::create(
                    productId: $id,
                    amount: $discountAmount,
                    startDate: $dto->discount->startDate,
                    endDate: $dto->discount->endDate ?? null,
                );

                $this->discountInterface->save($discountEntity);
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
