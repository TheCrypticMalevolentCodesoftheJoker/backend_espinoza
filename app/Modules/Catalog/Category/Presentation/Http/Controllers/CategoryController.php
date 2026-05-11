<?php

namespace App\Modules\Catalog\Category\Presentation\Http\Controllers;

use App\Modules\Catalog\Category\Application\Services\CategoryService;
use App\Modules\Catalog\Category\Application\UseCases\GetCategoryByIdUseCase;
use App\Modules\Catalog\Category\Application\UseCases\ListCategoriesUseCase;
use App\Modules\Catalog\Category\Presentation\Http\Requests\StoreCategoryRequest;
use App\Modules\Catalog\Category\Presentation\Http\Requests\UpdateCategoryRequest;

class CategoryController
{
    public function __construct(
        private readonly CategoryService $categoryService,
        private readonly ListCategoriesUseCase $listCategoriesUseCase,
        private readonly GetCategoryByIdUseCase $getCategoryByIdUseCase,
    ) {}

    //----------------------------------------------------------------------------------
    // LISTAR CATEGORÍAS
    //----------------------------------------------------------------------------------
    public function index()
    {
        $data = $this->listCategoriesUseCase->execute();
        return view('catalog::category.index', $data);
    }

    //----------------------------------------------------------------------------------
    // VER CATEGORÍA
    //----------------------------------------------------------------------------------
    public function show(int $id)
    {
        $category = $this->getCategoryByIdUseCase->execute($id);
        return view('catalog::category.show', compact('category'));
    }

    //----------------------------------------------------------------------------------
    // FORM CREAR
    //----------------------------------------------------------------------------------
    public function create()
    {
        return view('catalog::category.create');
    }

    //----------------------------------------------------------------------------------
    // CREAR CATEGORÍA
    //----------------------------------------------------------------------------------
    public function store(StoreCategoryRequest $storeCategoryRequest)
    {
        $this->categoryService->createCategory(
            $storeCategoryRequest->toDto()
        );

        return redirect()
            ->route('category.index')
            ->with('notification', [
                'statusCode' => 201,
                'errorCode' => null,
                'message' => 'Categoría creada correctamente.'
            ]);
    }

    //----------------------------------------------------------------------------------
    // FORM ACTUALIZAR
    //----------------------------------------------------------------------------------
    public function edit(int $id)
    {
        $category = $this->getCategoryByIdUseCase->execute($id);
        return view('catalog::category.edit', compact('category'));
    }

    //----------------------------------------------------------------------------------
    // ACTUALIZAR CATEGORÍA
    //----------------------------------------------------------------------------------
    public function update(int $id, UpdateCategoryRequest $updateCategoryRequest)
    {
        $this->categoryService->updateCategory($id, $updateCategoryRequest->toDto());

        return redirect()
            ->route('category.show', $id)
            ->with('notification', [
                'statusCode' => 200,
                'errorCode' => null,
                'message' => 'Categoría actualizada correctamente.'
            ]);
    }

    //----------------------------------------------------------------------------------
    // ACTIVAR CATEGORÍA
    //----------------------------------------------------------------------------------
    public function activate(int $id)
    {
        $this->categoryService->activateCategory($id);

        return redirect()
            ->route('category.show', $id)
            ->with('notification', [
                'statusCode' => 200,
                'errorCode' => null,
                'message' => 'Categoría activada correctamente.'
            ]);
    }


    //----------------------------------------------------------------------------------
    // DESACTIVAR CATEGORÍA
    //----------------------------------------------------------------------------------
    public function deactivate(int $id)
    {
        $this->categoryService->deactivateCategory($id);

        return redirect()
            ->route('category.show', $id)
            ->with('notification', [
                'statusCode' => 200,
                'errorCode' => null,
                'message' => 'Categoría desactivada correctamente.'
            ]);
    }

    //----------------------------------------------------------------------------------
    // ELIMINAR CATEGORÍA
    //----------------------------------------------------------------------------------
    public function destroy(int $id)
    {
        $this->categoryService->deleteCategory($id);

        return redirect()
            ->route('category.index')
            ->with('notification', [
                'statusCode' => 200,
                'errorCode' => null,
                'message' => 'Categoría eliminada correctamente.'
            ]);
    }
}
