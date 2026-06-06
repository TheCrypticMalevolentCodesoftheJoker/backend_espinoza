<?php

//--------------------------------------------------------------------------
// BrandServiceProvider: Registra bindings y define el ruteo del catálogo de marcas
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Brand\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Catalog\Brand\Domain\Interfaces\BrandInterface;
use App\Modules\Catalog\Brand\Infrastructure\Persistence\Repositories\EloquentBrandRepository;

class BrandServiceProvider extends ServiceProvider
{
    //--------------------------------------------------------------------------
    // Inicialización: Registro de dependencias e interfaces en el contenedor
    //--------------------------------------------------------------------------
    public function register(): void
    {
        $this->app->bind(BrandInterface::class, EloquentBrandRepository::class);
    }

    //--------------------------------------------------------------------------
    // Configuración: Registro y definición de las rutas para el catálogo de marcas
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
