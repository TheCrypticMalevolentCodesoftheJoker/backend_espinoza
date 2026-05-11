<?php

namespace App\Modules\Catalog\Product\Infrastructure\Persistence\Eloquent\Repositories;

use App\Modules\Catalog\Product\Domain\Entities\DiscountEntity;
use App\Modules\Catalog\Product\Domain\Entities\ImageEntity;
use App\Modules\Catalog\Product\Domain\Entities\PriceEntity;
use App\Modules\Catalog\Product\Domain\Entities\ProductEntity;
use App\Modules\Catalog\Product\Domain\Interfaces\ProductInterface;
use App\Modules\Catalog\Product\Domain\ValueObjects\ImageType;
use App\Modules\Catalog\Product\Domain\ValueObjects\PriceAmount;
use App\Modules\Catalog\Product\Domain\ValueObjects\ProductCode;
use App\Modules\Catalog\Product\Domain\ValueObjects\ProductDimension;
use App\Modules\Catalog\Product\Domain\ValueObjects\ProductName;
use App\Modules\Catalog\Product\Domain\ValueObjects\ProductStock;
use App\Modules\Catalog\Product\Infrastructure\Persistence\Eloquent\Models\TblDiscount;
use App\Modules\Catalog\Product\Infrastructure\Persistence\Eloquent\Models\TblImage;
use App\Modules\Catalog\Product\Infrastructure\Persistence\Eloquent\Models\TblPrice;
use App\Modules\Catalog\Product\Infrastructure\Persistence\Eloquent\Models\TblProduct;

class EloquentProductRepository implements ProductInterface
{
    //--------------------------------------------------------------------------
    // OPERACIONES DE LECTURA
    //--------------------------------------------------------------------------
    public function findAll(): array
    {
        return TblProduct::with([
            'tbl_images',
            'tbl_prices' => fn($q) => $q->where('status', true)->latest('start_date')->limit(1),
        ])
            ->get()
            ->map(fn($model) => $this->reconstituteFromModel($model))
            ->toArray();
    }

    //--------------------------------------------------------------------------
    // AGREGACIONES / KPIs
    //--------------------------------------------------------------------------
    public function countAll(): int
    {
        return TblProduct::count();
    }

    public function countActive(): int
    {
        return TblProduct::where('status', 1)->count();
    }

    public function countInactive(): int
    {
        return TblProduct::where('status', 0)->count();
    }

    //--------------------------------------------------------------------------
    // OPERACIONES DE ESCRITURA (AGGREGATE ROOT)
    //--------------------------------------------------------------------------
    public function getNextSequenceValue(): int
    {
        return TblProduct::withTrashed()->count() + 1;
    }

    public function findById(int $id): ?ProductEntity
    {
        $model = TblProduct::with([
            'tbl_images',
            'tbl_prices'    => fn($q) => $q->where('status', true)->latest('start_date')->limit(1),
            'tbl_discounts' => fn($q) => $q->where('status', true)->latest('start_date')->limit(1),
        ])->find($id);

        return $model ? $this->reconstituteFromModel($model) : null;
    }

    public function findByCode(string $code): ?ProductEntity
    {
        $model = TblProduct::where('code', $code)->first();

        return $model ? $this->reconstituteFromModel($model) : null;
    }

    public function save(ProductEntity $product): int
    {
        $model = TblProduct::create([
            'code'         => $product->getCode(),
            'category_id'  => $product->getCategoryId(),
            'brand_id'     => $product->getBrandId(),
            'name'         => $product->getName(),
            'description'  => $product->getDescription(),
            'unit_measure' => $product->getUnitMeasure(),
            'length'       => $product->getLength(),
            'width'        => $product->getWidth(),
            'thickness'    => $product->getThickness(),
            'stock'        => $product->getStock(),
            'status'       => $product->getStatus(),
        ]);

        return $model->id;
    }

