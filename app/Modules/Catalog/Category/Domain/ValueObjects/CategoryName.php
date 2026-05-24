<?php

namespace App\Modules\Catalog\Category\Domain\ValueObjects;

use Illuminate\Validation\ValidationException;

class CategoryName
{
    private string $value;

    public function __construct(string $name)
    {
        $normalized = trim($name);

        //--------------------------------------------------------------------------
        // REGLA DE DOMINIO -> No puede estar vacío
        //--------------------------------------------------------------------------
        if ($normalized === '') {
            throw ValidationException::withMessages([
                'name' => 'El nombre de la categoría no puede estar vacío.'
            ]);
        }

        //--------------------------------------------------------------------------
        // REGLA DE DOMINIO -> Solo caracteres válidos
        //--------------------------------------------------------------------------
        if (!preg_match('/^[\pL\s\-_]+$/u', $normalized)) {
            throw ValidationException::withMessages([
                'name' => 'El nombre de la categoría solo puede contener letras, espacios, guiones y guiones bajos.'
            ]);
        }

        $this->value = $normalized;
    }

    public function value(): string
    {
        return $this->value;
    }
}
