<?php

//--------------------------------------------------------------------------
// CategoryName: Objeto de valor para el nombre validado de una categoría
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Category\Domain\ValueObjects;

use Illuminate\Validation\ValidationException;

class CategoryName
{
    private string $value;

    public function __construct(string $name)
    {
        $normalized = trim($name);

        //--------------------------------------------------------------------------
        // Validación: Reglas de integridad para el nombre de la categoría
        //--------------------------------------------------------------------------
        if ($normalized === '') {
            throw ValidationException::withMessages([
                'name' => 'El nombre de la categoría no puede estar vacío.'
            ]);
        }

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
