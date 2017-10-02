<?php

namespace MVG\Units\Core\Http\Routes;

use Illuminate\Http\Request;
use MVG\Domains\Users\Models\User;
use MVG\Support\Http\Routing\RouteFile;
use MVG\Units\Users\Http\Resources\UserResource;

/**
 * Class Api
 * @package MVG\Units\Core\Routes
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
        $this->testRoutes();
    }

    protected function registerV1Routes()
    {
        $this->router->group(['prefix' => 'v1'], function () {
            $this->registerDefaultRoutes();
        });
    }

    protected function testRoutes()
    {
        $this->router->get('test', function (Request $request) {
            return new UserResource(User::find(11));
        });
    }
}