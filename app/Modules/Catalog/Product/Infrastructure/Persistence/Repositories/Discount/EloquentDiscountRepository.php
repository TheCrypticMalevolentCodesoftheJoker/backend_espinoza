<?php

namespace App\Modules\Catalog\Product\Infrastructure\Persistence\Repositories\Discount;

use App\Modules\Catalog\Product\Domain\Entities\DiscountEntity;
use App\Modules\Catalog\Product\Domain\Interfaces\Discount\DiscountInterface;
use App\Modules\Catalog\Product\Domain\ValueObjects\Discount\DiscountAmount;
use App\Modules\Catalog\Product\Infrastructure\Persistence\Models\TblDiscount;

class EloquentDiscountRepository implements DiscountInterface
{
    //--------------------------------------------------------------------------
    // CONSULTA -> Obtener el descuento actual de un producto por ID
    //--------------------------------------------------------------------------
    public function findCurrentByProductId(int $productId): ?DiscountEntity
    {
        $model = TblDiscount::where('product_id', $productId)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->first();

        if (!$model) {
            return null;
        }

        return $this->mapToEntity($model);
    }

    //--------------------------------------------------------------------------
    // PERSISTENCIA -> Guardar un nuevo descuento de producto
    //--------------------------------------------------------------------------
    public function save(DiscountEntity $discountEntity): void
    {
        TblDiscount::create([
            'product_id' => $discountEntity->getProductId(),
            'amount'     => $discountEntity->getAmount(),
            'start_date' => $discountEntity->getStartDate(),
            'end_date'   => $discountEntity->getEndDate(),
            'status'     => $discountEntity->getStatus() ? 1 : 0,
        ]);
    }

    //--------------------------------------------------------------------------
    // MÉTODOS PRIVADOS -> Mapeo de persistencia a dominio
    //--------------------------------------------------------------------------
    private function mapToEntity($model): DiscountEntity
    {
        return DiscountEntity::reconstitute(
            id: $model->id,
            productId: $model->product_id,
            amount: new DiscountAmount($model->amount),
            startDate: (string) $model->start_date,
            endDate: $model->end_date ? (string) $model->end_date : null,
            status: (bool) $model->status,
        );
    }
}
