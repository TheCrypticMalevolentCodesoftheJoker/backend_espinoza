<?php 

//--------------------------------------------------------------------------
// StoreCategoryRequest: Solicitud de creación de categoría con reglas de validación HTTP
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Category\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Catalog\Category\Application\DTOs\Write\StoreCategoryDTO;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    //--------------------------------------------------------------------------
    // Validación: Reglas de validación HTTP y mensajes personalizados
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
    // Transformación: Conversión de la solicitud validada a un DTO de escritura
    //--------------------------------------------------------------------------
    public function toDto(): StoreCategoryDTO
    {
        return new StoreCategoryDTO(
            name: $this->validated('name')
        );
    }
}
