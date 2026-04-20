<?php

namespace App\Modules\Catalog\Product\Presentation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Catalog\Product\Application\DTOs\UpdateProductDTO;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // -------------------------
            // PRODUCTO BASE
            // -------------------------
            'code' => ['required'],
            'category_id' => ['required'],
            'brand_id' => ['required'],
            'name' => ['required'],
            'description' => ['nullable'],
            'unit_measure' => ['required'],
            'stock' => ['required'],
            'status' => ['required'],

            // -------------------------
            // IMÁGENES
            // -------------------------
            'images' => ['nullable'],
            'images.*.url' => ['required'],
            'images.*.type' => ['required'],

            // -------------------------
            // PRECIO
            // -------------------------
            'price.amount' => ['required'],
            'price.start_date' => ['required'],
            'price.end_date' => ['nullable'],
            'price.status' => ['required'],

            // -------------------------
            // DESCUENTO
            // -------------------------
            'discount.amount' => ['nullable'],
            'discount.start_date' => ['nullable'],
            'discount.end_date' => ['nullable'],
            'discount.status' => ['required'],

            // -------------------------
            // DIMENSIONES
            // -------------------------
            'dimension.length' => ['required'],
            'dimension.width' => ['required'],
            'dimension.thickness' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'El código es obligatorio',
            'category_id.required' => 'La categoría es obligatoria',
            'brand_id.required' => 'La marca es obligatoria',
            'name.required' => 'El nombre es obligatorio',
            'unit_measure.required' => 'La unidad de medida es obligatoria',
            'stock.required' => 'El stock es obligatorio',
            'status.required' => 'El estado del producto es obligatorio',

            'price.amount.required' => 'El precio es obligatorio',
            'price.status.required' => 'El estado del precio es obligatorio',

            'discount.status.required' => 'El estado del descuento es obligatorio',

            'dimension.length.required' => 'El largo es obligatorio',
            'dimension.width.required' => 'El ancho es obligatorio',
            'dimension.thickness.required' => 'El grosor es obligatorio',
        ];
    }

    public function toDto(): UpdateProductDTO
    {
        return new UpdateProductDTO(
            code: $this->validated('code'),
            category_id: $this->validated('category_id'),
            brand_id: $this->validated('brand_id'),
            name: $this->validated('name'),
            description: $this->validated('description'),
            unit_measure: $this->validated('unit_measure'),
            stock: $this->validated('stock'),
            status: $this->validated('status'),

            images: $this->validated('images', []),

            price: $this->validated('price'),

            discount: $this->validated('discount'),

            dimension: $this->validated('dimension'),
        );
    }
}
