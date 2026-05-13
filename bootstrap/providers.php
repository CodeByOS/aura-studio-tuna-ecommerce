<?php

if (class_exists(Laravel\Telescope\TelescopeServiceProvider::class)) {
    return [
        App\Providers\AppServiceProvider::class,
        App\Providers\TelescopeServiceProvider::class,
    ];
}

return [
    App\Providers\AppServiceProvider::class,
];
