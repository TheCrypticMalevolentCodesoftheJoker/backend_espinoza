<?php

namespace App\Modules\Catalog\Product\Infrastructure\Persistence\Eloquent\Repositories;

use App\Modules\Catalog\Product\Domain\Entities\PriceEntity;
use App\Modules\Catalog\Product\Domain\Interfaces\PriceInterface;
use App\Modules\Catalog\Product\Infrastructure\Persistence\Eloquent\Models\TblPrice;

class EloquentPriceRepository implements PriceInterface
{
    public function save(PriceEntity $priceEntity): void
    {
        TblPrice::create([
            'product_id' => $priceEntity->getProductId(),
            'amount' => $priceEntity->getAmount(),
            'start_date' => $priceEntity->getStartDate(),
            'end_date' => $priceEntity->getEndDate(),
            'status' => $priceEntity->getStatus(),
        ]);
    }
}
