<?php

namespace MVG\Units\Users\Http\Resources;

/**
 * Class RestoreUser
 *
 */
class RestoreUser extends UserResource
{
    public function with($request)
    {
        return ['message' => __('user::alerts.restored')];
    }
}
