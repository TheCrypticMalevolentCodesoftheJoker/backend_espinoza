<?php

namespace App\Modules\Catalog\Category\Presentation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Catalog\Category\Application\DTOs\StoreCategoryDTO;

class StoreCategoryRequest extends FormRequest
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
    public function toDto(): StoreCategoryDTO
    {
        return new StoreCategoryDTO(
            name: $this->validated('name')
        );
    }
}
