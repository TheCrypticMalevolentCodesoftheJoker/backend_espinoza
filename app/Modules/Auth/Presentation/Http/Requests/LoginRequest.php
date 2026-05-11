<?php

namespace App\Modules\Auth\Presentation\Http\Requests;

use App\Modules\Auth\Application\DTOs\LoginDTO;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
            'remember' => ['nullable'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo electrónico no es válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ];
    }
    public function toDto(): LoginDTO
    {
        return new LoginDTO(
            email: $this->validated('email'),
            password: $this->validated('password'),
            remember: $this->boolean('remember')
        );
    }
}
