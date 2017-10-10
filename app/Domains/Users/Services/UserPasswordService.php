<?php

namespace MVG\Domains\Users\Services;

use MVG\Domains\Users\Events\UserPasswordChanged;
use MVG\Domains\Users\Exceptions\UserException;
use MVG\Domains\Users\Models\User;

/**
 * Class UserPasswordService
 *
 */
class UserPasswordService extends AbstractService
{
    /**
     * @param User $user
     * @param      $input
     * @return User
     * @throws UserException
     */
    public function updatePassword(User $user, $input) : User
    {
        $user->password = bcrypt($input['password']);

        if ($user->save()) {

            event(new UserPasswordChanged($user));

            return $user;
        }

        throw new UserException(__('user::exceptions.update_password_error'));
    }
}