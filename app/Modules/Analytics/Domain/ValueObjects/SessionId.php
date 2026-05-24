<?php

namespace App\Modules\Analytics\Domain\ValueObjects;

use Illuminate\Validation\ValidationException;

class SessionId
{
    private string $value;

    //--------------------------------------------------------------------------
    // VALIDACIÓN -> Valida que el session_id cumpla con las reglas del dominio
    //--------------------------------------------------------------------------
    public function __construct(string $value)
    {
        $normalized = trim($value);

        if ($normalized === '') {
            throw ValidationException::withMessages([
                'session_id' => 'El session_id no puede estar vacío.'
            ]);
        }

        $this->value = $normalized;
    }

    //--------------------------------------------------------------------------
    // CONSULTA -> Retorna el valor primitivo interno
    //--------------------------------------------------------------------------
    public function value(): string
    {
        return $this->value;
    }
}
