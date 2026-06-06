<?php

//--------------------------------------------------------------------------
// UpdateBrandRequest: Validación HTTP para la actualización de una marca
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Brand\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Catalog\Brand\Application\DTOs\Write\UpdateBrandDTO;

class UpdateBrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    //--------------------------------------------------------------------------
    // Validación: Restricciones aplicadas a los datos de actualización de marcas
    //--------------------------------------------------------------------------
    public function rules(): array
    {
        return [
            'name' => ['required']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio'
        ];
    }

    //--------------------------------------------------------------------------
    // Transformación: Mapeo de parámetros validados a un DTO de negocio
    //--------------------------------------------------------------------------
    public function toDto(): UpdateBrandDTO
    {
        return new UpdateBrandDTO(
            name: $this->validated('name')
        );
    }
}

