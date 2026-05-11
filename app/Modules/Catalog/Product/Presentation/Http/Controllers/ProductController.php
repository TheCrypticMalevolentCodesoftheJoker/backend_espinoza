<?php

namespace App\Modules\Catalog\Product\Presentation\Http\Controllers;

use App\Modules\Catalog\Product\Application\Services\ProductService;
use App\Modules\Catalog\Product\Application\UseCases\GetActiveBrandsUseCase;
use App\Modules\Catalog\Product\Application\UseCases\GetActiveCategoriesUseCase;
use App\Modules\Catalog\Product\Application\UseCases\GetProductByIdUseCase;
use App\Modules\Catalog\Product\Application\UseCases\ListProductsUseCase;
use App\Modules\Catalog\Product\Presentation\Http\Requests\StoreProductRequest;
use App\Modules\Catalog\Product\Presentation\Http\Requests\UpdateProductRequest;

class ProductController
{
    public function __construct(
        private readonly ProductService $productService,
        private readonly ListProductsUseCase $listProductsUseCase,
        private readonly GetProductByIdUseCase $getProductByIdUseCase,
        private readonly GetActiveCategoriesUseCase $getActiveCategoriesUseCase,
        private readonly GetActiveBrandsUseCase $getActiveBrandsUseCase,
    ) {}

    //--------------------------------------------------------------------------
    // LISTAR PRODUCTOS
    //--------------------------------------------------------------------------
    public function index()
    {
        $data = $this->listProductsUseCase->execute();
        return view('product::product.index', $data);
    }

    //--------------------------------------------------------------------------
    // VER PRODUCTO
    //--------------------------------------------------------------------------
    public function show(int $id)
    {
        $product = $this->getProductByIdUseCase->execute($id);
        return view('product::product.show', compact('product'));
    }

    //--------------------------------------------------------------------------
    // FORM CREAR
    //--------------------------------------------------------------------------
    public function create()
    {
        $categories = $this->getActiveCategoriesUseCase->execute();
        $brands     = $this->getActiveBrandsUseCase->execute();
        return view('product::product.create', compact('categories', 'brands'));
    }

    //--------------------------------------------------------------------------
    // CREAR PRODUCTO
    //--------------------------------------------------------------------------
    public function store(StoreProductRequest $storeProductRequest)
    {
        $this->productService->createProduct(
            $storeProductRequest->toDto()
        );

        return redirect()
            ->route('product.index')
            ->with('notification', [
                'statusCode' => 200,
                'errorCode' => null,
                'message' => 'Producto creado correctamente.'
            ]);
    }

    //--------------------------------------------------------------------------
    // FORM EDITAR
    //--------------------------------------------------------------------------
    public function edit(int $id)
    {
        $product    = $this->getProductByIdUseCase->execute($id);
        $categories = $this->getActiveCategoriesUseCase->execute();
        $brands     = $this->getActiveBrandsUseCase->execute();

        return view('product::product.edit', compact('product', 'categories', 'brands'));
    }

    //--------------------------------------------------------------------------
    // ACTUALIZAR PRODUCTO
    //--------------------------------------------------------------------------
    public function update(int $id, UpdateProductRequest $updateProductRequest)
    {
        $this->productService->updateProduct($id, $updateProductRequest->toDto());

        return redirect()
            ->route('product.show', $id)
            ->with('notification', [
                'statusCode' => 200,
                'errorCode' => null,
                'message' => 'Producto actualizado correctamente.'
            ]);
    }

    //--------------------------------------------------------------------------
    // ACTIVAR PRODUCTO
    //--------------------------------------------------------------------------
    public function activate(int $id)
    {
        $this->productService->activateProduct($id);

        return redirect()
            ->route('product.show', $id)
            ->with('notification', [
                'statusCode' => 200,
                'errorCode' => null,
                'message' => 'Producto activado correctamente.'
            ]);
    }

    //--------------------------------------------------------------------------
    // DESACTIVAR PRODUCTO
    //--------------------------------------------------------------------------
    public function deactivate(int $id)
    {
        $this->productService->deactivateProduct($id);

        return redirect()
            ->route('product.show', $id)
            ->with('notification', [
                'statusCode' => 200,
                'errorCode' => null,
                'message' => 'Producto desactivado correctamente.'
            ]);
    }

    //--------------------------------------------------------------------------
    // ELIMINAR PRODUCTO
    //--------------------------------------------------------------------------
    public function destroy(int $id)
    {
        $this->productService->deleteProduct($id);

        return redirect()
            ->route('product.index')
            ->with('notification', [
                'statusCode' => 200,
                'errorCode' => null,
                'message' => 'Producto eliminado correctamente.'
            ]);
    }
}
