<?php

namespace MVG\Units\Users\Http\Resources;

/**
 * Class UserUpdate
 *
 */
class UserUpdate extends UserResource
{
    public function with($request)
    {
        return ['message' => __('user::alerts.updated')];
    }
}
