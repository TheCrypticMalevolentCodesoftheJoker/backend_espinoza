<?php

//--------------------------------------------------------------------------
// StoreArEventRequest: Validación y tipado de peticiones de registro de eventos AR
//--------------------------------------------------------------------------

namespace App\Modules\Analytics\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Analytics\Application\DTOs\Write\StoreArEventDTO;

class StoreArEventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    //--------------------------------------------------------------------------
    // Validación: Definición de restricciones para los datos de entrada
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

    public function messages(): array
    {
        return [
            'session_id.required' => 'El session_id es obligatorio.',
            'product_id.required' => 'El product_id es obligatorio.',
            'event_type.required' => 'El event_type es obligatorio.',
        ];
    }

    //--------------------------------------------------------------------------
    // Transformación: Mapeo de parámetros validados a un DTO de negocio
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
