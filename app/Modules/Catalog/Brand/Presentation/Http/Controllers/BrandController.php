<?php

namespace App\Modules\Catalog\Brand\Presentation\Http\Controllers;

use App\Modules\Catalog\Brand\Application\Services\BrandService;
use App\Modules\Catalog\Brand\Application\UseCases\GetBrandByIdUseCase;
use App\Modules\Catalog\Brand\Application\UseCases\ListBrandsUseCase;
use App\Modules\Catalog\Brand\Presentation\Http\Requests\StoreBrandRequest;
use App\Modules\Catalog\Brand\Presentation\Http\Requests\UpdateBrandRequest;

class BrandController
{
    public function __construct(
        private readonly BrandService $brandService,
        private readonly ListBrandsUseCase $listBrandsUseCase,
        private readonly GetBrandByIdUseCase $getBrandByIdUseCase,
    ) {}

    //----------------------------------------------------------------------------------
    // LISTAR MARCAS
    //----------------------------------------------------------------------------------
    public function index()
    {
        $data = $this->listBrandsUseCase->execute();
        return view('catalog::brand.index', $data);
    }

    //----------------------------------------------------------------------------------
    // VER MARCA
    //----------------------------------------------------------------------------------
    public function show(int $id)
    {
        $brand = $this->getBrandByIdUseCase->execute($id);
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
    // CREAR MARCA
    //----------------------------------------------------------------------------------
    public function store(StoreBrandRequest $storeBrandRequest)
    {
        $this->brandService->createBrand(
            $storeBrandRequest->toDto()
        );

        return redirect()
            ->route('brand.index')
            ->with('notification', [
                'statusCode' => 201,
                'errorCode' => null,
                'message' => 'Marca creada correctamente.'
            ]);
    }

    //----------------------------------------------------------------------------------
    // FORM ACTUALIZAR
    //----------------------------------------------------------------------------------
    public function edit(int $id)
    {
        $brand = $this->getBrandByIdUseCase->execute($id);

        return view('catalog::brand.edit', compact('brand'));
    }

    //----------------------------------------------------------------------------------
    // ACTUALIZAR MARCA
    //----------------------------------------------------------------------------------
    public function update(int $id, UpdateBrandRequest $updateBrandRequest)
    {
        $this->brandService->updateBrand(
            $id,
            $updateBrandRequest->toDto()
        );

        return redirect()
            ->route('brand.show', $id)
            ->with('notification', [
                'statusCode' => 200,
                'errorCode' => null,
                'message' => 'Marca actualizada correctamente.'
            ]);
    }

    //----------------------------------------------------------------------------------
    // ACTIVAR MARCA
    //----------------------------------------------------------------------------------
    public function activate(int $id)
    {
        $this->brandService->activateBrand($id);

        return redirect()
            ->route('brand.show', $id)
            ->with('notification', [
                'statusCode' => 200,
                'errorCode' => null,
                'message' => 'Marca activada correctamente.'
            ]);
    }


    //----------------------------------------------------------------------------------
    // DESACTIVAR MARCA
    //----------------------------------------------------------------------------------
    public function deactivate(int $id)
    {
        $this->brandService->deactivateBrand($id);

        return redirect()
            ->route('brand.show', $id)
            ->with('notification', [
                'statusCode' => 200,
                'errorCode' => null,
                'message' => 'Marca desactivada correctamente.'
            ]);
    }

    //----------------------------------------------------------------------------------
    // ELIMINAR MARCA
    //----------------------------------------------------------------------------------
    public function destroy(int $id)
    {
        $this->brandService->deleteBrand($id);

        return redirect()
            ->route('brand.index')
            ->with('notification', [
                'statusCode' => 200,
                'errorCode' => null,
                'message' => 'Marca eliminada correctamente.'
            ]);
    }
}
