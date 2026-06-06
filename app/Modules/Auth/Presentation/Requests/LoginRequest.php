<?php

//--------------------------------------------------------------------------
// LoginRequest: Reglas de validación HTTP para solicitudes de inicio de sesión
//--------------------------------------------------------------------------

namespace App\Modules\Auth\Presentation\Requests;

use App\Modules\Auth\Application\DTOs\LoginDTO;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    //--------------------------------------------------------------------------
    // Validación: Reglas de validación para la autenticación de usuarios
    //--------------------------------------------------------------------------
    public function rules(): array
    {
        return [
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'    => 'El correo electrónico es obligatorio.',
            'email.email'       => 'El formato del correo electrónico no es válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ];
    }

    //--------------------------------------------------------------------------
    // Transformación: Mapeo de parámetros validados a un DTO de negocio
    //--------------------------------------------------------------------------
    public function toDto(): LoginDTO
    {
        return new LoginDTO(
            email: $this->validated('email'),
            password: $this->validated('password')
        );
    }
}
