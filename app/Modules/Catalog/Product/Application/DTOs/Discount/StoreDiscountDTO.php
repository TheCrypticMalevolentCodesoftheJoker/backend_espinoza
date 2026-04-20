<?php

namespace App\Modules\Catalog\Product\Application\DTOs\Discount;

class StoreDiscountDTO
{
    public function __construct(
        public float $amount,
        public string $start_date,
        public ?string $end_date,
    ) {}
}