<?php

namespace App\Modules\Catalog\Brand\Presentation\Controllers;

use App\Modules\Catalog\Brand\Application\UseCases\Read\GetBrandByIdUseCase;
use App\Modules\Catalog\Brand\Application\UseCases\Read\ListActiveBrandsUseCase;
use App\Modules\Catalog\Brand\Application\UseCases\Read\ListBrandsUseCase;
use App\Modules\Catalog\Brand\Application\UseCases\Write\ActivateBrandUseCase;
use App\Modules\Catalog\Brand\Application\UseCases\Write\CreateBrandUseCase;
use App\Modules\Catalog\Brand\Application\UseCases\Write\DeactivateBrandUseCase;
use App\Modules\Catalog\Brand\Application\UseCases\Write\DeleteBrandUseCase;
use App\Modules\Catalog\Brand\Application\UseCases\Write\UpdateBrandUseCase;
use App\Modules\Catalog\Brand\Presentation\Requests\StoreBrandRequest;
use App\Modules\Catalog\Brand\Presentation\Requests\UpdateBrandRequest;
use App\Shared\Responses\ApiResponse;

class BrandController
{
    public function __construct(
        //--------------------------------------------------------------------------
        // CASOS DE USO -> Lectura de datos
        //--------------------------------------------------------------------------
        private readonly ListBrandsUseCase $listBrandsUseCase,
        private readonly ListActiveBrandsUseCase $listActiveBrandsUseCase,
        private readonly GetBrandByIdUseCase $getBrandByIdUseCase,
        //--------------------------------------------------------------------------
        // CASOS DE USO -> Escritura y persistencia de datos
        //--------------------------------------------------------------------------
        private readonly CreateBrandUseCase $createBrandUseCase,
        private readonly UpdateBrandUseCase $updateBrandUseCase,
        private readonly ActivateBrandUseCase $activateBrandUseCase,
        private readonly DeactivateBrandUseCase $deactivateBrandUseCase,
        private readonly DeleteBrandUseCase $deleteBrandUseCase,
    ) {}

    //--------------------------------------------------------------------------
    // ACCIÓN -> Listar todas las marcas
    //--------------------------------------------------------------------------
    public function index()
    {
        $brands = $this->listBrandsUseCase->execute();

        return ApiResponse::success(
            statusCode: 200,
            message: 'Marcas listadas correctamente',
            data: $brands
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Listar marcas activas
    //--------------------------------------------------------------------------
    public function active()
    {
        $brands = $this->listActiveBrandsUseCase->execute();

        return ApiResponse::success(
            statusCode: 200,
            message: 'Marcas activas listadas correctamente',
            data: $brands
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Obtener marca por ID
    //--------------------------------------------------------------------------
    public function show(int $id)
    {
        $brand = $this->getBrandByIdUseCase->execute($id);

        return ApiResponse::success(
            statusCode: 200,
            message: 'Marca obtenida correctamente',
            data: $brand
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Crear una nueva marca
    //--------------------------------------------------------------------------
    public function store(StoreBrandRequest $storeBrandRequest)
    {
        $this->createBrandUseCase->execute($storeBrandRequest->toDto());

        return ApiResponse::success(
            statusCode: 201,
            message: 'Marca creada correctamente.'
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Actualizar marca existente
    //--------------------------------------------------------------------------
    public function update(int $id, UpdateBrandRequest $updateBrandRequest)
    {
        $this->updateBrandUseCase->execute($id, $updateBrandRequest->toDto());

        return ApiResponse::success(
            statusCode: 200,
            message: 'Marca actualizada correctamente.'
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Activar marca
    //--------------------------------------------------------------------------
    public function activate(int $id)
    {
        $this->activateBrandUseCase->execute($id);

        return ApiResponse::success(
            statusCode: 200,
            message: 'Marca activada correctamente.'
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Desactivar marca
    //--------------------------------------------------------------------------
    public function deactivate(int $id)
    {
        $this->deactivateBrandUseCase->execute($id);

        return ApiResponse::success(
            statusCode: 200,
            message: 'Marca desactivada correctamente.'
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Eliminar una marca
    //--------------------------------------------------------------------------
    public function destroy(int $id)
    {
        $this->deleteBrandUseCase->execute($id);

        return ApiResponse::success(
            statusCode: 200,
            message: 'Marca eliminada correctamente.'
        );
    }
}
