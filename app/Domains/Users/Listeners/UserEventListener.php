<?php

namespace MVG\Domains\Users\Listeners;

/**
 * Class UserEventListener
 *
 */
class UserEventListener
{
    /**
     * @param $event
     */
    public function onCreated($event)
    {
        \Log::info(__('user::log.users.create'));
    }

    /**
     * @param $event
     */
    public function onConfirmed($event)
    {
        \Log::info(__('user::log.users.confirm'));
    }

    /**
     * @param $event
     */
    public function onUnconfirmed($event)
    {
        \Log::info(__('user::log.users.unconfirm'));
    }

    /**
     * @param $event
     */
    public function onPasswordChanged($event)
    {
        \Log::info(__('user::log.users.password_change'));
    }

    /**
     * @param $event
     */
    public function onDeactivated($event)
    {
        \Log::info(__('user::log.users.deactivated'));
    }

    /**
     * @param $event
     */
    public function onReactivated($event)
    {
        \Log::info(__('user::log.users.reactivated'));
    }

    /**
     * @param $event
     */
    public function onSocialDeleted($event)
    {
        \Log::info(__('user::log.users.social_deleted'));
    }

    /**
     * @param $event
     */
    public function onPermanentlyDeleted($event)
    {
        \Log::info(__('user::log.users.permanently_deleted'));
    }

    /**
     * @param $event
     */
    public function onRestored($event)
    {
        \Log::info(__('user::log.users.restored'));
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        \Log::info(__('user::log.users.updated'));
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        \Log::info(__('user::log.users.deleted'));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \MVG\Domains\Users\Events\UserCreated::class,
            'MVG\Domains\Users\Listeners\UserEventListener@onCreated'
        );
        $events->listen(
            \MVG\Domains\Users\Events\UserConfirmed::class,
            'MVG\Domains\Users\Listeners\UserEventListener@onConfirmed'
        );
        $events->listen(
            \MVG\Domains\Users\Events\UserUnconfirmed::class,
            'MVG\Domains\Users\Listeners\UserEventListener@onUnconfirmed'
        );
        $events->listen(
            \MVG\Domains\Users\Events\UserPasswordChanged::class,
            'MVG\Domains\Users\Listeners\UserEventListener@onPasswordChanged'
        );
        $events->listen(
            \MVG\Domains\Users\Events\UserDeactivated::class,
            'MVG\Domains\Users\Listeners\UserEventListener@onDeactivated'
        );
        $events->listen(
            \MVG\Domains\Users\Events\UserReactivated::class,
            'MVG\Domains\Users\Listeners\UserEventListener@onReactivated'
        );
        $events->listen(
            \MVG\Domains\Users\Events\UserSocialDeleted::class,
            'MVG\Domains\Users\Listeners\UserEventListener@onSocialDeleted'
        );
        $events->listen(
            \MVG\Domains\Users\Events\UserPermanentlyDeleted::class,
            'MVG\Domains\Users\Listeners\UserEventListener@onPermanentlyDeleted'
        );
        $events->listen(
            \MVG\Domains\Users\Events\UserRestored::class,
            'MVG\Domains\Users\Listeners\UserEventListener@onRestored'
        );
        $events->listen(
            \MVG\Domains\Users\Events\UserUpdated::class,
            'MVG\Domains\Users\Listeners\UserEventListener@onUpdated'
        );
        $events->listen(
            \MVG\Domains\Users\Events\UserDeleted::class,
            'MVG\Domains\Users\Listeners\UserEventListener@onDeleted'
        );
    }
}