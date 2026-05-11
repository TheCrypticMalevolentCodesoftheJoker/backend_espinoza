<?php

namespace App\Modules\Catalog\Product\Domain\ValueObjects;

use App\Shared\Exceptions\ValidationAppException;

class ImageType
{
    private const VALID_TYPES = ['png', '3d'];

    private string $value;

    public function __construct(string $type)
    {
        $normalized = strtolower(trim($type));

        if (!in_array($normalized, self::VALID_TYPES, true)) {
            throw new ValidationAppException(
                field: 'type',
                message: 'El tipo de imagen debe ser "png" o "3d".'
            );
        }

        $this->value = $normalized;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function isPng(): bool
    {
        return $this->value === 'png';
    }

    public function is3d(): bool
    {
        return $this->value === '3d';
    }
}
