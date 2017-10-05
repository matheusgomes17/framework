<?php

namespace MVG\Units\Users\Http\Resources;

/**
 * Class SocialUser
 * @package MVG\Units\Users\Http\Resources
 */
class SocialUser extends UserResource
{
    public function with($request)
    {
        return ['message' => __('user::alerts.social_deleted')];
    }
}
