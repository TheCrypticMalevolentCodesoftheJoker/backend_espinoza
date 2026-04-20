<?php

namespace App\Modules\Catalog\Product\Presentation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Modules\Catalog\Product\Application\DTOs\ProductAssetsDTO;
use App\Modules\Catalog\Product\Application\DTOs\Product\StoreProductDTO;
use App\Modules\Catalog\Product\Application\DTOs\Image\StoreImageDTO;
use App\Modules\Catalog\Product\Application\DTOs\Price\StorePriceDTO;
use App\Modules\Catalog\Product\Application\DTOs\Discount\StoreDiscountDTO;
use App\Modules\Catalog\Product\Application\DTOs\Dimension\StoreDimensionDTO;

class StoreProductRequest extends FormRequest
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
            'category_id' => ['required'],
            'brand_id' => ['required'],
            'name' => ['required'],
            'description' => ['nullable'],
            'unit_measure' => ['required'],
            'stock' => ['required'],

            // -------------------------
            // IMÁGENES
            // -------------------------
            'images' => ['nullable', 'array'],
            'images.*.url' => ['required'],
            'images.*.type' => ['required'],

            // -------------------------
            // PRECIO
            // -------------------------
            'price.amount' => ['required'],
            'price.start_date' => ['required'],
            'price.end_date' => ['nullable'],

            // -------------------------
            // DESCUENTO
            // -------------------------
            'discount.amount' => ['nullable'],
            'discount.start_date' => ['nullable'],
            'discount.end_date' => ['nullable'],

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
            'category_id.required' => 'La categoría es obligatoria',
            'brand_id.required' => 'La marca es obligatoria',
            'name.required' => 'El nombre es obligatorio',
            'unit_measure.required' => 'La unidad de medida es obligatoria',
            'stock.required' => 'El stock es obligatorio',
            'status.required' => 'El estado del producto es obligatorio',

            'price.amount.required' => 'El precio es obligatorio',
            'price.start_date.required' => 'La fecha de inicio del precio es obligatoria',

            'dimension.length.required' => 'El largo es obligatorio',
            'dimension.width.required' => 'El ancho es obligatorio',
            'dimension.thickness.required' => 'El grosor es obligatorio',
        ];
    }

    public function toDto(): ProductAssetsDTO
    {
        return new ProductAssetsDTO(
            storeProductDTO: new StoreProductDTO(
                category_id: $this->validated('category_id'),
                brand_id: $this->validated('brand_id'),
                name: $this->validated('name'),
                description: $this->validated('description'),
                unit_measure: $this->validated('unit_measure'),
                stock: $this->validated('stock'),
            ),

            images: array_map(
                fn ($img) => new StoreImageDTO(
                    url: $img['url'],
                    type: $img['type']
                ),
                $this->validated('images', [])
            ),

            storePriceDTO: new StorePriceDTO(
                amount: $this->validated('price.amount'),
                start_date: $this->validated('price.start_date'),
                end_date: $this->validated('price.end_date'),
            ),

            storeDiscountDTO: $this->has('discount.amount')
                ? new StoreDiscountDTO(
                    amount: $this->validated('discount.amount'),
                    start_date: $this->validated('discount.start_date'),
                    end_date: $this->validated('discount.end_date'),
                )
                : null,

            storeDimensionDTO: new StoreDimensionDTO(
                length: $this->validated('dimension.length'),
                width: $this->validated('dimension.width'),
                thickness: $this->validated('dimension.thickness'),
            ),
        );
    }
}