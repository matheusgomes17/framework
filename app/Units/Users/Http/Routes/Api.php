<?php

namespace MVG\Units\Users\Http\Routes;

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
            $this->adminRoutes();
            $this->appRoutes();
            $this->userRoutes();
        });
    }

    protected function registerV1Routes()
    {
        $this->router->group(['prefix' => 'v1'], function () {
            $this->registerDefaultRoutes();
        });
    }

    protected function adminRoutes()
    {
        $this->router->group(['prefix' => 'admin'], function () {
            //
        });
    }

    protected function appRoutes()
    {
        $this->router->group(['prefix' => 'app'], function () {
            //
        });
    }

    /**
     * Specific User
     */
    protected function userRoutes()
    {
        // User CRUD
        $this->router->resource('user', 'UserController', ['except' => ['create', 'edit']]);

        $this->router->group(['prefix' => 'user/{user}'], function () {
            // Account
            $this->router->get('account/confirm/resend', 'UserConfirmationController@sendConfirmationEmail')->name('user.account.confirm.resend');
            // Status
            $this->router->get('mark/{status}', 'UserStatusController@mark')->name('user.mark')->where(['status' => '[0,1]']);
            // Social
            $this->router->delete('social/{social}/unlink', 'UserSocialController@unlink')->name('user.social.unlink');
            // Confirmation
            $this->router->get('confirm', 'UserConfirmationController@confirm')->name('user.confirm');
            $this->router->get('unconfirm', 'UserConfirmationController@unconfirm')->name('user.unconfirm');
            // Password
            $this->router->get('password/change', 'UserPasswordController@edit')->name('user.change-password');
            $this->router->patch('password/change', 'UserPasswordController@update')->name('user.change-password.post');
        });

        // Deleted User
        $this->router->group(['prefix' => 'user/{deletedUser}'], function () {
            $this->router->get('delete', 'UserStatusController@delete')->name('user.delete-permanently');
            $this->router->get('restore', 'UserStatusController@restore')->name('user.restore');
        });
    }
}