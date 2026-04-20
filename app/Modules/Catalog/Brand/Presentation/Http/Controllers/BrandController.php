<?php

namespace App\Modules\Catalog\Brand\Presentation\Http\Controllers;

use App\Modules\Catalog\Brand\Application\Services\BrandService;
use App\Modules\Catalog\Brand\Presentation\Http\Requests\StoreBrandRequest;
use App\Modules\Catalog\Brand\Presentation\Http\Requests\UpdateBrandRequest;

class BrandController
{
    public function __construct(
        private BrandService $brandService
    ) {}

    //----------------------------------------------------------------------------------
    // LISTAR
    //----------------------------------------------------------------------------------
    public function index()
    {
        $brands = $this->brandService->listBrands();

        return view('catalog::brand.index', compact('brands'));
    }

    //----------------------------------------------------------------------------------
    // DETALLE
    //----------------------------------------------------------------------------------
    public function show(string $id)
    {
        $brand = $this->brandService->getBrand($id);

        return view('catalog::brand.show', compact('brand'));
    }

    //----------------------------------------------------------------------------------
    // FORM CREAR
    //----------------------------------------------------------------------------------
    public function create()
    {
        return view('catalog::brand.create');
    }

    //----------------------------------------------------------------------------------
    // GUARDAR
    //----------------------------------------------------------------------------------
    public function store(StoreBrandRequest $request)
    {
        $brand = $this->brandService->createBrand(
            $request->toDto()
        );

        return redirect()
            ->route('brand.index')
            ->with('alert', [
                'variant' => 'success',
                'code' => 200,
                'message' => "Marca creada: {$brand->name}"
            ]);
    }

    //----------------------------------------------------------------------------------
    // EDITAR
    //----------------------------------------------------------------------------------
    public function edit(string $id)
    {
        $brand = $this->brandService->getBrand($id);

        return view('catalog::brand.edit', compact('brand'));
    }

    //----------------------------------------------------------------------------------
    // ACTUALIZAR
    //----------------------------------------------------------------------------------
    public function update(string $id, UpdateBrandRequest $request)
    {
        $brand = $this->brandService->updateBrand(
            $id,
            $request->toDto()
        );

        return redirect()
            ->route('brand.show', $id)
            ->with('alert', [
                'variant' => 'success',
                'code' => 200,
                'message' => "Marca actualizada: {$brand->name}"
            ]);
    }

    //----------------------------------------------------------------------------------
    // ACTIVAR
    //----------------------------------------------------------------------------------
    public function activate(string $id)
    {
        $brand = $this->brandService->activateBrand($id);

        return redirect()
            ->route('brand.show', $id)
            ->with('alert', [
                'variant' => 'success',
                'code' => 200,
                'message' => "Marca activada: {$brand->name}"
            ]);
    }

    //----------------------------------------------------------------------------------
    // DESACTIVAR
    //----------------------------------------------------------------------------------
    public function deactivate(string $id)
    {
        $brand = $this->brandService->deactivateBrand($id);

        return redirect()
            ->route('brand.show', $id)
            ->with('alert', [
                'variant' => 'success',
                'code' => 200,
                'message' => "Marca desactivada: {$brand->name}"
            ]);
    }

    //----------------------------------------------------------------------------------
    // ELIMINAR
    //----------------------------------------------------------------------------------
    public function destroy(string $id)
    {
        $this->brandService->deleteBrand($id);

        return redirect()
            ->route('brand.index')
            ->with('alert', [
                'variant' => 'success',
                'code' => 200,
                'message' => 'Marca eliminada correctamente'
            ]);
    }
}
