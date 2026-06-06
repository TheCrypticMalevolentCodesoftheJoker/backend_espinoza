<?php

//--------------------------------------------------------------------------
// ListProductsUseCase: Recuperación de la lista completa de productos del catálogo
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Product\Application\UseCases\Read;

use App\Modules\Catalog\Product\Application\DTOs\Read\Product\ProductDTO;
use App\Modules\Catalog\Product\Application\DTOs\Read\Price\PriceDTO;
use App\Modules\Catalog\Product\Application\DTOs\Read\Discount\DiscountDTO;
use App\Modules\Catalog\Product\Domain\Interfaces\Gateways\BrandAccessGateway;
use App\Modules\Catalog\Product\Domain\Interfaces\Gateways\CategoryAccessGateway;
use App\Modules\Catalog\Product\Domain\Interfaces\Product\ProductInterface;
use App\Modules\Catalog\Product\Domain\Interfaces\Image\ImageInterface;
use App\Modules\Catalog\Product\Application\DTOs\Read\Image\ImageDTO;
use App\Modules\Catalog\Product\Domain\Interfaces\Price\PriceInterface;
use App\Modules\Catalog\Product\Domain\Interfaces\Discount\DiscountInterface;

class ListProductsUseCase
{
    public function __construct(
        private ProductInterface $productInterface,
        private CategoryAccessGateway $categoryAccessGateway,
        private BrandAccessGateway $brandAccessGateway,
        private ImageInterface $imageInterface,
        private PriceInterface $priceInterface,
        private DiscountInterface $discountInterface,
    ) {}

    //--------------------------------------------------------------------------
    // Consulta: Consulta y mapeo de productos, marcas, categorías e información comercial
    //--------------------------------------------------------------------------
    public function execute(): array
    {
        $products = $this->productInterface->findAll();

        $categoryIds = array_unique(
            array_map(fn($p) => $p->getCategoryId(), $products)
        );
        $brandIds = array_unique(
            array_map(fn($p) => $p->getBrandId(), $products)
        );

        $categories = collect(
            $this->categoryAccessGateway->findByIds($categoryIds)
        )->keyBy('id');

        $brands = collect(
            $this->brandAccessGateway->findByIds($brandIds)
        )->keyBy('id');

        $imageRepo = $this->imageInterface;
        $priceRepo = $this->priceInterface;
        $discountRepo = $this->discountInterface;

        return array_map(function ($product) use ($categories, $brands, $imageRepo, $priceRepo, $discountRepo) {
            $id = $product->getId();

            $images = array_map(fn($img) => new ImageDTO(
                id: $img->getId(),
                url: $img->getUrl(),
                type: $img->getType()->category()
            ), $imageRepo->findByProductId($id));

            $priceEntity = $priceRepo->findCurrentByProductId($id);
            $priceDto = $priceEntity ? new PriceDTO(
                id: $priceEntity->getId(),
                amount: $priceEntity->getAmount(),
                startDate: $priceEntity->getStartDate(),
                endDate: $priceEntity->getEndDate(),
                status: $priceEntity->getStatus()
            ) : null;

            $discountEntity = $discountRepo->findCurrentByProductId($id);
            $discountDto = $discountEntity ? new DiscountDTO(
                id: $discountEntity->getId(),
                amount: $discountEntity->getAmount(),
                startDate: $discountEntity->getStartDate(),
                endDate: $discountEntity->getEndDate(),
                status: $discountEntity->getStatus()
            ) : null;

            return new ProductDTO(
                id: $product->getId(),
                code: $product->getCode(),
                categoryId: $product->getCategoryId(),
                categoryName: $categories[$product->getCategoryId()]['name'] ?? 'Sin categoría',
                brandId: $product->getBrandId(),
                brandName: $brands[$product->getBrandId()]['name'] ?? 'Sin marca',
                name: $product->getName(),
                description: $product->getDescription(),
                length: $product->getLength(),
                width: $product->getWidth(),
                thickness: $product->getThickness(),
                stock: $product->getStock(),
                status: $product->getStatus(),
                createdAt: $product->getCreatedAt()?->format('Y-m-d H:i:s'),
                updatedAt: $product->getUpdatedAt()?->format('Y-m-d H:i:s'),
                images: $images,
                price: $priceDto,
                discount: $discountDto
            );
        }, $products);
    }
}
