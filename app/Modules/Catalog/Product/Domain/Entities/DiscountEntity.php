<?php

namespace App\Modules\Catalog\Product\Domain\Entities;

class DiscountEntity
{
    private function __construct(
        private int $id,
        private int $productId,
        private float $amount,
        private string $startDate,
        private ?string $endDate,
        private bool $status
    ) {}

    /*----------------------------------------------------------------------
    CREACIÓN
    ----------------------------------------------------------------------*/
    public static function create(
        int $productId,
        float $amount,
        string $startDate,
        ?string $endDate,
    ): self {
        return new self(
            id: 0,
            productId: $productId,
            amount: $amount,
            startDate: $startDate,
            endDate: $endDate,
            status: true
        );
    }

    /*----------------------------------------------------------------------
    RECONSTITUCIÓN
    ----------------------------------------------------------------------*/
    public static function reconstitute(
        int $id,
        int $productId,
        float $amount,
        string $startDate,
        ?string $endDate,
        bool $status
    ): self {
        return new self(
            id: $id,
            productId: $productId,
            amount: $amount,
            startDate: $startDate,
            endDate: $endDate,
            status: $status
        );
    }
    /*----------------------------------------------------------------------
    GETTERS
    ----------------------------------------------------------------------*/
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
        return $this->amount;
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
