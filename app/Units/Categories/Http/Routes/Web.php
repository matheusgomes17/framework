<?php

namespace MVG\Units\Categories\Http\Routes;

use MVG\Support\Http\Routing\RouteFile;

/**
 * Class Web
 * @package MVG\Units\Categories\Routes
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
        $this->categoryRoutes();
    }

    protected function categoryRoutes()
    {

    }
}