<?php
//--------------------------------------------------------------------------
// StoreRoleRequest: Validación y transformación del request HTTP para creación de roles.
//--------------------------------------------------------------------------

namespace App\Modules\Role\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Role\Application\DTOs\Write\StoreRoleDTO;

class StoreRoleRequest extends FormRequest
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
            'name'        => ['required']
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
    public function toDto(): StoreRoleDTO
    {
        return new StoreRoleDTO(
            name: $this->validated('name')
        );
    }
}
