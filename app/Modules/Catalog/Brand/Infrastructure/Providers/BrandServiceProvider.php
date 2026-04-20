<?php

namespace App\Modules\Catalog\Brand\Infrastructure\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use App\Modules\Catalog\Brand\Domain\Interfaces\BrandInterface;
use App\Modules\Catalog\Brand\Infrastructure\Persistence\Eloquent\Repositories\EloquentBrandRepository;

class BrandServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(BrandInterface::class, EloquentBrandRepository::class);
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