<?php

//--------------------------------------------------------------------------
// GetProductByIdUseCase: Recuperación de los detalles de un producto por identificador único
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Product\Application\UseCases\Read;

use App\Modules\Catalog\Product\Application\DTOs\Read\Product\ProductDTO;
use App\Modules\Catalog\Product\Application\DTOs\Read\Image\ImageDTO;
use App\Modules\Catalog\Product\Application\DTOs\Read\Price\PriceDTO;
use App\Modules\Catalog\Product\Application\DTOs\Read\Discount\DiscountDTO;
use App\Modules\Catalog\Product\Domain\Exceptions\Product\ProductNotFoundException;
use App\Modules\Catalog\Product\Domain\Interfaces\Gateways\BrandAccessGateway;
use App\Modules\Catalog\Product\Domain\Interfaces\Gateways\CategoryAccessGateway;
use App\Modules\Catalog\Product\Domain\Interfaces\Product\ProductInterface;
use App\Modules\Catalog\Product\Domain\Interfaces\Price\PriceInterface;
use App\Modules\Catalog\Product\Domain\Interfaces\Discount\DiscountInterface;
use App\Modules\Catalog\Product\Domain\Interfaces\Image\ImageInterface;

class GetProductByIdUseCase
{
    public function __construct(
        private ProductInterface $productInterface,
        private CategoryAccessGateway $categoryAccessGateway,
        private BrandAccessGateway $brandAccessGateway,
        private PriceInterface $priceInterface,
        private DiscountInterface $discountInterface,
        private ImageInterface $imageInterface,
    ) {}

    //--------------------------------------------------------------------------
    // Consulta: Consulta detallada de producto, precios, descuentos e imágenes
    //--------------------------------------------------------------------------
    public function execute(int $id): ProductDTO
    {
        $product = $this->productInterface->findById($id);

        if (!$product) {
            throw new ProductNotFoundException();
        }

        $category = $this->categoryAccessGateway->findById($product->getCategoryId());
        $brand = $this->brandAccessGateway->findById($product->getBrandId());

        $images = array_map(fn($img) => new ImageDTO(
            id: $img->getId(),
            url: $img->getUrl(),
            type: $img->getType()->category()
        ), $this->imageInterface->findByProductId($id));

        $priceEntity = $this->priceInterface->findCurrentByProductId($id);
        $priceDto = $priceEntity ? new PriceDTO(
            id: $priceEntity->getId(),
            amount: $priceEntity->getAmount(),
            startDate: $priceEntity->getStartDate(),
            endDate: $priceEntity->getEndDate(),
            status: $priceEntity->getStatus()
        ) : null;

        $discountEntity = $this->discountInterface->findCurrentByProductId($id);
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
            categoryName: $category['name'] ?? 'Sin categoría',
            brandId: $product->getBrandId(),
            brandName: $brand['name'] ?? 'Sin marca',
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
    }
}
