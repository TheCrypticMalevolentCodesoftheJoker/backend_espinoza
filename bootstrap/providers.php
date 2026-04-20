<?php

return [
    App\Providers\AppServiceProvider::class,

    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_//
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_  MODULOS  -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-//
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_//

    App\Modules\Catalog\Category\Infrastructure\Providers\CategoryServiceProvider::class,
    App\Modules\Catalog\Brand\Infrastructure\Providers\BrandServiceProvider::class,
    App\Modules\Catalog\Product\Infrastructure\Providers\ProductServiceProvider::class,
];
