<?php

namespace MVG\Domains\Categories\Listeners;

/**
 * Class CategoryEventListener
 *
 */
class CategoryEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        \Log::info(__('category::log.categories.create'));
    }

    /**
     * @param $event
     */
    public function onPermanentlyDeleted($event)
    {
        \Log::info(__('category::log.categories.permanently_deleted'));
    }
    
    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        \Log::info(__('category::log.categories.updated'));
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        \Log::info(__('category::log.categories.deleted'));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \MVG\Domains\Categories\Events\CategoryCreated::class,
            'MVG\Domains\Categories\Listeners\CategoryEventListener@onCreated'
        );
        $events->listen(
            \MVG\Domains\Categories\Events\CategoryPermanentlyDeleted::class,
            'MVG\Domains\Categories\Listeners\CategoryEventListener@onPermanentlyDeleted'
        );
        $events->listen(
            \MVG\Domains\Categories\Events\CategoryUpdated::class,
            'MVG\Domains\Categories\Listeners\CategoryEventListener@onUpdated'
        );
        $events->listen(
            \MVG\Domains\Categories\Events\CategoryDeleted::class,
            'MVG\Domains\Categories\Listeners\CategoryEventListener@onDeleted'
        );
    }
}