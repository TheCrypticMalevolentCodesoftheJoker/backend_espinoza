<?php

namespace App\Modules\Role\Infrastructure\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Modules\Role\Domain\Interfaces\RoleInterface;
use App\Modules\Role\Infrastructure\Persistence\Eloquent\Repositories\EloquentRoleRepository;

class RoleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(RoleInterface::class, EloquentRoleRepository::class);
    }

    public function boot(): void
    {
        $router = app('router');

        $router->prefix('admin')
            ->middleware(['web'])
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/../../Presentation/Http/Routes/router.php');
            });

        View::addNamespace('role', __DIR__ . '/../../Presentation/UI/Views');
    }
}
