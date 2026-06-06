<?php

//--------------------------------------------------------------------------
// ProductThickness: Objeto de valor que representa y valida el espesor/grosor de un producto
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Product\Domain\ValueObjects\Product;

use Illuminate\Validation\ValidationException;

class ProductThickness
{
    private string $value;

    public function __construct(string $thickness)
    {
        $normalized = trim($thickness);

        //--------------------------------------------------------------------------
        // Validación: Reglas de integridad para el grosor del producto
        //--------------------------------------------------------------------------
        if ($normalized === '') {
            throw ValidationException::withMessages([
                'thickness' => 'El grosor del producto no puede estar vacío.'
            ]);
        }

        $this->value = $normalized;
    }

    public function value(): string
    {
        return $this->value;
    }
}
