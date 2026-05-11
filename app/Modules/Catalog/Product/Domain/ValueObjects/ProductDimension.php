<?php

namespace App\Modules\Catalog\Product\Domain\ValueObjects;

use App\Shared\Exceptions\ValidationAppException;

class ProductDimension
{
    private string $value;

    public function __construct(string $dimension, string $field = 'dimension')
    {
        $normalized = trim($dimension);

        if ($normalized === '') {
            throw new ValidationAppException(
                field: $field,
                message: "La dimensión '$field' no puede estar vacía."
            );
        }

        $this->value = $normalized;
    }

    public function value(): string
    {
        return $this->value;
    }
}
