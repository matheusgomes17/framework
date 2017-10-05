<?php

namespace MVG\Units\Users\Http\Resources;

/**
 * Class UserStore
 * @package MVG\Units\Users\Http\Resources
 */
class UserStore extends UserResource
{
    public function with($request)
    {
        return ['message' => __('user::alerts.created')];
    }
}
