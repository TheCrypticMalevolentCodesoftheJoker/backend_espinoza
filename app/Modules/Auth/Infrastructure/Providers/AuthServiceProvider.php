<?php

namespace App\Modules\Auth\Infrastructure\Providers;

use App\Modules\Auth\Domain\Interfaces\AuthInterface;
use App\Modules\Auth\Infrastructure\Persistence\Eloquent\Repositories\EloquentAuthRepository;
use Illuminate\Support\Facades\View;
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

        $router->middleware(['web'])
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/../../Presentation/Http/Routes/router.php');
            });

        View::addNamespace('auth', __DIR__ . '/../../Presentation/UI/Views');
    }
}
