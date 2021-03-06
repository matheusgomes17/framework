<?php

namespace MVG\Units\Authentication\Http\Routes;

use MVG\Support\Http\Routing\RouteFile;

/**
 * Class Api
 * @package MVG\Units\Authentication\Routes
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
            $this->loginRoutes();
            $this->signUpRoutes();
            $this->passwordRoutes();

            $this->roleRoutes();
        });
    }

    protected function registerV1Routes()
    {
        $this->router->group(['prefix' => 'v1'], function () {
            $this->registerDefaultRoutes();
        });
    }

    protected function loginRoutes()
    {
        $this->router->post('login', 'LoginController@login');
        //$this->router->post('logout', 'LoginController@logout')->name('logout');
    }

    protected function signUpRoutes()
    {
        $this->router->post('register', 'RegisterController@register');
    }

    protected function passwordRoutes()
    {
        $this->router->post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        $this->router->post('password/reset', 'ResetPasswordController@reset');
    }

    protected function roleRoutes()
    {
        $this->router->resource('user/role', 'RoleController', ['except' => ['create', 'edit']]);
    }

}