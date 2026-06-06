<?php
//--------------------------------------------------------------------------
// UpdateUserRequest: Validación y transformación del request HTTP para actualización de usuarios.
// La contraseña es nullable para permitir actualización sin cambio de credenciales.
//--------------------------------------------------------------------------

namespace App\Modules\User\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\User\Application\DTOs\Write\UpdateUserDTO;

class UpdateUserRequest extends FormRequest
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
            'roleId'   => ['required'],
            'name'     => ['required'],
            'email'    => ['required', 'email'],
            'password' => ['nullable']
        ];
    }

    //--------------------------------------------------------------------------
    // MENSAJES -> Mensajes de validación personalizados
    //--------------------------------------------------------------------------
    public function messages(): array
    {
        return [
            'roleId.required'  => 'El rol es obligatorio',
            'name.required'    => 'El nombre es obligatorio',
            'email.required'   => 'El email es obligatorio',
            'email.email'      => 'El email no tiene un formato válido'
        ];
    }

    //--------------------------------------------------------------------------
    // MAPEO -> Convertir a DTO de aplicación
    //--------------------------------------------------------------------------
    public function toDto(): UpdateUserDTO
    {
        return new UpdateUserDTO(
            roleId: $this->validated('roleId'),
            name: $this->validated('name'),
            email: $this->validated('email'),
            password: $this->validated('password')
        );
    }
}
