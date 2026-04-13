<?php

namespace App\Modules\Administration\Infrastructure\Presentation\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Administration\Application\Services\CategoryService;
use App\Modules\Administration\Infrastructure\Presentation\Http\Requests\CategoryRequest;

class CategoryController
{
    // Property Promotion (PHP 8+)
    public function __construct(
        private CategoryService $categoryService
    ) {}
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_//

    public function index()
    {
        $categories = $this->categoryService->listCategories();

        return view('administration::category.index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return view('administration::category.create');
    }

    public function store(CategoryRequest $request)
    {
        try {
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
        } catch (\DomainException $e) {
            return redirect()
                ->back()
                ->withErrors(['domain' => $e->getMessage()])
                ->withInput();
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with('alert', [
                    'variant' => 'error',
                    'code' => 500,
                    'message' => $e->getMessage()
                ])
                ->withInput();
        }
    }




























    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        return view('administration::category.edit');
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
