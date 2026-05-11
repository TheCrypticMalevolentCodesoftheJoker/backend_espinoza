<?php

namespace App\Modules\Catalog\Product\Domain\Entities;

use App\Modules\Catalog\Product\Domain\ValueObjects\PriceAmount;

class PriceEntity
{
    private function __construct(
        private int $id,
        private int $productId,
        private PriceAmount $amount,
        private \DateTime $startDate,
        private ?\DateTime $endDate,
        private bool $status,
    ) {}

    //--------------------------------------------------------------------------
    // MÉTODOS DE CREACIÓN
    //--------------------------------------------------------------------------
    public static function create(
        int $productId,
        PriceAmount $amount,
        \DateTime $startDate,
        ?\DateTime $endDate = null,
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

    //--------------------------------------------------------------------------
    // MÉTODOS DE RECONSTRUCCIÓN
    //--------------------------------------------------------------------------
    public static function reconstitute(
        int $id,
        int $productId,
        PriceAmount $amount,
        \DateTime $startDate,
        ?\DateTime $endDate,
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

    //--------------------------------------------------------------------------
    // MÉTODOS DE CONSULTA (GETTERS)
    //--------------------------------------------------------------------------
    public function getId(): int { return $this->id; }
    public function getProductId(): int { return $this->productId; }
    public function getAmount(): float { return $this->amount->value(); }
    public function getStartDate(): \DateTime { return $this->startDate; }
    public function getEndDate(): ?\DateTime { return $this->endDate; }
    public function getStatus(): bool { return $this->status; }
}

