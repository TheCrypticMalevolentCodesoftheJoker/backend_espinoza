<?php

namespace App\Modules\Catalog\Category\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Catalog\Category\Application\DTOs\Write\UpdateCategoryDTO;

class UpdateCategoryRequest extends FormRequest
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
    public function toDto(): UpdateCategoryDTO
    {
        return new UpdateCategoryDTO(
            name: $this->validated('name')
        );
    }
}
