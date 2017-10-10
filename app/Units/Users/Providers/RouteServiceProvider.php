<?php

namespace MVG\Units\Users\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use MVG\Domains\Users\Models\User;
use MVG\Units\Users\Http\Routes\Api;
use MVG\Units\Users\Http\Routes\Web;

/**
 * Class RouteServiceProvider
 *
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'MVG\Units\Users\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        /*
         * This allows us to use the Route Model Binding with SoftDeletes on
         * On a model by model basis
         */
        $this->bind('deletedUser', function ($value) {
            $user = new User;
            return User::withTrashed()->where($user->getRouteKeyName(), $value)->first();
        });

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        //$this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        (new Web([
            'middleware' => ['web', 'tenant', 'auth:web'],
            'namespace'  => $this->namespace,
            'prefix'     => '',
        ]))->register();
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        (new Api([
            'middleware' => ['api', 'tenant', 'auth:api_tenants'],
            'namespace'  => $this->namespace,
            'prefix'     => 'api',
        ]))->register();
    }
}
