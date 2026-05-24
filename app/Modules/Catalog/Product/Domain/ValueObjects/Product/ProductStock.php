<?php

namespace App\Modules\Catalog\Product\Domain\ValueObjects\Product;

use Illuminate\Validation\ValidationException;

class ProductStock
{
    private int $value;

    public function __construct(int $stock)
    {
        //--------------------------------------------------------------------------
        // REGLA DE DOMINIO -> El stock del producto no puede ser negativo
        //--------------------------------------------------------------------------
        if ($stock < 0) {
            throw ValidationException::withMessages([
                'stock' => 'El stock del producto no puede ser negativo.'
            ]);
        }

        $this->value = $stock;
    }

    public function value(): int
    {
        return $this->value;
    }
}
