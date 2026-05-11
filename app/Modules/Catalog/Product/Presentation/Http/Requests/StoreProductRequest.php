<?php

namespace App\Modules\Catalog\Product\Presentation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Catalog\Product\Application\DTOs\ImageInputDTO;
use App\Modules\Catalog\Product\Application\DTOs\StoreDiscountDTO;
use App\Modules\Catalog\Product\Application\DTOs\StorePriceDTO;
use App\Modules\Catalog\Product\Application\DTOs\StoreProductDTO;

class StoreProductRequest extends FormRequest
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
            'category_id'       => ['required', 'integer'],
            'brand_id'          => ['required', 'integer'],
            'code'              => ['nullable', 'string', 'max:50'],
            'name'              => ['required', 'string', 'max:255'],
            'description'       => ['nullable', 'string'],
            'unit_measure'      => ['required', 'string', 'max:50'],
            'length'            => ['required', 'string'],
            'width'             => ['required', 'string'],
            'thickness'         => ['required', 'string'],
            'stock'             => ['required', 'integer', 'min:0'],
            'multimedia'        => ['nullable', 'array'],
            'multimedia.*.file' => ['required', 'file', 'max:20480'],
            'multimedia.*.type' => ['required', 'string', 'in:image,3d_model'],
            'price_amount'      => ['required', 'numeric', 'min:0.01'],
            'price_start_date'  => ['required', 'date'],
            'price_end_date'    => ['nullable', 'date', 'after:price_start_date'],
            'discount_amount'   => ['nullable', 'numeric', 'min:0.01'],
            'discount_start_date' => ['nullable', 'required_with:discount_amount', 'date'],
            'discount_end_date'   => ['nullable', 'date', 'after:discount_start_date'],
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required'    => 'La categoría es obligatoria.',
            'brand_id.required'       => 'La marca es obligatoria.',
            'code.max'                => 'El código del producto no puede exceder los 50 caracteres.',
            'name.required'           => 'El nombre del producto es obligatorio.',
            'unit_measure.required'   => 'La unidad de medida es obligatoria.',
            'length.required'         => 'El largo es obligatorio.',
            'width.required'          => 'El ancho es obligatorio.',
            'thickness.required'      => 'El grosor es obligatorio.',
            'stock.required'          => 'El stock es obligatorio.',
            'stock.min'               => 'El stock no puede ser negativo.',
            'images_png.*.mimes'      => 'Las imágenes deben ser jpg, jpeg, png o webp.',
            'images_3d.*.mimes'       => 'Los archivos 3D deben ser obj, stl, fbx, glb o gltf.',
            'price_amount.required'   => 'El precio es obligatorio.',
            'price_amount.min'        => 'El precio debe ser mayor a cero.',
            'price_start_date.required' => 'La fecha de inicio del precio es obligatoria.',
        ];
    }

    //--------------------------------------------------------------------------
    // MAPEOS
    //--------------------------------------------------------------------------
    public function toDto(): StoreProductDTO
    {
        $images = [];
        $multimediaData = $this->input('multimedia', []);
        $multimediaFiles = $this->file('multimedia', []);

        foreach ($multimediaData as $index => $item) {
            $file = $multimediaFiles[$index]['file'] ?? null;
            if ($file instanceof \Illuminate\Http\UploadedFile) {
                $type = ($item['type'] ?? 'image') === 'image' ? 'png' : '3d';
                $images[] = new ImageInputDTO(file: $file, type: $type);
            }
        }

        $priceDto = new StorePriceDTO(
            amount: (float) $this->validated('price_amount'),
            startDate: $this->validated('price_start_date'),
            endDate: $this->validated('price_end_date'),
        );

        $discountDto = null;
        if ($this->filled('discount_amount')) {
            $discountDto = new StoreDiscountDTO(
                amount: (float) $this->validated('discount_amount'),
                startDate: $this->validated('discount_start_date'),
                endDate: $this->validated('discount_end_date'),
            );
        }

        return new StoreProductDTO(
            categoryId: (int) $this->validated('category_id'),
            brandId: (int) $this->validated('brand_id'),
            code: $this->validated('code'),
            name: $this->validated('name'),
            description: $this->validated('description'),
            unitMeasure: $this->validated('unit_measure'),
            length: $this->validated('length'),
            width: $this->validated('width'),
            thickness: $this->validated('thickness'),
            stock: (int) $this->validated('stock'),
            images: $images,
            price: $priceDto,
            discount: $discountDto,
        );
    }
}

