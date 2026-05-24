<?php

namespace App\Modules\Catalog\Brand\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Catalog\Brand\Application\DTOs\Write\UpdateBrandDTO;

class UpdateBrandRequest extends FormRequest
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
    public function toDto(): UpdateBrandDTO
    {
        return new UpdateBrandDTO(
            name: $this->validated('name')
        );
    }
}

