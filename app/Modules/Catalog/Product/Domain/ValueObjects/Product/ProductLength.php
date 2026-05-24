<?php

namespace App\Modules\Catalog\Product\Domain\ValueObjects\Product;

use Illuminate\Validation\ValidationException;

class ProductLength
{
    private string $value;

    public function __construct(string $length)
    {
        $normalized = trim($length);

        //--------------------------------------------------------------------------
        // REGLA DE DOMINIO -> El largo del producto no puede estar vacío
        //--------------------------------------------------------------------------
        if ($normalized === '') {
            throw ValidationException::withMessages([
                'length' => 'El largo del producto no puede estar vacío.'
            ]);
        }

        $this->value = $normalized;
    }

    public function value(): string
    {
        return $this->value;
    }
}
