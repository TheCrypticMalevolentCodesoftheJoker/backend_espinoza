<?php

//--------------------------------------------------------------------------
// PriceEntity: Entidad que define la estructura y lógica de negocio de los precios de productos
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Product\Domain\Entities;

use App\Modules\Catalog\Product\Domain\ValueObjects\Price\PriceAmount;

class PriceEntity
{
    private function __construct(
        private int $id,
        private int $productId,
        private PriceAmount $amount,
        private string $startDate,
        private ?string $endDate,
        private bool $status,
    ) {}

    public static function create(
        int $productId,
        PriceAmount $amount,
        string $startDate,
        ?string $endDate = null,
    ): self {
        return new self(
            id: 0,
            productId: $productId,
            amount: $amount,
            startDate: $startDate,
            endDate: $endDate,
            status: true,
        );
    }

    public static function reconstitute(
        int $id,
        int $productId,
        PriceAmount $amount,
        string $startDate,
        ?string $endDate,
        bool $status,
    ): self {
        return new self(
            id: $id,
            productId: $productId,
            amount: $amount,
            startDate: $startDate,
            endDate: $endDate,
            status: $status,
        );
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getProductId(): int
    {
        return $this->productId;
    }
    public function getAmount(): float
    {
        return $this->amount->value();
    }
    public function getStartDate(): string
    {
        return $this->startDate;
    }
    public function getEndDate(): ?string
    {
        return $this->endDate;
    }
    public function getStatus(): bool
    {
        return $this->status;
    }
}
