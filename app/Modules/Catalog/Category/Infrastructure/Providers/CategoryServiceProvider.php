<?php

namespace App\Modules\Catalog\Category\Infrastructure\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use App\Modules\Catalog\Category\Domain\Interfaces\CategoryInterface;
use App\Modules\Catalog\Category\Infrastructure\Persistence\Eloquent\Repositories\EloquentCategoryRepository;

class CategoryServiceProvider extends ServiceProvider
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
                $this->loadRoutesFrom(__DIR__ . '/../../Presentation/Http/Routes/router.php');
            });
        View::addNamespace('catalog', __DIR__ . '/../../Presentation/UI/Views');
    }
}
