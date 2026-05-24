<?php

namespace App\Modules\Catalog\Brand\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Catalog\Brand\Application\DTOs\Write\StoreBrandDTO;

class StoreBrandRequest extends FormRequest
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
            'name' => ['required']
        ];
    }

    //--------------------------------------------------------------------------
    // MENSAJES -> Mensajes de validación personalizados
    //--------------------------------------------------------------------------
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio'
        ];
    }

    //--------------------------------------------------------------------------
    // MAPEO -> Convertir a DTO de aplicación
    //--------------------------------------------------------------------------
    public function toDto(): StoreBrandDTO
    {
        return new StoreBrandDTO(
            name: $this->validated('name')
        );
    }
}

