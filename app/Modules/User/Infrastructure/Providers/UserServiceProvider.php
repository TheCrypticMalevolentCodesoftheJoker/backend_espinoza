<?php
//--------------------------------------------------------------------------
// UserServiceProvider: Registro de dependencias y configuración de rutas del módulo User.
// Incluye binding del gateway anti-corrupción para acceso al módulo Role.
//--------------------------------------------------------------------------

namespace App\Modules\User\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\User\Domain\Interfaces\UserInterface;
use App\Modules\User\Domain\Interfaces\RoleAccessGateway;
use App\Modules\User\Infrastructure\Persistence\Repositories\EloquentRoleAccessRepository;
use App\Modules\User\Infrastructure\Persistence\Repositories\EloquentUserRepository;

class UserServiceProvider extends ServiceProvider
{
    //--------------------------------------------------------------------------
    // REGISTRO -> Enlazar dependencias del contenedor de servicios
    //--------------------------------------------------------------------------
    public function register(): void
    {
        $this->app->bind(UserInterface::class, EloquentUserRepository::class);
        $this->app->bind(RoleAccessGateway::class, EloquentRoleAccessRepository::class);
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
