<?php

//--------------------------------------------------------------------------
// StoreBrandRequest: Validación HTTP para la creación de una marca
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Brand\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Catalog\Brand\Application\DTOs\Write\StoreBrandDTO;

class StoreBrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    //--------------------------------------------------------------------------
    // Validación: Restricciones aplicadas a los datos de creación de marcas
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
    public function toDto(): StoreBrandDTO
    {
        return new StoreBrandDTO(
            name: $this->validated('name')
        );
    }
}

