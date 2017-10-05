<?php

namespace MVG\Domains\Authentication\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

/**
 * Class EventServiceProvider
 * @package MVG\Domains\Users\Providers
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [];

    /**
     * Class event subscribers.
     *
     * @var array
     */
    protected $subscribe = [
        \MVG\Domains\Users\Listeners\UserEventListener::class
    ];
}