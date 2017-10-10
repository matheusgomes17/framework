<?php

namespace MVG\Domains\Users\Services;

use MVG\Domains\Users\Events\UserSocialDeleted;
use MVG\Domains\Users\Exceptions\UserException;
use MVG\Domains\Users\Models\SocialAccount;
use MVG\Domains\Users\Models\User;

/**
 * Class CreateUserSocialService
 *
 */
class CreateUserSocialService extends AbstractService
{
    public function delete(User $user, SocialAccount $social)
    {
        if ($user->providers()->whereId($social->id)->delete()) {

            event(new UserSocialDeleted($user, $social));

            return true;
        }

        throw new UserException(__('user::exceptions.social_delete_error'));
    }
}