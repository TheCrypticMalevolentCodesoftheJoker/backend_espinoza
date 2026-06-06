<?php

//--------------------------------------------------------------------------
// CategoryServiceProvider: Proveedor de servicios para el módulo de categorías
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Category\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Catalog\Category\Domain\Interfaces\CategoryInterface;
use App\Modules\Catalog\Category\Infrastructure\Persistence\Repositories\EloquentCategoryRepository;

class CategoryServiceProvider extends ServiceProvider
{
    //--------------------------------------------------------------------------
    // Inicialización: Registro de dependencias en el contenedor de servicios
    //--------------------------------------------------------------------------
    public function register(): void
    {
        $this->app->bind(CategoryInterface::class, EloquentCategoryRepository::class);
    }

    //--------------------------------------------------------------------------
    // Configuración: Definición de rutas y arranque del módulo
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
