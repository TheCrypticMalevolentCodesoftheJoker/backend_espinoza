<?php

namespace App\Modules\Catalog\Brand\Domain\ValueObjects;

use DomainException;

class BrandName
{
    private string $value;

    public function __construct(string $name)
    {
        $normalizedName  = trim($name);

        if ($normalizedName  === '') {
            throw new DomainException('El nombre no puede estar vacío');
        }

        if (!preg_match('/^[\pL\s]+$/u', $normalizedName)) {
            throw new DomainException('El nombre solo puede contener letras...');
        }

        $this->value = $normalizedName;
    }

    public function value(): string
    {
        return $this->value;
    }
}
