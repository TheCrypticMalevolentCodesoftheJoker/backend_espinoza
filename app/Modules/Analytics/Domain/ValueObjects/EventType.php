<?php

//--------------------------------------------------------------------------
// EventType: Representación y validación del tipo de evento de analítica AR
//--------------------------------------------------------------------------

namespace App\Modules\Analytics\Domain\ValueObjects;

use Illuminate\Validation\ValidationException;

class EventType
{
    private string $value;

    //--------------------------------------------------------------------------
    // Validación: Control de integridad y formato del tipo de evento
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

    public function value(): string
    {
        return $this->value;
    }
}
