<?php

return [
    App\Providers\AppServiceProvider::class,

    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_//
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_  MODULOS  -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-//
    //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_//
    
    App\Modules\Administration\Infrastructure\Providers\AdministrationServiceProvider::class,
];
