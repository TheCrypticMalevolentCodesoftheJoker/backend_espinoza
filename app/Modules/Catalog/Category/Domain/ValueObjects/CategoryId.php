<?php

namespace App\Modules\Catalog\Category\Domain\ValueObjects;

use DomainException;

class CategoryId
{
    private int $value;

    public function __construct(int|string $id)
    {
        if (!ctype_digit((string) $id)) {
            throw new DomainException('El ID debe ser numérico');
        }

        $id = (int) $id;

        if ($id <= 0) {
            throw new DomainException('El ID debe ser mayor a 0');
        }

        $this->value = $id;
    }

    public function value(): int
    {
        return $this->value;
    }
}