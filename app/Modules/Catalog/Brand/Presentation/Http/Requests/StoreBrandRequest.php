<?php

namespace App\Modules\Catalog\Brand\Presentation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Catalog\Brand\Application\DTOs\StoreBrandDTO;

class StoreBrandRequest extends FormRequest
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

    public function toDto(): StoreBrandDTO
    {
        return new StoreBrandDTO(
            name: $this->validated('name')
        );
    }
}