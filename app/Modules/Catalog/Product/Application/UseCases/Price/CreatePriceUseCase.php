<?php

namespace App\Modules\Catalog\Product\Application\UseCases\Price;

use App\Modules\Catalog\Product\Application\DTOs\Price\StorePriceDTO;
use App\Modules\Catalog\Product\Domain\Entities\PriceEntity;
use App\Modules\Catalog\Product\Domain\Interfaces\PriceInterface;

class CreatePriceUseCase
{
    public function __construct(
        private PriceInterface $priceInterface
    ) {}

    public function execute(int $productId, StorePriceDTO $storePriceDTO): void
    {
        $price = PriceEntity::create(
            productId: $productId,
            amount: $storePriceDTO->amount,
            startDate: $storePriceDTO->start_date,
            endDate: $storePriceDTO->end_date
        );

        $this->priceInterface->save($price);
    }
}
