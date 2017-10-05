<?php

namespace MVG\Units\Users\Http\Resources;

/**
 * Class UserDeleted
 * @package MVG\Units\Users\Http\Resources
 */
class UserDeleted extends UserResource
{
    public function with($request)
    {
        return ['message' => __('user::alerts.deleted_permanently')];
    }
}
