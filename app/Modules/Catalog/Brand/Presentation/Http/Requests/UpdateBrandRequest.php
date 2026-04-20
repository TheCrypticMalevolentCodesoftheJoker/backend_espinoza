<?php

namespace App\Modules\Catalog\Brand\Presentation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Catalog\Brand\Application\DTOs\UpdateBrandDTO;

class UpdateBrandRequest extends FormRequest
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

    public function toDto(): UpdateBrandDTO
    {
        return new UpdateBrandDTO(
            name: $this->validated('name')
        );
    }
}