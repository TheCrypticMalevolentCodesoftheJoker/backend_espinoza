<?php

namespace App\Modules\Catalog\Product\Application\DTOs;

class DiscountDTO
{
    public function __construct(
        public int $id,
        public float $amount,
        public \DateTime $startDate,
        public ?\DateTime $endDate,
        public bool $status,
    ) {}
}

