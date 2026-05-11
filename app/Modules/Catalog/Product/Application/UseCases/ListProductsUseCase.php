<?php

namespace App\Modules\Catalog\Product\Application\UseCases;

use App\Modules\Catalog\Product\Application\DTOs\ProductSummaryDTO;
use App\Modules\Catalog\Product\Domain\Interfaces\BrandAccessGateway;
use App\Modules\Catalog\Product\Domain\Interfaces\CategoryAccessGateway;
use App\Modules\Catalog\Product\Domain\Interfaces\ProductInterface;
use Illuminate\Support\Facades\Storage;

class ListProductsUseCase
{
    public function __construct(
        private ProductInterface $productInterface,
        private CategoryAccessGateway $categoryAccessGateway,
        private BrandAccessGateway $brandAccessGateway,
    ) {}

    public function execute(): array
    {
        //--------------------------------------------------------------------------
        // USECASE -> Listar productos
        //--------------------------------------------------------------------------

        $products = $this->productInterface->findAll();

        if (empty($products)) {
            return [
                'products' => [],
                'stats' => [
                    'total' => 0,
                    'activos' => 0,
                    'inactivos' => 0,
                ]
            ];
        }

        //--------------------------------------------------------------------------
        // CARGAR RELACIONES (Categorías y Marcas)
        //--------------------------------------------------------------------------
        $categoryIds = array_unique(array_map(fn($p) => $p->getCategoryId(), $products));
        $brandIds    = array_unique(array_map(fn($p) => $p->getBrandId(), $products));

        $categories = collect(
            $this->categoryAccessGateway->findByIds($categoryIds)
        )->keyBy('id');

        $brands = collect(
            $this->brandAccessGateway->findByIds($brandIds)
        )->keyBy('id');

        //--------------------------------------------------------------------------
        // CONSTRUIR DTOs Y ESTADÍSTICAS
        //--------------------------------------------------------------------------
        $dto = array_map(function ($product) use ($categories, $brands) {

            $mainImage = $product->getImages()[0] ?? null;

            $mainImageUrl = $mainImage
                ? Storage::disk('public')->url($mainImage->getPath())
                : null;

            return new ProductSummaryDTO(
                id: $product->getId(),
                code: $product->getCode(),
                name: $product->getName(),
                categoryName: $categories[$product->getCategoryId()]['name'] ?? 'Sin categoría',
                brandName: $brands[$product->getBrandId()]['name'] ?? 'Sin marca',
                status: $product->getStatus(),
                currentPrice: $product->getCurrentPrice()?->getAmount(),
                mainImageUrl: $mainImageUrl,
            );
        }, $products);

        $total = $this->productInterface->countAll();
        $activos = $this->productInterface->countActive();
        $inactivos = $this->productInterface->countInactive();

        return [
            'products' => $dto,
            'stats' => [
                'total' => $total,
                'activos' => $activos,
                'inactivos' => $inactivos,
            ]
        ];
    }
}
