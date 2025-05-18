<?php

namespace App\Http\Routes;

use Dentro\Yalr\Contracts\Bindable;
use Illuminate\Routing\Router;

/**
 * @author      dsw <dswtech@gmail.com>
 */
class RouteModelBinding implements Bindable
{
    public function __construct(protected Router $router)
    {
    }

    public function bind(): void
    {
    }
}
