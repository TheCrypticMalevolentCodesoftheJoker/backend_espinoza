<?php

namespace App\Modules\Catalog\Product\Domain\ValueObjects;

use App\Shared\Exceptions\ValidationAppException;

class ProductName
{
    private string $value;

    public function __construct(string $name)
    {
        $normalized = trim($name);

        if ($normalized === '') {
            throw new ValidationAppException(
                field: 'name',
                message: 'El nombre del producto no puede estar vacío.'
            );
        }

        if (mb_strlen($normalized) > 255) {
            throw new ValidationAppException(
                field: 'name',
                message: 'El nombre del producto no puede superar los 255 caracteres.'
            );
        }

        $this->value = $normalized;
    }

    public function value(): string
    {
        return $this->value;
    }
}
