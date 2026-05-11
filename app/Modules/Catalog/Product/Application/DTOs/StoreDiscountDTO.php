<?php

namespace App\Modules\Catalog\Product\Application\DTOs;

class StoreDiscountDTO
{
    public function __construct(
        public float $amount,
        public string $startDate,
        public ?string $endDate = null,
    ) {}
}

