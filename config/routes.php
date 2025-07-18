<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Injects Configuration
    |--------------------------------------------------------------------------
    | Specify directories to scan for controller auto-injection
    | Keys correspond to route groups where controllers should be injected
    | Values are arrays of directory paths to scan for controllers
    */

    'injects' => [
        'web' => [],
        'api' => [],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloads
    |--------------------------------------------------------------------------
    | String of class name that instance of \Dentro\Yalr\Contracts\Bindable
    | Preloads will always been called even when laravel routes has been cached.
    | It is the best place to put Rate Limiter and route binding related code.
    */

    'preloads' => [
        App\Http\Routes\RouteModelBinding::class,
        App\Http\Routes\RouteRateLimiter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Router group settings
    |--------------------------------------------------------------------------
    | Groups are used to organize and group your routes. Basically the same
    | group that used in common laravel route.
    |
    | 'group_name' => [
    |     // laravel group route options can contains 'middleware', 'prefix',
    |     // 'as', 'domain', 'namespace', 'where'
    | ]
    */

    'groups' => [
        'web' => [
            'middleware' => 'web',
            'prefix' => '',
        ],
        'admin' => [
            'middleware' => ['web', 'auth'],
            'prefix' => 'admin',
            'as' => 'admin.',
        ],
        'api' => [
            'middleware' => 'api',
            'prefix' => 'api',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Routes
    |--------------------------------------------------------------------------
    | Below is where our route is loaded, it read `groups` section above.
    | keys in this array are the name of route group and values are string
    | class name either instance of \Dentro\Yalr\Contracts\Bindable or
    | controller that use attribute that inherit \Dentro\Yalr\RouteAttribute
    */

    'web' => [
        App\Http\Routes\DefaultRoute::class,
        App\Http\Controllers\Authentication\LoginController::class,
        App\Http\Controllers\App\HomeController::class,
        App\Http\Controllers\App\PrediksiController::class,
        App\Http\Controllers\App\PenjadwalanController::class,
        App\Http\Controllers\Authentication\ResetPasswordController::class,
        App\Http\Controllers\Authentication\ForgotPasswordController::class
    ],
    'admin' => [
        App\Http\Controllers\Admin\DashboardController::class,
        App\Http\Controllers\Admin\PrediksiController::class,
        App\Http\Controllers\Admin\PenjadwalanController::class,
        App\Http\Controllers\Admin\DataSetController::class,
    ],
    'api' => [
        //
    ],
];
