<?php

namespace MVG\Domains\Users\Services;

use MVG\Domains\Users\Events\UserDeleted;
use MVG\Domains\Users\Exceptions\UserException;
use MVG\Domains\Users\Models\User;

/**
 * Class DeleteUserService
 *
 */
class DeleteUserService extends AbstractService
{
    public function delete(User $user)
    {
        $user = $this->findByID($user->id);

        if ($user->delete()) {

            event(new UserDeleted($user));

            return true;
        }

        throw new UserException(trans('user::exceptions.delete_error'));
    }
}