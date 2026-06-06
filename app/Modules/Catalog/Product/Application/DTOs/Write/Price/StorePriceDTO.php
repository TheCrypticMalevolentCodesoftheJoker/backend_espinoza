<?php

//--------------------------------------------------------------------------
// StorePriceDTO: DTO para el establecimiento y registro del precio de un producto
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Product\Application\DTOs\Write\Price;

class StorePriceDTO
{
    public function __construct(
        public float $amount,
        public string $startDate,
        public ?string $endDate = null,
    ) {}
}
