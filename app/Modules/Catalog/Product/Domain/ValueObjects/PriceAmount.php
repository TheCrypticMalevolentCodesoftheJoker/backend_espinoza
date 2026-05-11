<?php

namespace App\Modules\Catalog\Product\Domain\ValueObjects;

use App\Shared\Exceptions\ValidationAppException;

class PriceAmount
{
    private float $value;

    public function __construct(float $amount, string $field = 'amount')
    {
        if ($amount <= 0) {
            throw new ValidationAppException(
                field: $field,
                message: 'El monto debe ser mayor a cero.'
            );
        }

        $this->value = round($amount, 2);
    }

    public function value(): float
    {
        return $this->value;
    }
}
