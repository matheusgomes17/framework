<?php

namespace MVG\Domains\Users\Services;

use MVG\Domains\Users\Events\UserConfirmed;
use MVG\Domains\Users\Events\UserUnconfirmed;
use MVG\Domains\Users\Exceptions\UserException;
use MVG\Domains\Users\Models\User;
use MVG\Domains\Users\Notifications\UserAccountActive;
use MVG\Domains\Users\Notifications\UserNeedsConfirmation;

/**
 * Class UserConfirmationService
 *
 */
class UserConfirmationService extends AbstractService
{
    /**
     * @param User $user
     * @return User
     * @throws UserException
     */
    public function sendConfirmationEmail(User $user)
    {
        // Shouldn't allow users to confirm their own accounts when the application is set to manual confirmation
        if (config('user.requires_approval')) {
            throw new UserException(__('user::alerts.cant_resend_confirmation'));
        }

        $user->notify(new UserNeedsConfirmation($user->confirmation_code));

        return $user;
    }

    /**
     * @param User $user
     * @return User
     * @throws UserException
     */
    public function confirm(User $user) : User
    {
        if ($user->confirmed == 1) {
            throw new UserException(__('user::exceptions.already_confirmed'));
        }

        $user->confirmed = 1;
        $confirmed = $user->save();

        if ($confirmed) {

            event(new UserConfirmed($user));

            // Let user know their account was approved
            if (config('user.requires_approval')) {
                $user->notify(new UserAccountActive);
            }

            return $user;
        }

        throw new UserException(__('user::exceptions.cant_confirm'));
    }

    /**
     * @param User $user
     *
     * @return User
     * @throws UserException
     */
    public function unconfirm(User $user) : User
    {
        if ($user->confirmed == 0) {
            throw new UserException(__('user::exceptions.not_confirmed'));
        }

        if ($user->id == 1) {
            // Cant un-confirm admin
            throw new UserException(__('user::exceptions.cant_unconfirm_admin'));
        }

        if ($user->id == auth()->id()) {
            // Cant un-confirm self
            throw new UserException(__('user::exceptions.cant_unconfirm_self'));
        }

        $user->confirmed = 0;
        $unconfirmed = $user->save();

        if ($unconfirmed) {

            event(new UserUnconfirmed($user));

            return $user;
        }

        throw new UserException(__('user::exceptions.cant_unconfirm'));
    }
}