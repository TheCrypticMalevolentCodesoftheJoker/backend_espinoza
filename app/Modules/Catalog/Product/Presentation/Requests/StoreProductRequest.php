<?php
//--------------------------------------------------------------------------
// StoreProductRequest: Validación y transformación del request HTTP para creación de productos.
// Aplica reglas de validación y convierte los datos entrantes en DTOs de aplicación.
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Product\Presentation\Requests;

use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Catalog\Product\Application\DTOs\Write\Discount\StoreDiscountDTO;
use App\Modules\Catalog\Product\Application\DTOs\Write\Image\StoreImageDTO;
use App\Modules\Catalog\Product\Application\DTOs\Write\Price\StorePriceDTO;
use App\Modules\Catalog\Product\Application\DTOs\Write\Product\StoreProductDTO;

class StoreProductRequest extends FormRequest
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
            'categoryId'  => ['required', 'integer'],
            'brandId'     => ['required', 'integer'],
            'name'        => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'length'      => ['required', 'string'],
            'width'       => ['required', 'string'],
            'thickness'   => ['required', 'string'],
            'stock'       => ['required', 'integer'],

            'multimedia'  => ['nullable', 'array'],

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
    // MENSAJES -> Mensajes de validación personalizados
    //--------------------------------------------------------------------------
    public function messages(): array
    {
        return [
            'categoryId.required' => 'La categoría es obligatoria.',
            'brandId.required'    => 'La marca es obligatoria.',
            'name.required'       => 'El nombre del producto es obligatorio.',
            'length.required'     => 'El largo es obligatorio.',
            'width.required'      => 'El ancho es obligatorio.',
            'thickness.required'  => 'El grosor es obligatorio.',
            'stock.required'      => 'El stock es obligatorio.',
            'price.amount.required_with' => 'El monto del precio es obligatorio si se envía el objeto price.',
            'price.startDate.required_with' => 'La fecha de inicio del precio es obligatoria si se envía el objeto price.',
        ];
    }

    //--------------------------------------------------------------------------
    // MAPEO -> Convertir a DTO de aplicación
    //--------------------------------------------------------------------------
    public function toDto(): StoreProductDTO
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

        return new StoreProductDTO(
            categoryId: (int) $this->validated('categoryId'),
            brandId: (int) $this->validated('brandId'),
            name: $this->validated('name'),
            description: $this->validated('description'),
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
