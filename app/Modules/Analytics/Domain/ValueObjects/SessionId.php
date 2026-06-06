<?php

//--------------------------------------------------------------------------
// SessionId: Representación y validación del identificador único de sesión AR
//--------------------------------------------------------------------------

namespace App\Modules\Analytics\Domain\ValueObjects;

use Illuminate\Validation\ValidationException;

class SessionId
{
    private string $value;

    //--------------------------------------------------------------------------
    // Validación: Control de integridad del identificador de sesión
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

    public function value(): string
    {
        return $this->value;
    }
}
