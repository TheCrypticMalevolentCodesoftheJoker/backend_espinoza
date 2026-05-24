<?php

namespace App\Modules\Catalog\Product\Domain\ValueObjects\Product;

use Illuminate\Validation\ValidationException;

class ProductWidth
{
    private string $value;

    public function __construct(string $width)
    {
        $normalized = trim($width);

        //--------------------------------------------------------------------------
        // REGLA DE DOMINIO -> El ancho del producto no puede estar vacío
        //--------------------------------------------------------------------------
        if ($normalized === '') {
            throw ValidationException::withMessages([
                'width' => 'El ancho del producto no puede estar vacío.'
            ]);
        }

        $this->value = $normalized;
    }

    public function value(): string
    {
        return $this->value;
    }
}
