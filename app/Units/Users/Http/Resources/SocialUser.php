<?php

namespace MVG\Units\Users\Http\Resources;

/**
 * Class SocialUser
 *
 */
class SocialUser extends UserResource
{
    public function with($request)
    {
        return ['message' => __('user::alerts.social_deleted')];
    }
}
