<?php

namespace App\Modules\Catalog\Brand\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Catalog\Brand\Domain\Interfaces\BrandInterface;
use App\Modules\Catalog\Brand\Infrastructure\Persistence\Repositories\EloquentBrandRepository;

class BrandServiceProvider extends ServiceProvider
{
    //--------------------------------------------------------------------------
    // REGISTRO -> Enlazar dependencias del contenedor de servicios
    //--------------------------------------------------------------------------
    public function register(): void
    {
        $this->app->bind(BrandInterface::class, EloquentBrandRepository::class);
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
