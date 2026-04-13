<?php

namespace App\Modules\Administration\Domain\ValueObjects;

use DomainException;

class CategoryName
{
    private string $value;

    public function __construct(string $name)
    {
        $normalizedName  = trim($name);

        if ($normalizedName  === '') {
            throw new DomainException('El nombre no puede estar vacío', 422);
        }

        if (!preg_match('/^[\pL\s]+$/u', $normalizedName )) {
            throw new DomainException('El nombre solo puede contener letras...', 422);
        }

        $this->value = $normalizedName ;
    }

    public function value(): string
    {
        return $this->value;
    }
}
