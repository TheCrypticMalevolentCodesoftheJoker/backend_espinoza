<?php

namespace App\Modules\Catalog\Product\Domain\ValueObjects;

use App\Shared\Exceptions\ValidationAppException;

class ProductStock
{
    private int $value;

    public function __construct(int $stock)
    {
        if ($stock < 0) {
            throw new ValidationAppException(
                field: 'stock',
                message: 'El stock del producto no puede ser negativo.'
            );
        }

        $this->value = $stock;
    }

    public function value(): int
    {
        return $this->value;
    }
}
