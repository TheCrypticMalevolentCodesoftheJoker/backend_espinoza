<?php

namespace App\Modules\Catalog\Product\Infrastructure\Providers;

use App\Modules\Catalog\Product\Application\Queries\ProductReadRepository;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Modules\Catalog\Product\Domain\Interfaces\DimensionInterface;
use App\Modules\Catalog\Product\Domain\Interfaces\DiscountInterface;
use App\Modules\Catalog\Product\Domain\Interfaces\ImageInterface;
use App\Modules\Catalog\Product\Domain\Interfaces\PriceInterface;
use App\Modules\Catalog\Product\Domain\Interfaces\ProductInterface;
use App\Modules\Catalog\Product\Infrastructure\Persistence\Eloquent\Queries\EloquentProductReadRepository;
use App\Modules\Catalog\Product\Infrastructure\Persistence\Eloquent\Repositories\EloquentDimensionRepository;
use App\Modules\Catalog\Product\Infrastructure\Persistence\Eloquent\Repositories\EloquentDiscountRepository;
use App\Modules\Catalog\Product\Infrastructure\Persistence\Eloquent\Repositories\EloquentImageRepository;
use App\Modules\Catalog\Product\Infrastructure\Persistence\Eloquent\Repositories\EloquentPriceRepository;
use App\Modules\Catalog\Product\Infrastructure\Persistence\Eloquent\Repositories\EloquentProductWriteRepository;


class ProductServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ProductReadRepository::class, EloquentProductReadRepository::class);
        $this->app->bind(ProductInterface::class, EloquentProductWriteRepository::class);
        $this->app->bind(ImageInterface::class, EloquentImageRepository::class);
        $this->app->bind(DimensionInterface::class, EloquentDimensionRepository::class);
        $this->app->bind(PriceInterface::class, EloquentPriceRepository::class);
        $this->app->bind(DiscountInterface::class, EloquentDiscountRepository::class);
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
