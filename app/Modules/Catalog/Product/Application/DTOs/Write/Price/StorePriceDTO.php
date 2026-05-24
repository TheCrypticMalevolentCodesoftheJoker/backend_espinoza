<?php

namespace App\Modules\Catalog\Product\Application\DTOs\Write\Price;

class StorePriceDTO
{
    public function __construct(
        public float $amount,
        public string $startDate,
        public ?string $endDate = null,
    ) {}
}
