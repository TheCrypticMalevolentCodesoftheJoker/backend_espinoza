<?php

namespace App\Modules\Catalog\Product\Infrastructure\Persistence\Eloquent\Queries;

use App\Modules\Catalog\Product\Application\DTOs\Product\ProductDetailDTO;
use App\Modules\Catalog\Product\Application\DTOs\Product\ProductDTO;
use App\Modules\Catalog\Product\Application\Queries\ProductReadRepository;
use App\Modules\Catalog\Product\Infrastructure\Persistence\Eloquent\Models\TblProduct;

class EloquentProductReadRepository implements ProductReadRepository
{
    /*----------------------------------------------------------------------------------
    LISTAR PRODUCTOS
    ----------------------------------------------------------------------------------*/
    public function findAll(): array
    {
        return TblProduct::with(['tbl_category', 'tbl_brand'])
            ->get()
            ->map(fn($product) => new ProductDTO(
                id: $product->id,
                code: $product->code,
                category_id: $product->category_id,
                category_name: $product->tbl_category?->name,
                brand_id: $product->brand_id,
                brand_name: $product->tbl_brand?->name,
                name: $product->name,
                description: $product->description,
                unit_measure: $product->unit_measure,
                stock: $product->stock,
                status: $product->status,
            ))
            ->toArray();
    }

    /*----------------------------------------------------------------------------------
    BUSCAR PRODUCTO POR ID
    ----------------------------------------------------------------------------------*/
    public function findById(string $id): ?ProductDetailDTO
    {
        $product = TblProduct::with([
            'tbl_category',
            'tbl_brand',
            'tbl_dimensions',
            'tbl_discounts',
            'tbl_images',
            'tbl_prices'
        ])->find($id);

        if (!$product) {
            return null;
        }

        return new ProductDetailDTO(
            // PRODUCTO
            id: $product->id,
            code: $product->code,
            category_id: $product->category_id,
            category_name: $product->tbl_category?->name ?? '',
            brand_id: $product->brand_id,
            brand_name: $product->tbl_brand?->name ?? '',
            name: $product->name,
            description: $product->description,
            unit_measure: $product->unit_measure,
            stock: $product->stock,
            status: $product->status,

            // RELACIONES (ARRAYS DIRECTOS)
            dimensions: $product->tbl_dimensions->map(fn($d) => [
                'id' => $d->id,
                'length' => $d->length,
                'width' => $d->width,
                'thickness' => $d->thickness,
            ])->toArray(),

            discounts: $product->tbl_discounts->map(fn($d) => [
                'id' => $d->id,
                'amount' => $d->amount,
                'start_date' => $d->start_date,
                'end_date' => $d->end_date,
                'status' => $d->status,
            ])->toArray(),

            images: $product->tbl_images->map(fn($i) => [
                'id' => $i->id,
                'url' => $i->url,
                'type' => $i->type,
            ])->toArray(),

            prices: $product->tbl_prices->map(fn($p) => [
                'id' => $p->id,
                'amount' => $p->amount,
                'start_date' => $p->start_date,
                'end_date' => $p->end_date,
                'status' => $p->status,
            ])->toArray(),
        );
    }
}
