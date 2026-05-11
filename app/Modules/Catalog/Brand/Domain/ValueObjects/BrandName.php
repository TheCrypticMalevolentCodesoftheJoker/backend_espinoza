<?php

namespace App\Modules\Catalog\Brand\Domain\ValueObjects;

use App\Shared\Exceptions\ValidationAppException;

class BrandName
{
    private string $value;

    public function __construct(string $name)
    {
        $normalized = trim($name);

        if ($normalized === '') {
            throw new ValidationAppException(
                field: 'name',
                message: 'El nombre de la marca no puede estar vacío.'
            );
        }

        if (!preg_match('/^[\pL\s\-_]+$/u', $normalized)) {
            throw new ValidationAppException(
                field: 'name',
                message: 'El nombre de la marca solo debe contener letras.'
            );
        }

        $this->value = $normalized;
    }

    public function value(): string
    {
        return $this->value;
    }
}
