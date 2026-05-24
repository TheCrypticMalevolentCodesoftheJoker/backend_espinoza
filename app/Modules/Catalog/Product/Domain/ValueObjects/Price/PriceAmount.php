<?php

namespace App\Modules\Catalog\Product\Domain\ValueObjects\Price;

use Illuminate\Validation\ValidationException;

class PriceAmount
{
    private float $value;

    public function __construct(float $amount)
    {
        //--------------------------------------------------------------------------
        // REGLA DE DOMINIO -> El monto del precio debe ser mayor a cero
        //--------------------------------------------------------------------------
        if ($amount <= 0) {
            throw ValidationException::withMessages([
                'amount' => 'El monto del precio debe ser mayor a cero.'
            ]);
        }

        $this->value = round($amount, 2);
    }

    public function value(): float
    {
        return $this->value;
    }
}
