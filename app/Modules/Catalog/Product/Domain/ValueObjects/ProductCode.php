<?php

namespace App\Modules\Catalog\Product\Domain\ValueObjects;

use App\Shared\Exceptions\ValidationAppException;

class ProductCode
{
    private string $value;

    public function __construct(string $code)
    {
        $normalized = trim(strtoupper($code));

        if ($normalized === '') {
            throw new ValidationAppException(
                field: 'code',
                message: 'El código del producto no puede estar vacío.'
            );
        }

        if (!preg_match('/^[A-Z0-9\-_]+$/', $normalized)) {
            throw new ValidationAppException(
                field: 'code',
                message: 'El código solo puede contener letras mayúsculas, números, guiones y guiones bajos.'
            );
        }

        $this->value = $normalized;
    }

    public function value(): string
    {
        return $this->value;
    }
}
