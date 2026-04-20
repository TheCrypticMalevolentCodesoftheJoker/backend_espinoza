<?php

namespace App\Modules\Catalog\Category\Presentation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Catalog\Category\Application\DTOs\UpdateCategoryDTO;

class UpdateCategoryRequest extends FormRequest
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

    public function toDto(): UpdateCategoryDTO
    {
        return new UpdateCategoryDTO(
            name: $this->validated('name')
        );
    }
}
