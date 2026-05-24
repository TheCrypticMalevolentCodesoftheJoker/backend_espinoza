<?php

namespace App\Modules\Analytics\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Analytics\Domain\Interfaces\AnalyticsInterface;
use App\Modules\Analytics\Infrastructure\Persistence\Repositories\EloquentAnalyticsRepository;

class AnalyticsServiceProvider extends ServiceProvider
{
    //--------------------------------------------------------------------------
    // REGISTRO -> Vincular interfaces y repositorios
    //--------------------------------------------------------------------------
    public function register(): void
    {
        $this->app->bind(AnalyticsInterface::class, EloquentAnalyticsRepository::class);
    }

    //--------------------------------------------------------------------------
    // ARRANQUE -> Cargar rutas del módulo
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
