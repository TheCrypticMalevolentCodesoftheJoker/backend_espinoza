<?php

namespace App\Modules\Analytics\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Analytics\Application\DTOs\Write\StoreArEventDTO;

class StoreArEventRequest extends FormRequest
{
    //--------------------------------------------------------------------------
    // AUTORIZACIÓN -> Permisos del request
    //--------------------------------------------------------------------------
    public function authorize(): bool
    {
        return true;
    }

    //--------------------------------------------------------------------------
    // REGLAS -> Reglas de validación
    //--------------------------------------------------------------------------
    public function rules(): array
    {
        return [
            'session_id'       => ['required'],
            'product_id'       => ['required'],
            'event_type'       => ['required'],
            'duration_seconds' => ['nullable'],
        ];
    }

    //--------------------------------------------------------------------------
    // MENSAJES -> Mensajes de validación personalizados
    //--------------------------------------------------------------------------
    public function messages(): array
    {
        return [
            'session_id.required' => 'El session_id es obligatorio.',
            'product_id.required' => 'El product_id es obligatorio.',
            'event_type.required' => 'El event_type es obligatorio.',
        ];
    }

    //--------------------------------------------------------------------------
    // MAPEO -> Convertir a DTO de aplicación
    //--------------------------------------------------------------------------
    public function toDto(): StoreArEventDTO
    {
        return new StoreArEventDTO(
            sessionId: $this->validated('session_id'),
            productId: $this->validated('product_id'),
            eventType: $this->validated('event_type'),
            durationSeconds: $this->filled('duration_seconds') ? (int) $this->input('duration_seconds') : null,
        );
    }
}
