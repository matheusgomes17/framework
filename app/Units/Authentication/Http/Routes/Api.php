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
        $this->router->post('login', 'LoginController@login');
        //$this->loginRoutes();
        $this->registerRoutes();
        $this->passwordResetsRoutes();
    }

    protected function registerV1Routes()
    {
        $this->router->group(['prefix' => 'v1'], function () {
            $this->registerDefaultRoutes();
        });
    }

    protected function loginRoutes()
    {
        $this->router->get('login', 'LoginController@showLoginForm')->name('login');
        $this->router->post('login', 'LoginController@login');
        $this->router->post('logout', 'LoginController@logout')->name('logout');
    }

    protected function registerRoutes()
    {
        $this->router->get('register', 'RegisterController@showRegistrationForm')->name('register');
        $this->router->post('register', 'RegisterController@register');
    }

    protected function passwordResetsRoutes()
    {
        $this->router->get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        $this->router->get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password');
        $this->router->post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        $this->router->post('password/reset', 'ResetPasswordController@reset');
    }
}