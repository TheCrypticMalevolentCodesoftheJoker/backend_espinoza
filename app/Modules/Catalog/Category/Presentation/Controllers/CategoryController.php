<?php

namespace App\Modules\Catalog\Category\Presentation\Controllers;

use App\Modules\Catalog\Category\Application\UseCases\Read\GetCategoryByIdUseCase;
use App\Modules\Catalog\Category\Application\UseCases\Read\ListActiveCategoriesUseCase;
use App\Modules\Catalog\Category\Application\UseCases\Read\ListCategoriesUseCase;
use App\Modules\Catalog\Category\Application\UseCases\Write\ActivateCategoryUseCase;
use App\Modules\Catalog\Category\Application\UseCases\Write\CreateCategoryUseCase;
use App\Modules\Catalog\Category\Application\UseCases\Write\DeactivateCategoryUseCase;
use App\Modules\Catalog\Category\Application\UseCases\Write\DeleteCategoryUseCase;
use App\Modules\Catalog\Category\Application\UseCases\Write\UpdateCategoryUseCase;
use App\Modules\Catalog\Category\Presentation\Requests\StoreCategoryRequest;
use App\Modules\Catalog\Category\Presentation\Requests\UpdateCategoryRequest;
use App\Shared\Responses\ApiResponse;

class CategoryController
{
    public function __construct(
        //--------------------------------------------------------------------------
        // CASOS DE USO -> Lectura de datos
        //--------------------------------------------------------------------------
        private readonly ListCategoriesUseCase $listCategoriesUseCase,
        private readonly ListActiveCategoriesUseCase $listActiveCategoriesUseCase,
        private readonly GetCategoryByIdUseCase $getCategoryByIdUseCase,
        //--------------------------------------------------------------------------
        // CASOS DE USO -> Escritura y persistencia de datos
        //--------------------------------------------------------------------------
        private readonly CreateCategoryUseCase $createCategoryUseCase,
        private readonly UpdateCategoryUseCase $updateCategoryUseCase,
        private readonly ActivateCategoryUseCase $activateCategoryUseCase,
        private readonly DeactivateCategoryUseCase $deactivateCategoryUseCase,
        private readonly DeleteCategoryUseCase $deleteCategoryUseCase,
    ) {}

    //--------------------------------------------------------------------------
    // ACCIÓN -> Listar todas las categorías
    //--------------------------------------------------------------------------
    public function index()
    {
        $categories = $this->listCategoriesUseCase->execute();

        return ApiResponse::success(
            statusCode: 200,
            message: 'Categorías listadas correctamente',
            data: $categories
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Listar categorías activas
    //--------------------------------------------------------------------------
    public function active()
    {
        $categories = $this->listActiveCategoriesUseCase->execute();

        return ApiResponse::success(
            statusCode: 200,
            message: 'Categorías activas listadas correctamente',
            data: $categories
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Obtener categoría por ID
    //--------------------------------------------------------------------------
    public function show(int $id)
    {
        $category = $this->getCategoryByIdUseCase->execute($id);

        return ApiResponse::success(
            statusCode: 200,
            message: 'Categoría obtenida correctamente',
            data: $category
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Crear una nueva categoría
    //--------------------------------------------------------------------------
    public function store(StoreCategoryRequest $storeCategoryRequest)
    {
        $this->createCategoryUseCase->execute($storeCategoryRequest->toDto());

        return ApiResponse::success(
            statusCode: 201,
            message: 'Categoría creada correctamente.'
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Actualizar categoría existente
    //--------------------------------------------------------------------------
    public function update(int $id, UpdateCategoryRequest $updateCategoryRequest)
    {
        $this->updateCategoryUseCase->execute($id, $updateCategoryRequest->toDto());

        return ApiResponse::success(
            statusCode: 200,
            message: 'Categoría actualizada correctamente.'
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Activar categoría
    //--------------------------------------------------------------------------
    public function activate(int $id)
    {
        $this->activateCategoryUseCase->execute($id);

        return ApiResponse::success(
            statusCode: 200,
            message: 'Categoría activada correctamente.'
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Desactivar categoría
    //--------------------------------------------------------------------------
    public function deactivate(int $id)
    {
        $this->deactivateCategoryUseCase->execute($id);

        return ApiResponse::success(
            statusCode: 200,
            message: 'Categoría desactivada correctamente.'
        );
    }

    //--------------------------------------------------------------------------
    // ACCIÓN -> Eliminar una categoría
    //--------------------------------------------------------------------------
    public function destroy(int $id)
    {
        $this->deleteCategoryUseCase->execute($id);

        return ApiResponse::success(
            statusCode: 200,
            message: 'Categoría eliminada correctamente.'
        );
    }
}
