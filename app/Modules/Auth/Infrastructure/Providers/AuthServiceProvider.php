<?php

//--------------------------------------------------------------------------
// AuthServiceProvider: Proveedor de servicios para registrar dependencias y mapear rutas de Auth
//--------------------------------------------------------------------------

namespace App\Modules\Auth\Infrastructure\Providers;

use App\Modules\Auth\Domain\Interfaces\AuthInterface;
use App\Modules\Auth\Infrastructure\Persistence\Repositories\EloquentAuthRepository;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    //--------------------------------------------------------------------------
    // Inicialización: Registro de implementaciones del repositorio en el contenedor
    //--------------------------------------------------------------------------
    public function register(): void
    {
        $this->app->bind(AuthInterface::class, EloquentAuthRepository::class);
    }

    //--------------------------------------------------------------------------
    // Configuración: Registro y definición del ruteo para los endpoints de autenticación
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
