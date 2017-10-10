<?php

namespace MVG\Units\Categories\Http\Routes;

use MVG\Support\Http\Routing\RouteFile;

/**
 * Class Api
 *
 */
class Api extends RouteFile
{
    /**
     * Declare API Routes.
     */
    public function routes()
    {
        $this->registerV1Routes();
    }

    protected function registerDefaultRoutes()
    {
        $this->router->domain('{' . config('auth.tenants.route_param') . '}.' . parse_url(config('app.url'))['host'])->group(function () {
            $this->categoryRoutes();
        });
    }

    protected function registerV1Routes()
    {
        $this->router->group(['prefix' => 'v1'], function () {
            $this->registerDefaultRoutes();
        });
    }

    protected function categoryRoutes()
    {

    }
}