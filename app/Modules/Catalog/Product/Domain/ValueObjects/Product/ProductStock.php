<?php

//--------------------------------------------------------------------------
// ProductStock: Objeto de valor que representa y valida el inventario/stock disponible de un producto
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Product\Domain\ValueObjects\Product;

use Illuminate\Validation\ValidationException;

class ProductStock
{
    private int $value;

    public function __construct(int $stock)
    {
        //--------------------------------------------------------------------------
        // Validación: Reglas de integridad para el stock del producto
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
