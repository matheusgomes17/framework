<?php

namespace MVG\Units\Users\Http\Controllers;

use MVG\Domains\Users\Models\SocialAccount;
use MVG\Domains\Users\Models\User;
use MVG\Domains\Users\Services\UserSocialService;
use MVG\Support\Http\Controllers\Controller;
use MVG\Units\Users\Http\Requests\ManageUserRequest;
use MVG\Units\Users\Http\Resources\SocialUser;

/**
 * Class UserSocialController
 * @package MVG\Units\Users\Http\Controllers
 */
class UserSocialController extends Controller
{
    /**
     * @param User $user
     * @param SocialAccount $social
     * @param ManageUserRequest $request
     * @param UserSocialService $socialService
     * @return static
     * @throws \MVG\Domains\Users\Exceptions\UserException
     */
    public function unlink(User $user, SocialAccount $social, ManageUserRequest $request, UserSocialService $socialService)
    {
        $user = $socialService->delete($user, $social);

        return SocialUser::make($user);
    }
}
