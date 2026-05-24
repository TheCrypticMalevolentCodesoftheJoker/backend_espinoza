<?php

namespace App\Modules\Catalog\Product\Application\DTOs\Read\Price;

use JsonSerializable;

class PriceDTO implements JsonSerializable
{
    public function __construct(
        public int $id,
        public float $amount,
        public string $startDate,
        public ?string $endDate,
        public bool $status,
    ) {}

    public function jsonSerialize(): mixed
    {
        return [
            'id'        => $this->id,
            'amount'    => $this->amount,
            'startDate' => $this->startDate,
            'endDate'   => $this->endDate,
            'status'    => $this->status,
        ];
    }
}
