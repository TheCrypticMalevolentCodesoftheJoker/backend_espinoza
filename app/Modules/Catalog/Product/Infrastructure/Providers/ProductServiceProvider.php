<?php
//--------------------------------------------------------------------------
// ProductServiceProvider: Registro de dependencias y configuración del módulo Product.
// Enlaza interfaces de dominio con implementaciones de infraestructura y carga las rutas.
//--------------------------------------------------------------------------

namespace App\Modules\Catalog\Product\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Catalog\Product\Domain\Interfaces\Product\ProductInterface;
use App\Modules\Catalog\Product\Domain\Interfaces\Price\PriceInterface;
use App\Modules\Catalog\Product\Domain\Interfaces\Discount\DiscountInterface;
use App\Modules\Catalog\Product\Domain\Interfaces\Image\ImageInterface;
use App\Modules\Catalog\Product\Domain\Interfaces\Gateways\CategoryAccessGateway;
use App\Modules\Catalog\Product\Domain\Interfaces\Gateways\BrandAccessGateway;
use App\Modules\Catalog\Product\Domain\Interfaces\Gateways\S3Gateway;
use App\Modules\Catalog\Product\Infrastructure\Persistence\Repositories\Product\EloquentProductRepository;
use App\Modules\Catalog\Product\Infrastructure\Persistence\Repositories\Price\EloquentPriceRepository;
use App\Modules\Catalog\Product\Infrastructure\Persistence\Repositories\Discount\EloquentDiscountRepository;
use App\Modules\Catalog\Product\Infrastructure\Persistence\Repositories\Image\EloquentImageRepository;
use App\Modules\Catalog\Product\Infrastructure\Persistence\Repositories\Gateways\EloquentCategoryAccessRepository;
use App\Modules\Catalog\Product\Infrastructure\Persistence\Repositories\Gateways\EloquentBrandAccessRepository;
use App\Modules\Catalog\Product\Infrastructure\Services\S3Service;

class ProductServiceProvider extends ServiceProvider
{
    //--------------------------------------------------------------------------
    // REGISTRO -> Enlazar dependencias del contenedor de servicios
    //--------------------------------------------------------------------------
    public function register(): void
    {
        $this->app->bind(ProductInterface::class, EloquentProductRepository::class);
        $this->app->bind(PriceInterface::class, EloquentPriceRepository::class);
        $this->app->bind(DiscountInterface::class, EloquentDiscountRepository::class);
        $this->app->bind(ImageInterface::class, EloquentImageRepository::class);

        $this->app->bind(CategoryAccessGateway::class, EloquentCategoryAccessRepository::class);
        $this->app->bind(BrandAccessGateway::class, EloquentBrandAccessRepository::class);
        $this->app->bind(S3Gateway::class, S3Service::class);
    }

    //--------------------------------------------------------------------------
    // INICIALIZACIÓN -> Cargar rutas y configuraciones del módulo
    //--------------------------------------------------------------------------
    public function boot(): void
    {
        $router = app('router');

        $router->prefix('api/catalog')
            ->middleware(['api'])
            ->group(function () {
                $this->loadRoutesFrom(__DIR__ . '/../../Presentation/Routes/router.php');
            });
    }
}
