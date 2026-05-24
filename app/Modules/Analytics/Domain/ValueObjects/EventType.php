<?php

namespace App\Modules\Analytics\Domain\ValueObjects;

use Illuminate\Validation\ValidationException;

class EventType
{
    private string $value;

    //--------------------------------------------------------------------------
    // VALIDACIÓN -> Valida que el tipo de evento cumpla con las reglas del dominio
    //--------------------------------------------------------------------------
    public function __construct(string $value)
    {
        $normalized = trim($value);

        if ($normalized === '') {
            throw ValidationException::withMessages([
                'event_type' => 'El tipo de evento no puede estar vacío.'
            ]);
        }

        if (strlen($normalized) > 50) {
            throw ValidationException::withMessages([
                'event_type' => 'El tipo de evento no puede superar los 50 caracteres.'
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
