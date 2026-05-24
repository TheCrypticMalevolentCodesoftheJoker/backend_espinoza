<?php

return [
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_//
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_  MODULOS  -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-//
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_//
    App\Modules\Role\Infrastructure\Providers\RoleServiceProvider::class,
    App\Modules\User\Infrastructure\Providers\UserServiceProvider::class,
    App\Modules\Auth\Infrastructure\Providers\AuthServiceProvider::class,
    App\Modules\Catalog\Category\Infrastructure\Providers\CategoryServiceProvider::class,
    App\Modules\Catalog\Brand\Infrastructure\Providers\BrandServiceProvider::class,
    App\Modules\Catalog\Product\Infrastructure\Providers\ProductServiceProvider::class,
    App\Modules\Analytics\Infrastructure\Providers\AnalyticsServiceProvider::class,
];