    public function update(ProductEntity $product): void
    {
        TblProduct::findOrFail($product->getId())->update([
            'code'         => $product->getCode(),
            'category_id'  => $product->getCategoryId(),
            'brand_id'     => $product->getBrandId(),
            'name'         => $product->getName(),
            'description'  => $product->getDescription(),
            'unit_measure' => $product->getUnitMeasure(),
            'length'       => $product->getLength(),
            'width'        => $product->getWidth(),
            'thickness'    => $product->getThickness(),
            'stock'        => $product->getStock(),
            'status'       => $product->getStatus(),
        ]);
    }

    public function delete(int $id): void
    {
        TblProduct::findOrFail($id)->delete();
    }

    //--------------------------------------------------------------------------
    // OPERACIONES DE ESCRITURA (CHILD ENTITIES)
    //--------------------------------------------------------------------------
    public function replaceImages(int $productId, array $images): void
    {
        TblImage::where('product_id', $productId)->delete();

        foreach ($images as $image) {
            TblImage::create([
                'product_id' => $productId,
                'url'        => $image->getPath(),
                'type'       => $image->getType(),
            ]);
        }
    }

    public function saveCurrentPrice(int $productId, PriceEntity $price): void
    {
        TblPrice::where('product_id', $productId)->update(['status' => false]);

        TblPrice::create([
            'product_id' => $productId,
            'amount'     => $price->getAmount(),
            'start_date' => $price->getStartDate(),
            'end_date'   => $price->getEndDate(),
            'status'     => true,
        ]);
    }

    public function saveCurrentDiscount(int $productId, DiscountEntity $discount): void
    {
        TblDiscount::where('product_id', $productId)->update(['status' => false]);

        TblDiscount::create([
            'product_id' => $productId,
            'amount'     => $discount->getAmount(),
            'start_date' => $discount->getStartDate(),
            'end_date'   => $discount->getEndDate(),
            'status'     => true,
        ]);
    }

    //--------------------------------------------------------------------------
    // HELPER PRIVADO
    //--------------------------------------------------------------------------
    private function reconstituteFromModel(TblProduct $model): ProductEntity
    {
        $images = $model->tbl_images
            ->map(fn($img) => ImageEntity::reconstitute(
                id: $img->id,
                productId: $img->product_id,
                path: $img->url,
                type: new ImageType($img->type),
            ))
            ->toArray();

        $priceModel = $model->tbl_prices->first();
        $currentPrice = $priceModel ? PriceEntity::reconstitute(
            id: $priceModel->id,
            productId: $priceModel->product_id,
            amount: new PriceAmount($priceModel->amount),
            startDate: $priceModel->start_date->toDateTime(),
            endDate: $priceModel->end_date?->toDateTime(),
            status: $priceModel->status,
        ) : null;

        $discountModel = $model->relationLoaded('tbl_discounts')
            ? $model->tbl_discounts->first()
            : null;

        $currentDiscount = $discountModel ? DiscountEntity::reconstitute(
            id: $discountModel->id,
            productId: $discountModel->product_id,
            amount: new PriceAmount($discountModel->amount, 'discount'),
            startDate: $discountModel->start_date->toDateTime(),
            endDate: $discountModel->end_date?->toDateTime(),
            status: $discountModel->status,
        ) : null;

        return ProductEntity::reconstitute(
            id: $model->id,
            categoryId: $model->category_id,
            brandId: $model->brand_id,
            code: new ProductCode($model->code),
            name: new ProductName($model->name),
            description: $model->description,
            unitMeasure: $model->unit_measure,
            length: new ProductDimension($model->length, 'length'),
            width: new ProductDimension($model->width, 'width'),
            thickness: new ProductDimension($model->thickness, 'thickness'),
            stock: new ProductStock($model->stock),
            status: $model->status,
            images: $images,
            currentPrice: $currentPrice,
            currentDiscount: $currentDiscount,
            createdAt: $model->created_at?->toDateTime(),
            updatedAt: $model->updated_at?->toDateTime(),
        );
    }
}
