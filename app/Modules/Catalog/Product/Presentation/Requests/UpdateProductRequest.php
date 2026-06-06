<?php
//--------------------------------------------------------------------------
// UpdateProductRequest: Validación y transformación del request HTTP para actualización de productos.
// Permite campos parciales (sometimes) y convierte los datos entrantes en DTOs de aplicación.
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Product\Presentation\Requests;

use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Catalog\Product\Application\DTOs\Write\Discount\StoreDiscountDTO;
use App\Modules\Catalog\Product\Application\DTOs\Write\Image\StoreImageDTO;
use App\Modules\Catalog\Product\Application\DTOs\Write\Price\StorePriceDTO;
use App\Modules\Catalog\Product\Application\DTOs\Write\Product\UpdateProductDTO;

class UpdateProductRequest extends FormRequest
{
    //--------------------------------------------------------------------------
    // AUTORIZACIÓN -> Permisos del request
    //--------------------------------------------------------------------------
    public function authorize(): bool
    {
        return true;
    }

    //--------------------------------------------------------------------------
    // REGLAS -> Reglas de validación
    //--------------------------------------------------------------------------
    public function rules(): array
    {
        return [
            'categoryId'  => ['sometimes', 'integer'],
            'brandId'     => ['sometimes', 'integer'],
            'name'        => ['sometimes', 'string'],
            'description' => ['nullable', 'string'],
            'length'      => ['sometimes', 'string'],
            'width'       => ['sometimes', 'string'],
            'thickness'   => ['sometimes', 'string'],
            'stock'       => ['sometimes', 'integer'],
            
            // Multimedia
            'replaceImages' => ['sometimes', 'boolean'],
            'multimedia'    => ['nullable', 'array'],

            // Precio
            'price'           => ['nullable', 'array'],
            'price.amount'    => ['required_with:price', 'numeric'],
            'price.startDate' => ['required_with:price', 'date'],
            'price.endDate'   => ['nullable', 'date'],

            // Descuento
            'discount'           => ['nullable', 'array'],
            'discount.amount'    => ['required_with:discount', 'numeric'],
            'discount.startDate' => ['required_with:discount', 'date'],
            'discount.endDate'   => ['nullable', 'date'],
        ];
    }

    //--------------------------------------------------------------------------
    // MAPEO -> Convertir a DTO de aplicación
    //--------------------------------------------------------------------------
    public function toDto(): UpdateProductDTO
    {
        // Procesar imágenes cargadas
        $images = [];
        $files = $this->file('multimedia', []);

        foreach ($files as $index => $item) {
            $file = $item['file'] ?? null;
            if ($file instanceof UploadedFile) {
                $images[] = new StoreImageDTO(file: $file);
            }
        }

        // Construir DTO de precio
        $priceDto = null;
        if ($this->has('price') && $this->input('price.amount') !== null) {
            $priceDto = new StorePriceDTO(
                amount: (float) $this->input('price.amount'),
                startDate: $this->input('price.startDate'),
                endDate: $this->input('price.endDate'),
            );
        }

        // Construir DTO de descuento
        $discountDto = null;
        if ($this->has('discount') && $this->input('discount.amount') !== null) {
            $discountDto = new StoreDiscountDTO(
                amount: (float) $this->input('discount.amount'),
                startDate: $this->input('discount.startDate'),
                endDate: $this->input('discount.endDate'),
            );
        }

        return new UpdateProductDTO(
            categoryId: $this->has('categoryId') ? (int) $this->input('categoryId') : null,
            brandId: $this->has('brandId') ? (int) $this->input('brandId') : null,
            name: $this->input('name'),
            description: $this->input('description'),
            length: $this->input('length'),
            width: $this->input('width'),
            thickness: $this->input('thickness'),
            stock: $this->has('stock') ? (int) $this->input('stock') : null,
            replaceImages: $this->has('replaceImages') ? $this->boolean('replaceImages') : false,
            images: $images,
            price: $priceDto,
            discount: $discountDto,
        );
    }
}
