<?php

namespace App\Modules\User\Presentation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\User\Application\DTOs\UpdateUserDTO;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'roleId'   => ['required'],
            'name'     => ['required'],
            'email'    => ['required', 'email'],
            'password' => ['nullable']
        ];
    }

    public function messages(): array
    {
        return [
            'roleId.required'  => 'El rol es obligatorio',
            'name.required'    => 'El nombre es obligatorio',
            'email.required'   => 'El email es obligatorio',
            'email.email'      => 'El email no tiene un formato válido'
        ];
    }

    public function toDto(): UpdateUserDTO
    {
        return new UpdateUserDTO(
            roleId: (int) $this->validated('roleId'),
            name: $this->validated('name'),
            email: $this->validated('email'),
            password: $this->validated('password')
        );
    }
}
