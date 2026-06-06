<?php
//--------------------------------------------------------------------------
// UpdateRoleRequest: Validación y transformación del request HTTP para actualización de roles.
//--------------------------------------------------------------------------

namespace App\Modules\Role\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Role\Application\DTOs\Write\UpdateRoleDTO;

class UpdateRoleRequest extends FormRequest
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
    public function toDto(): UpdateRoleDTO
    {
        return new UpdateRoleDTO(
            name: $this->validated('name')
        );
    }
}
