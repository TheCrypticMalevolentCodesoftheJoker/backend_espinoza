<?php

namespace App\Modules\Administration\Infrastructure\Presentation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Administration\Application\DTOs\CreateCategoryDTO;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

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
    public function toDto(): CreateCategoryDTO
    {
        return new CreateCategoryDTO(
            name: $this->validated('name')
        );
    }
}
