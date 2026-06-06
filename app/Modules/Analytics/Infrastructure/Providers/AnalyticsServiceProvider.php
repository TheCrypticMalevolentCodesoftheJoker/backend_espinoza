<?php

//--------------------------------------------------------------------------
// AnalyticsServiceProvider: Registro de bindings de dependencias y rutas del módulo
//--------------------------------------------------------------------------

namespace App\Modules\Analytics\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Analytics\Domain\Interfaces\AnalyticsInterface;
use App\Modules\Analytics\Infrastructure\Persistence\Repositories\EloquentAnalyticsRepository;

class AnalyticsServiceProvider extends ServiceProvider
{
    //--------------------------------------------------------------------------
    // Inicialización: Registro de implementaciones del repositorio en el contenedor
    //--------------------------------------------------------------------------
    public function register(): void
    {
        $this->app->bind(AnalyticsInterface::class, EloquentAnalyticsRepository::class);
    }

    //--------------------------------------------------------------------------
    // Configuración: Registro y definición del ruteo para los endpoints de analítica
    //--------------------------------------------------------------------------
    public function boot(): void
    {
        $router = app('router');

        $router->prefix('api')
            ->middleware(['api'])
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/../../Presentation/Routes/router.php');
            });
    }
}
