<?php

namespace App\Modules\User\Infrastructure\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Modules\User\Domain\Interfaces\UserInterface;
use App\Modules\User\Domain\Interfaces\RoleAccessGateway;
use App\Modules\User\Infrastructure\Persistence\Eloquent\Repositories\EloquentRoleAccessRepository;
use App\Modules\User\Infrastructure\Persistence\Eloquent\Repositories\EloquentUserRepository;

class UserServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserInterface::class, EloquentUserRepository::class);
        $this->app->bind(RoleAccessGateway::class, EloquentRoleAccessRepository::class);
    }

    public function boot(): void
    {
        $router = app('router');

        $router->prefix('admin')
            ->middleware(['web'])
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/../../Presentation/Http/Routes/router.php');
            });

        View::addNamespace('user', __DIR__ . '/../../Presentation/UI/Views');
    }
}
