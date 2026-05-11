<?php

namespace App\Modules\Catalog\Product\Infrastructure\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Modules\Catalog\Product\Domain\Interfaces\BrandAccessGateway;
use App\Modules\Catalog\Product\Domain\Interfaces\CategoryAccessGateway;
use App\Modules\Catalog\Product\Domain\Interfaces\ProductInterface;
use App\Modules\Catalog\Product\Infrastructure\Persistence\Eloquent\Repositories\EloquentBrandAccessRepository;
use App\Modules\Catalog\Product\Infrastructure\Persistence\Eloquent\Repositories\EloquentCategoryAccessRepository;
use App\Modules\Catalog\Product\Infrastructure\Persistence\Eloquent\Repositories\EloquentProductRepository;

class ProductServiceProvider extends ServiceProvider
{
    //--------------------------------------------------------------------------
    // CONFIGURACIÓN
    //--------------------------------------------------------------------------
    public function register(): void
    {
        $this->app->bind(ProductInterface::class, EloquentProductRepository::class);
        $this->app->bind(CategoryAccessGateway::class, EloquentCategoryAccessRepository::class);
        $this->app->bind(BrandAccessGateway::class, EloquentBrandAccessRepository::class);
    }

    public function boot(): void
    {
        $router = app('router');

        $router->prefix('admin')
            ->middleware(['web'])
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/../../Presentation/Http/Routes/router.php');
            });

        View::addNamespace('product', __DIR__ . '/../../Presentation/UI/Views');
    }
}

