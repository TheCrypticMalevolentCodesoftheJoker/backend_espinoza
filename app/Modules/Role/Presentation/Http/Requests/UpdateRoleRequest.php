<?php

namespace App\Modules\Role\Presentation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Role\Application\DTOs\UpdateRoleDTO;

class UpdateRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => ['required'],
            'description' => ['nullable', 'string']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio'
        ];
    }

    public function toDto(): UpdateRoleDTO
    {
        return new UpdateRoleDTO(
            name: $this->validated('name'),
            description: $this->validated('description')
        );
    }
}

