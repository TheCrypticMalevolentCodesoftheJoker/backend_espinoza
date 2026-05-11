<?php

namespace App\Modules\Catalog\Product\Presentation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Catalog\Product\Application\DTOs\ImageInputDTO;
use App\Modules\Catalog\Product\Application\DTOs\StoreDiscountDTO;
use App\Modules\Catalog\Product\Application\DTOs\StorePriceDTO;
use App\Modules\Catalog\Product\Application\DTOs\UpdateProductDTO;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    //--------------------------------------------------------------------------
    // VALIDACIONES
    //--------------------------------------------------------------------------
    public function rules(): array
    {
        return [
            'category_id'         => ['sometimes', 'integer'],
            'brand_id'            => ['sometimes', 'integer'],
            'code'                => ['sometimes', 'nullable', 'string', 'max:50'],
            'name'                => ['sometimes', 'string', 'max:255'],
            'description'         => ['nullable', 'string'],
            'unit_measure'        => ['sometimes', 'string', 'max:50'],
            'length'              => ['sometimes', 'string'],
            'width'               => ['sometimes', 'string'],
            'thickness'           => ['sometimes', 'string'],
            'stock'               => ['sometimes', 'integer', 'min:0'],
            'replace_images'      => ['sometimes', 'boolean'],
            'multimedia'          => ['nullable', 'array'],
            'multimedia.*.file'   => ['required', 'file', 'max:20480'],
            'multimedia.*.type'   => ['required', 'string', 'in:image,3d_model'],
            'price_amount'        => ['sometimes', 'nullable', 'numeric', 'min:0.01'],
            'price_start_date'    => ['sometimes', 'nullable', 'date'],
            'price_end_date'      => ['nullable', 'date', 'after:price_start_date'],
            'discount_amount'     => ['nullable', 'numeric', 'min:0.01'],
            'discount_start_date' => ['nullable', 'required_with:discount_amount', 'date'],
            'discount_end_date'   => ['nullable', 'date', 'after:discount_start_date'],
        ];
    }

    public function messages(): array
    {
        return [
            'stock.min'          => 'El stock no puede ser negativo.',
            'images_png.*.mimes' => 'Las imágenes deben ser jpg, jpeg, png o webp.',
            'images_3d.*.mimes'  => 'Los archivos 3D deben ser obj, stl, fbx, glb o gltf.',
            'price_amount.min'   => 'El precio debe ser mayor a cero.',
        ];
    }

    //--------------------------------------------------------------------------
    // MAPEOS
    //--------------------------------------------------------------------------
    public function toDto(): UpdateProductDTO
    {
        $images = null;
        $multimediaData = $this->input('multimedia', []);
        $multimediaFiles = $this->file('multimedia', []);

        if (!empty($multimediaData) || $this->boolean('replace_images')) {
            $images = [];
            foreach ($multimediaData as $index => $item) {
                $file = $multimediaFiles[$index]['file'] ?? null;
                if ($file instanceof \Illuminate\Http\UploadedFile) {
                    $type = ($item['type'] ?? 'image') === 'image' ? 'png' : '3d';
                    $images[] = new ImageInputDTO(file: $file, type: $type);
                }
            }
        }

        $priceDto = null;
        if ($this->filled('price_amount') && $this->filled('price_start_date')) {
            $priceDto = new StorePriceDTO(
                amount: (float) $this->validated('price_amount'),
                startDate: $this->validated('price_start_date'),
                endDate: $this->validated('price_end_date'),
            );
        }

        $discountDto = null;
        if ($this->filled('discount_amount')) {
            $discountDto = new StoreDiscountDTO(
                amount: (float) $this->validated('discount_amount'),
                startDate: $this->validated('discount_start_date'),
                endDate: $this->validated('discount_end_date'),
            );
        }

        return new UpdateProductDTO(
            categoryId: $this->filled('category_id') ? (int) $this->validated('category_id') : null,
            brandId: $this->filled('brand_id') ? (int) $this->validated('brand_id') : null,
            code: $this->filled('code') ? $this->validated('code') : null,
            name: $this->filled('name') ? $this->validated('name') : null,
            description: $this->input('description'),
            unitMeasure: $this->filled('unit_measure') ? $this->validated('unit_measure') : null,
            length: $this->filled('length') ? $this->validated('length') : null,
            width: $this->filled('width') ? $this->validated('width') : null,
            thickness: $this->filled('thickness') ? $this->validated('thickness') : null,
            stock: $this->has('stock') ? (int) $this->input('stock') : null,
            images: $images,
            replaceImages: $this->boolean('replace_images'),
            price: $priceDto,
            discount: $discountDto,
        );
    }
}

