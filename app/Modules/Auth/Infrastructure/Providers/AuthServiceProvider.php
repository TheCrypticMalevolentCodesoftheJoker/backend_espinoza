<?php

namespace App\Modules\Auth\Infrastructure\Providers;

use App\Modules\Auth\Domain\Interfaces\AuthInterface;
use App\Modules\Auth\Infrastructure\Persistence\Repositories\EloquentAuthRepository;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AuthInterface::class, EloquentAuthRepository::class);
    }

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
