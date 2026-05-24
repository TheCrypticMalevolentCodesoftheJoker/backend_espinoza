<?php

namespace App\Modules\Catalog\Product\Domain\ValueObjects\Discount;

use Illuminate\Validation\ValidationException;

class DiscountAmount
{
    private float $value;

    public function __construct(float $amount)
    {
        //--------------------------------------------------------------------------
        // REGLA DE DOMINIO -> El monto del descuento debe ser mayor a cero
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
