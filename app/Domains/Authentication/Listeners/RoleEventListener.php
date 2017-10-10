<?php

namespace MVG\Domains\Authentication\Listeners;

/**
 * Class RoleEventListener
 *
 */
class RoleEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        \Log::info(__('auth::log.created'));
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        \Log::info(__('auth::log.updated'));
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        \Log::info(__('auth::log.deleted'));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \MVG\Domains\Authentication\Events\RoleCreated::class,
            'MVG\Domains\Authentication\Listeners\RoleEventListener@onCreated'
        );
        $events->listen(
            \MVG\Domains\Authentication\Events\RoleUpdated::class,
            'MVG\Domains\Authentication\Listeners\RoleEventListener@onUpdated'
        );
        $events->listen(
            \MVG\Domains\Authentication\Events\RoleDeleted::class,
            'MVG\Domains\Authentication\Listeners\RoleEventListener@onDeleted'
        );
    }
}