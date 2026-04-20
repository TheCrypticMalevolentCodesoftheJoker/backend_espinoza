<?php

namespace App\Modules\Catalog\Product\Infrastructure\Persistence\Eloquent\Repositories;

use App\Modules\Catalog\Product\Domain\Entities\DiscountEntity;
use App\Modules\Catalog\Product\Domain\Interfaces\DiscountInterface;
use App\Modules\Catalog\Product\Infrastructure\Persistence\Eloquent\Models\TblDiscount;

class EloquentDiscountRepository implements DiscountInterface
{
    public function save(DiscountEntity $discountEntity): void
    {
        TblDiscount::create([
            'product_id' => $discountEntity->getProductId(),
            'amount' => $discountEntity->getAmount(),
            'start_date' => $discountEntity->getStartDate(),
            'end_date' => $discountEntity->getEndDate(),
            'status' => $discountEntity->getStatus(),
        ]);
    }
}
