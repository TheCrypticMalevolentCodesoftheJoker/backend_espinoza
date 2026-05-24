<?php

namespace App\Modules\Catalog\Category\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Catalog\Category\Domain\Interfaces\CategoryInterface;
use App\Modules\Catalog\Category\Infrastructure\Persistence\Repositories\EloquentCategoryRepository;

class CategoryServiceProvider extends ServiceProvider
{
    //--------------------------------------------------------------------------
    // REGISTRO -> Enlazar dependencias del contenedor de servicios
    //--------------------------------------------------------------------------
    public function register(): void
    {
        $this->app->bind(CategoryInterface::class, EloquentCategoryRepository::class);
    }

    //--------------------------------------------------------------------------
    // INICIALIZACIÓN -> Cargar rutas y configuraciones del módulo
    //--------------------------------------------------------------------------
    public function boot(): void
    {
        $router = app('router');

        $router->prefix('api/catalog')
            ->middleware(['api'])
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/../../Presentation/Routes/router.php');
            });
    }
}
