<?php

namespace App\Modules\Catalog\Category\Presentation\Http\Controllers;

use App\Modules\Catalog\Category\Application\Services\CategoryService;
use App\Modules\Catalog\Category\Presentation\Http\Requests\StoreCategoryRequest;
use App\Modules\Catalog\Category\Presentation\Http\Requests\UpdateCategoryRequest;

class CategoryController
{
    public function __construct(
        private CategoryService $categoryService
    ) {}

    //----------------------------------------------------------------------------------
    // LISTAR
    //----------------------------------------------------------------------------------
    public function index()
    {
        $categories = $this->categoryService->listCategories();

        return view('catalog::category.index', compact('categories'));
    }

    //----------------------------------------------------------------------------------
    // DETALLE
    //----------------------------------------------------------------------------------
    public function show(string $id)
    {
        $category = $this->categoryService->getCategory($id);

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
    // GUARDAR
    //----------------------------------------------------------------------------------
    public function store(StoreCategoryRequest $request)
    {
        $category = $this->categoryService->createCategory(
            $request->toDto()
        );

        return redirect()
            ->route('category.index')
            ->with('alert', [
                'variant' => 'success',
                'code' => 200,
                'message' => "Categoría creada: {$category->name}"
            ]);
    }

    //----------------------------------------------------------------------------------
    // EDITAR
    //----------------------------------------------------------------------------------
    public function edit(string $id)
    {
        $category = $this->categoryService->getCategory($id);

        return view('catalog::category.edit', compact('category'));
    }

    //----------------------------------------------------------------------------------
    // ACTUALIZAR
    //----------------------------------------------------------------------------------
    public function update(string $id, UpdateCategoryRequest $request)
    {
        $category = $this->categoryService->updateCategory(
            $id,
            $request->toDto()
        );

        return redirect()
            ->route('category.show', $id)
            ->with('alert', [
                'variant' => 'success',
                'code' => 200,
                'message' => "Categoría actualizada: {$category->name}"
            ]);
    }

    //----------------------------------------------------------------------------------
    // ACTIVAR
    //----------------------------------------------------------------------------------
    public function activate(string $id)
    {
        $category = $this->categoryService->activateCategory($id);

        return redirect()
            ->route('category.show', $id)
            ->with('alert', [
                'variant' => 'success',
                'code' => 200,
                'message' => "Categoría activada: {$category->name}"
            ]);
    }

    //----------------------------------------------------------------------------------
    // DESACTIVAR
    //----------------------------------------------------------------------------------
    public function deactivate(string $id)
    {
        $category = $this->categoryService->deactivateCategory($id);

        return redirect()
            ->route('category.show', $id)
            ->with('alert', [
                'variant' => 'success',
                'code' => 200,
                'message' => "Categoría desactivada: {$category->name}"
            ]);
    }

    //----------------------------------------------------------------------------------
    // ELIMINAR
    //----------------------------------------------------------------------------------
    public function destroy(string $id)
    {
        $this->categoryService->deleteCategory($id);

        return redirect()
            ->route('category.index')
            ->with('alert', [
                'variant' => 'success',
                'code' => 200,
                'message' => 'Categoría eliminada correctamente'
            ]);
    }
}
