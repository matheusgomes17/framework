<?php

namespace MVG\Units\Users\Http\Resources;

/**
 * Class RestoreUser
 * @package MVG\Units\Users\Http\Resources
 */
class RestoreUser extends UserResource
{
    public function with($request)
    {
        return ['message' => __('user::alerts.restored')];
    }
}
