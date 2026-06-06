<?php
//--------------------------------------------------------------------------
// ProductController: Punto de entrada HTTP para operaciones CRUD del módulo Product.
// Delega toda la lógica de negocio a los casos de uso correspondientes.
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Product\Presentation\Controllers;

use App\Modules\Catalog\Product\Application\UseCases\Read\GetProductByIdUseCase;
use App\Modules\Catalog\Product\Application\UseCases\Read\ListProductsUseCase;
use App\Modules\Catalog\Product\Application\UseCases\Write\ActivateProductUseCase;
use App\Modules\Catalog\Product\Application\UseCases\Write\CreateProductUseCase;
use App\Modules\Catalog\Product\Application\UseCases\Write\DeactivateProductUseCase;
use App\Modules\Catalog\Product\Application\UseCases\Write\DeleteProductUseCase;
use App\Modules\Catalog\Product\Application\UseCases\Write\UpdateProductUseCase;
use App\Modules\Catalog\Product\Presentation\Requests\StoreProductRequest;
use App\Modules\Catalog\Product\Presentation\Requests\UpdateProductRequest;
use App\Shared\Responses\ApiResponse;

class ProductController
{
    public function __construct(
        //--------------------------------------------------------------------------
        // CASOS DE USO -> Lectura de datos
        //--------------------------------------------------------------------------
        private readonly ListProductsUseCase $listProductsUseCase,
        private readonly GetProductByIdUseCase $getProductByIdUseCase,
        //--------------------------------------------------------------------------
        // CASOS DE USO -> Escritura y persistencia de datos
        //--------------------------------------------------------------------------
        private readonly CreateProductUseCase $createProductUseCase,
        private readonly UpdateProductUseCase $updateProductUseCase,
        private readonly ActivateProductUseCase $activateProductUseCase,
        private readonly DeactivateProductUseCase $deactivateProductUseCase,
        private readonly DeleteProductUseCase $deleteProductUseCase
    ) {}

    //--------------------------------------------------------------------------
    // ACCIÓN -> Listar todos los productos
    //--------------------------------------------------------------------------
    public function index()
    {
        $products = $this->listProductsUseCase->execute();

        return ApiResponse::success(
            statusCode: 200,
            message: 'Productos listados correctamente',
            data: $products
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Obtener producto por ID
    //--------------------------------------------------------------------------
    public function show(int $id)
    {
        $product = $this->getProductByIdUseCase->execute($id);

        return ApiResponse::success(
            statusCode: 200,
            message: 'Producto obtenido correctamente',
            data: $product
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Crear un nuevo producto
    //--------------------------------------------------------------------------
    public function store(StoreProductRequest $storeProductRequest)
    {
        $this->createProductUseCase->execute($storeProductRequest->toDto());

        return ApiResponse::success(
            statusCode: 201,
            message: 'Producto creado correctamente'
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Actualizar producto existente
    //--------------------------------------------------------------------------
    public function update(int $id, UpdateProductRequest $updateProductRequest)
    {
        $this->updateProductUseCase->execute($id, $updateProductRequest->toDto());

        return ApiResponse::success(
            statusCode: 200,
            message: 'Producto actualizado correctamente'
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Activar producto
    //--------------------------------------------------------------------------
    public function activate(int $id)
    {
        $this->activateProductUseCase->execute($id);

        return ApiResponse::success(
            statusCode: 200,
            message: 'Producto activado correctamente'
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Desactivar producto
    //--------------------------------------------------------------------------
    public function deactivate(int $id)
    {
        $this->deactivateProductUseCase->execute($id);

        return ApiResponse::success(
            statusCode: 200,
            message: 'Producto desactivado correctamente'
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Eliminar un producto
    //--------------------------------------------------------------------------
    public function destroy(int $id)
    {
        $this->deleteProductUseCase->execute($id);

        return ApiResponse::success(
            statusCode: 200,
            message: 'Producto eliminado correctamente'
        );
    }
}
