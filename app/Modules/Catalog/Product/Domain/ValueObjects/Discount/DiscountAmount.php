<?php

//--------------------------------------------------------------------------
// DiscountAmount: Objeto de valor que representa y valida el monto de un descuento de producto
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Product\Domain\ValueObjects\Discount;

use Illuminate\Validation\ValidationException;

class DiscountAmount
{
    private float $value;

    public function __construct(float $amount)
    {
        //--------------------------------------------------------------------------
        // Validación: Reglas de integridad para el monto del descuento
        //--------------------------------------------------------------------------
        if ($amount <= 0) {
            throw ValidationException::withMessages([
                'amount' => 'El monto del descuento debe ser mayor a cero.'
            ]);
        }

        $this->value = round($amount, 2);
    }

    public function value(): float
    {
        return $this->value;
    }
}
