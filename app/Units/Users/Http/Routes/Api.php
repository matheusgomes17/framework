<?php

namespace MVG\Units\Users\Http\Routes;

use MVG\Support\Http\Routing\RouteFile;

/**
 * Class Api
 * @package MVG\Units\Users\Routes
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
        $this->userRoutes();
    }

    protected function registerV1Routes()
    {
        $this->router->group(['prefix' => 'v1'], function () {
            $this->registerDefaultRoutes();
        });
    }

    protected function userRoutes()
    {
        $this->router->resource('user', 'UserController', ['except' => ['create', 'edit']]);
    }
}