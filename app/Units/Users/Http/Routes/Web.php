<?php

namespace MVG\Units\Users\Http\Routes;

use MVG\Support\Http\Routing\RouteFile;

/**
 * Class Web
 * @package MVG\Units\Users\Routes
 */
class Web extends RouteFile
{
    /**
     * Declare Web Routes.
     */
    public function routes()
    {
        $this->registerDefaultRoutes();
    }

    protected function registerDefaultRoutes()
    {
        $this->router->domain('{' . config('auth.tenants.route_param') . '}.' . parse_url(config('app.url'))['host'])->group(function () {
            //
        });
    }
}