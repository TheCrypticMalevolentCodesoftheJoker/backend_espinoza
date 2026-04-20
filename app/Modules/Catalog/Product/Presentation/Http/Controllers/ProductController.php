<?php

namespace App\Modules\Catalog\Product\Presentation\Http\Controllers;

use App\Modules\Catalog\Product\Application\Services\ProductService;
use App\Modules\Catalog\Product\Presentation\Http\Requests\StoreProductRequest;

class ProductController
{
    public function __construct(
        private ProductService $productService
    ) {}

    //----------------------------------------------------------------------------------
    // LISTAR PRODUCTOS
    //----------------------------------------------------------------------------------
    public function index()
    {
        $products = $this->productService->listProducts();

        return view('catalog::product.index', compact('products'));
    }

    //----------------------------------------------------------------------------------
    // VER DETALLE PRODUCTO (SHOW)
    //----------------------------------------------------------------------------------
    public function show(string $id)
    {
        $product = $this->productService->getProductById($id);

        return view('catalog::product.show', compact('product'));
    }

    //----------------------------------------------------------------------------------
    // FORM CREAR
    //----------------------------------------------------------------------------------
    public function create()
    {
        return view('catalog::product.create');
    }

    //----------------------------------------------------------------------------------
    // GUARDAR PRODUCTO
    //----------------------------------------------------------------------------------
    public function store(StoreProductRequest $storeProductRequest)
    {
        $product = $this->productService->createProduct(
            $storeProductRequest->toDto()
        );

        return redirect()
            ->back()
            ->with('alert', [
                'variant' => 'success',
                'code' => 200,
                'message' => "Producto creado: {$product->name}"
            ]);
    }
}
