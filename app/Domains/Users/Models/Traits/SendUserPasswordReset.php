<?php

namespace MVG\Domains\Users\Models\Traits;

use MVG\Domains\Users\Notifications\ResetPassword;

/**
 * Trait SendUserPasswordReset
 *
 */
trait SendUserPasswordReset
{
    public static $resetPasswordRoute;

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $link = str_replace('{token}', $token, self::$resetPasswordRoute);

        $this->notify(new ResetPassword($link));
    }
}