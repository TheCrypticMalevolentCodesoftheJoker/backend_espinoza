<?php

namespace App\Modules\Catalog\Product\Infrastructure\Persistence\Repositories\Price;

use App\Modules\Catalog\Product\Domain\Entities\PriceEntity;
use App\Modules\Catalog\Product\Domain\Interfaces\Price\PriceInterface;
use App\Modules\Catalog\Product\Domain\ValueObjects\Price\PriceAmount;
use App\Modules\Catalog\Product\Infrastructure\Persistence\Models\TblPrice;

class EloquentPriceRepository implements PriceInterface
{
    //--------------------------------------------------------------------------
    // CONSULTA -> Obtener el precio actual de un producto por ID
    //--------------------------------------------------------------------------
    public function findCurrentByProductId(int $productId): ?PriceEntity
    {
        $model = TblPrice::where('product_id', $productId)
            ->where('status', 1)
            ->orderBy('id', 'desc') // Traer el más reciente por si acaso
            ->first();

        if (!$model) {
            return null;
        }

        return $this->mapToEntity($model);
    }

    //--------------------------------------------------------------------------
    // PERSISTENCIA -> Guardar un nuevo precio de producto
    //--------------------------------------------------------------------------
    public function save(PriceEntity $priceEntity): void
    {
        TblPrice::create([
            'product_id' => $priceEntity->getProductId(),
            'amount'     => $priceEntity->getAmount(),
            'start_date' => $priceEntity->getStartDate(),
            'end_date'   => $priceEntity->getEndDate(),
            'status'     => $priceEntity->getStatus() ? 1 : 0,
        ]);
    }

    //--------------------------------------------------------------------------
    // MÉTODOS PRIVADOS -> Mapeo de persistencia a dominio
    //--------------------------------------------------------------------------
    private function mapToEntity($model): PriceEntity
    {
        return PriceEntity::reconstitute(
            id: $model->id,
            productId: $model->product_id,
            amount: new PriceAmount($model->amount),
            startDate: (string) $model->start_date,
            endDate: $model->end_date ? (string) $model->end_date : null,
            status: (bool) $model->status,
        );
    }
}
