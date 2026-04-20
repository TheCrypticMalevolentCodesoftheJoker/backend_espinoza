<?php

namespace App\Modules\Catalog\Product\Application\DTOs\Price;

class StorePriceDTO
{
    public function __construct(
        public float $amount,
        public string $start_date,
        public ?string $end_date,
    ) {}
}