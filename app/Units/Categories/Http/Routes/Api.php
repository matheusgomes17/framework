<?php

namespace MVG\Units\Categories\Http\Routes;

use MVG\Support\Http\Routing\RouteFile;

/**
 * Class Api
 * @package MVG\Units\Categories\Routes
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
        $this->categoryRoutes();
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