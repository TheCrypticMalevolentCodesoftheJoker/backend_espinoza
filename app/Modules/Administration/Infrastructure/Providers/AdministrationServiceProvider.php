<?php

namespace App\Modules\Administration\Infrastructure\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use App\Modules\Administration\Domain\Interfaces\CategoryInterface;
use App\Modules\Administration\Infrastructure\Persistence\Eloquent\Repositories\EloquentCategoryRepository;

class AdministrationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CategoryInterface::class, EloquentCategoryRepository::class);
    }

    public function boot(): void
    {
        $router = $this->app['router'];
        $router->prefix('admin')
            ->middleware(['web'])
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/../Presentation/Http/Routes/router.php');
            });
        View::addNamespace('administration', __DIR__ . '/../Presentation/Http/Views');
    }
}
