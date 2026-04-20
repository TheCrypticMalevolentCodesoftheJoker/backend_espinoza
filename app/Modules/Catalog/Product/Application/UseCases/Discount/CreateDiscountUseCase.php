<?php

namespace App\Modules\Catalog\Product\Application\UseCases\Discount;

use App\Modules\Catalog\Product\Application\DTOs\Discount\StoreDiscountDTO;
use App\Modules\Catalog\Product\Domain\Entities\DiscountEntity;
use App\Modules\Catalog\Product\Domain\Interfaces\DiscountInterface;

class CreateDiscountUseCase
{
    public function __construct(
        private DiscountInterface $discountInterface
    ) {}

    public function execute(int $productId, ?StoreDiscountDTO $storeDiscountDTO): void
    {
        $discount = DiscountEntity::create(
            productId: $productId,
            amount: $storeDiscountDTO->amount,
            startDate: $storeDiscountDTO->start_date,
            endDate: $storeDiscountDTO->end_date,
        );
        $this->discountInterface->save($discount);
    }
}
