<?php

namespace App\Modules\User\Presentation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\User\Application\DTOs\StoreUserDTO;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'roleId'  => ['required'],
            'name'     => ['required'],
            'email'    => ['required', 'email'],
            'password' => ['required']
        ];
    }
    public function messages(): array
    {
        return [
            'roleId.required' => 'El rol es obligatorio',
            'name.required'    => 'El nombre es obligatorio',
            'email.required'   => 'El email es obligatorio',
            'email.email'      => 'El email no tiene un formato válido',
            'password.required' => 'La contraseña es obligatoria',
        ];
    }
    public function toDto(): StoreUserDTO
    {
        return new StoreUserDTO(
            roleId: (int) $this->validated('roleId'),
            name: $this->validated('name'),
            email: $this->validated('email'),
            password: $this->validated('password')
        );
    }
}
