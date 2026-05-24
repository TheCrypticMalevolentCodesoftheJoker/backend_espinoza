<?php

namespace App\Modules\Role\Infrastructure\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Modules\Role\Domain\Interfaces\RoleInterface;
use App\Modules\Role\Infrastructure\Persistence\Repositories\EloquentRoleRepository;

class RoleServiceProvider extends ServiceProvider
{
    //--------------------------------------------------------------------------
    // REGISTRO -> Enlazar dependencias del contenedor de servicios
    //--------------------------------------------------------------------------
    public function register(): void
    {
        $this->app->bind(RoleInterface::class, EloquentRoleRepository::class);
    }

    //--------------------------------------------------------------------------
    // INICIALIZACIÓN -> Cargar rutas y configuraciones del módulo
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
